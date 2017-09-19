<?php
/**
 * YieldExample
 *
 * @author   Pu ShaoWei <pushaowei0727@gmail.com>
 * @date     2017/9/17
 * @license  MIT
 * -------------------------------------------------------------
 * 思路分析：笔记局 ,觉得需要认真学习的 Yield
 * -------------------------------------------------------------
 *  [由来]
 *  PHP从5.5引入了yield关键字，增加了迭代生成器和协程的支持，但并未在言本身级别实现一个完善的协程解决方案。
 *  PHP协程也是基于Generator，Generator可以视为一种“可中断”的函数，而 yield 构成了一系列的“中断点”。
 *  PHP 协程没有resume关键字，而是“在使用的时候唤起”协程。了解如何在PHP中实现协程，首先要解决迭代生成器。
 *  PHP > 手册 > 语言参考 > 生成器 http://php.net/manual/zh/language.generators.overview.php
 * -------------------------------------------------------------
 *  [概念]
 *  “协程”（Coroutine）概念最早由 Melvin Conway 于1958年提出。
 *   协程可以理解为纯用户态的线程，其通过协作而不是抢占来进行切换。
 *   相对于进程或者线程，协程所有的操作都可以在用户态完成，创建和切换的消耗更低。
 *   总的来说，协程为协同任务提供了一种运行时抽象，这种抽象非常适合于协同多任务调度和数据流处理。
 *   在现代操作系统和编程语言中，因为用户态线程切换代价比内核态线程小，协程成为了一种轻量级的多任务模型。
 * -------------------------------------------------------------
 *   [协程与进程线程的区别]
 *   对于操作系统来说只有进程和线程，协程的控制由应用程序显式调度，非抢占式的
 *   协程的执行最终靠的还是线程，应用程序来调度协程选择合适的线程来获取执行权
 *   切换非常快，成本低。一般占用栈大小远小于线程（协程KB级别，线程MB级别），
 *   所以可以开更多的协程，协程比线程更轻量级
 * -------------------------------------------------------------
 */

/**
 * 协程生产器
 *
 * @param     $start
 * @param     $end
 * @param int $step
 * @return \Generator
 */
$SyncFactory = function ($start, $end, $step = 1) {
    for ($i = $start; $i <= $end; $i += $step) {
        yield $i;
    }
};
/**
 * 普通的生产器
 *
 * @param     $start
 * @param     $end
 * @param int $step
 */
$UsualFactory = function ($start, $end, $step = 1) {
    for ($i = $start; $i <= $end; $i += $step) {
        //var_dump($i);
    }
};

$SyncFactory(1, 100000);  //class Generator#2  PHP 协程没有resume关键字，而是“在使用的时候唤起”协程
// Generator 这个东西是从 generators返回的 http://php.net/manual/zh/class.generator.php
$UsualFactory(1, 100000);

/**
 * 从编程角度上看，协程的思想本质上就是控制流的主动让出（yield）和恢复（resume）机制，迭代器常被用来实现协程，
 * 所以大部分的语言实现的协程中都有yield关键字，比如Python、PHP、Lua。但也有特殊比如Go就使用的是通道来通信。
 */
foreach ($SyncFactory(1, 10) as $value) {
    echo $value . "\n";       // 我理解的是相当于开了100000协程跑这次输出操作
} // 那就尝试将它唤醒吧

/**
 * [中断点]
 * 我们从生成器认识协程需要认识到：生成器是一种具有中断点的函数，而yield构成了中断点。
 * 比如, 你调用$range->rewind()，那么xrange()里的代码就会运行到控制流第一次出现yield的地方，
 * 而函数内传递给yield语句的值，即为迭代的当前值，可以通过$xrange->current()获取。
 * [PHP中的协程实现]
 * PHP的协程支持是在迭代生成器的基础上，增加了可以回送数据给生成器的功能，从而达到双向通信即：
 * -------------------------------------------------------------
 *       >>>  生成器<---数据--->调用者 <<<
 * -------------------------------------------------------------
 */
echo '/* ------------------------- Yield接收与发送数据 ------------------------- */';
/**
 * 容器接收示例
 */
function container()
{
    $test = yield "Hello ";
    var_dump($test);
    $test = yield "World ";
    var_dump($test);
}

$container = container(); // 这里又进化成 Generator对象了,还记得SPL 那一坨么？ 传送门 [http://php.net/manual/zh/book.spl.php]

var_dump($container->key());     // 返回当前产生的键
var_dump($container->current()); // 返回当前产生的值

$container->next();              //  生成器继续执行 ,这个next 看下输出结果发现返回了个NULL  你打印什么了？
$container->send('强势占位');

var_dump($container->key());       // null
var_dump($container->current());   // null

if (!$container->valid()) {
    echo "我没有被关闭" . PHP_EOL;
}

echo '/* ------------------------- 协程与任务调度 ------------------------- */';

/**
 * yield指令提供了任务中断自身的一种方法，然后把控制交回给任务调度器。
 * 而PHP语言本身只是提供程序中断的功能，至于任务调度器需要我们自己实现，
 * 同时协程在运行多个其他任务时，yield还可以用来在任务和调度器之间进行通信。
 */

/**
 * PHP协程任务
 * 简单的定义具有任何ID标识的协程函数，如一个轻量级的协程函数示例代码
 * @form http://wiki.phpboy.net/doku.php?id=2017-07:54-PHP_Yield%E5%8D%8F%E7%A8%8B%E4%BB%8E%E5%85%A5%E9%97%A8%E5%88%B0%E7%B2%BE%E9%80%9A.md
 *
 * @version  1.0
 */
class Task
{
    protected $taskId;
    protected $coroutine;
    protected $sendValue        = null;
    protected $beforeFirstYield = true;

    /**
     * Task constructor.
     *
     * @param            $taskId
     * @param \Generator $coroutine
     */
    public function __construct($taskId, Generator $coroutine)
    {
        $this->taskId    = $taskId;
        $this->coroutine = $coroutine;
    }

    /**
     * setSendValue
     *
     * @param $sendValue
     */
    public function setSendValue($sendValue)
    {
        $this->sendValue = $sendValue;
    }

    /**
     * 跑起来的巨人
     *
     * @return mixed
     */
    public function run()
    {
        if ($this->beforeFirstYield) {
            $this->beforeFirstYield = false;
            return $this->coroutine->current();
        } else {
            $retval          = $this->coroutine->send($this->sendValue);
            $this->sendValue = null;
            return $retval;
        }
    }

    /**
     * getTaskId
     *
     * @return mixed
     */
    public function getTaskId()
    {
        return $this->taskId;
    }

    /**
     * 协程关了没？
     *
     * @return bool
     */
    public function isFinished()
    {
        return !$this->coroutine->valid();
    }
}

/**
 * PHP协程调度器
 * 简单来说，是可以在多个任务之间相互协调，及任务之间相互切换的一种进程资源的分配器。
 * 调度器的实现方式有多种,大致分为两类：一是，队列；二是，定时器
 *
 * @version  1.0
 */
class Scheduler
{
    protected $maxTaskId = 0;
    protected $taskMap   = []; // taskId => task
    protected $taskQueue;

    public function __construct()
    {
        // http://php.net/manual/zh/class.splqueue.php
        $this->taskQueue = new SplQueue();
    }

    /**
     * 创建一个task 开启一个协程
     *
     * @param \Generator $coroutine
     * @return int
     */
    public function newTask(Generator $coroutine)
    {
        $tid  = ++$this->maxTaskId;
        $task = new Task($tid, $coroutine);

        $this->taskMap[$tid] = $task;
        $this->schedule($task);
        return $tid;
    }

    /**
     * 队列入队
     *
     * @param \Task $task
     */
    public function schedule(Task $task)
    {
        $this->taskQueue->enqueue($task);
    }

    /**
     * 消费队列内容
     */
    public function run()
    {
        GLOBAL $i;
        while (!$this->taskQueue->isEmpty()) {
            // 出队列
            $task   = $this->taskQueue->dequeue();
            $retval = $task->run(); // 跑Task 中的 run

            echo "Scheduler runtime:" . ++$i . "  retval is:\n";
            if ($retval instanceof SystemCall) {
                $retval($task, $this);  // 如果为函数调用则这样跑起来
                continue;
            }

            if ($task->isFinished()) {  // 结束了就删掉
                unset($this->taskMap[$task->getTaskId()]);
            } else {
                $this->schedule($task); // 那就回炉重造
            }
        }
    }
}

class SystemCall
{
    protected $callback;

    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    /**
     * 以函数方式调用
     *
     * @param \Task      $task
     * @param \Scheduler $scheduler
     * @return mixed
     */
    public function __invoke(Task $task, Scheduler $scheduler)
    {
        $callback = $this->callback;
        return $callback($task, $scheduler);
    }
}

/**
 * newTask()方法创建一个新任务，然后把这个任务放入任务map数组里，接着它通过把任务放入任务队列里来实现对任务的调度。
 * 接着run()方法扫描任务队列，运行任务，如果一个任务结束了，那么它将从队列里删除，否则它将在队列的末尾再次被调度。
 */

function getTaskId()
{
    return new SystemCall(function (Task $task, Scheduler $scheduler) {
        $task->setSendValue($task->getTaskId());
        $scheduler->schedule($task);
    });
}

function task($max)
{
    $tid = (yield getTaskId());
    for ($i = 0; $i < $max; $i++) {
        echo "this is task  $tid iteration $i .\n";
        yield;
    }
}

$scheduler = new Scheduler();
$scheduler->newTask(task(3));
$scheduler->newTask(task(3));

//function testYield()
//{
//    yield getTaskId();
//}

//var_dump(testYield()->current());
$scheduler->run();

/*
function task1() {
    for ($i = 1; $i <= 10; ++$i) {
        echo "This is task 1 iteration $i.\n";
        yield;
    }
}

function task2() {
    for ($i = 1; $i <= 5; ++$i) {
        echo "This is task 2 iteration $i.\n";
        yield;
    }
}
$scheduler->newTask(task1(21));
$scheduler->newTask(task2(21));
$scheduler->run();
*/

// 最后回顾一下知识点,协程不一定能提高速度，但它一定能节约到内存
/**
 * 协程创建
 *
 * @param     $start
 * @param     $limit
 * @param int $step
 * @return \Generator
 */
function xrange($start, $limit, $step = 1)
{
    for ($i = $start; $i <= $limit; $i += $step) {
        yield $i;
    }
}

$max = 999999;
$c   = new codeStatus(true);
$c->timeStart();

$simpleStart = microtime(true);
foreach (range(1, $max, 2) as $number) {
}
$simpleEnd = microtime(true);
$c->timeEnd();
print_r($c->showStatus());

$c = new codeStatus(true);
$c->timeStart();
$start = microtime(true);
foreach (xrange(1, $max, 2) as $number) {
}

$end = microtime(true);
$c->timeEnd();
print_r($c->showStatus());


/**
 * 程序耗时统计
 *
 * @version  1.0
 */
class codeStatus
{
    /**
     * @param:boolen $time_type时间类型, boolen$show_m是否显示内存,
     * boolen$show_type,false是array,ture为json,$regmax是数据保留几位
     */
    public         $regmax;
    public         $runTime = 0;
    public         $time_type;
    public         $is_show_memory;
    public         $show_type;
    private static $t1;
    private static $t2;

    public function __construct($time_type = false, $show_m = true, $show_type = false, $regmax = 3)
    {
        $this->regmax         = $regmax;
        $this->is_show_memory = $show_m;
        $this->time_type      = $time_type;
        $this->show_type      = $show_type;
    }

    public function timeStart()
    {
        self::$t1 = microtime(true);
    }

    public function timeEnd()
    {
        self::$t2 = microtime(true);
    }

    private function getTime()
    {
        if (self::$t1 != '' && self::$t2 != '') {
            if ($this->time_type == false) {
                return '耗时' . round(self::$t2 - self::$t1, $this->regmax) . '秒';
            } else if ($this->time_type == true) {
                return '耗时' . round(self::$t2 - self::$t1, ($this->regmax + 3)) * 1000 . '毫秒';
            }
        } else {
            return "error param";
        }
    }

    private function getmemory()
    {
        $memory = (!function_exists('memory_get_usage')) ? '0' : round(memory_get_usage() / 1024, $this->regmax) . 'KB';
        return '占用内存：' . $memory;
    }

    public function showStatus()
    {
        if ($this->is_show_memory == true) {
            $arr = array (self::getTime(), self::getmemory());
        } else {
            $arr = array (self::getTime());
        }
        if ($this->show_type == false) {
            return $arr;
        } else {
            return json_encode($arr);
        }
    }


}
