<?php

/**
 * StackExample
 *
 * @author   Pu ShaoWei <pushaowei0727@gmail.com>
 * @date     2017/10/16
 * @license  MIT
 * -------------------------------------------------------------
 * [栈的定义]
 * =======
 * 栈(Stack)：是限制在表的一端进行插入和删除操作的线性表。又称为后进先出LIFO (Last In First Out)或先进后出FILO (First In Last Out)线性表。
 * 栈顶(Top)：允许进行插入、删除操作的一端，又称为表尾。用栈顶指针(top)来指示栈顶元素。
 * 栈底(Bottom)：是固定端，又称为表头。
 * 空栈：当表中没有元素时称为空栈。
 * [栈的实现方式]
 * =======
 *   - 硬堆栈：利用CPU中的某些寄存器组或类似的硬件或使用内存的特殊区域来实现。这类堆栈容量有限，但速度很快；
 *   - 软堆栈：这类堆栈主要在内存中实现。堆栈容量可以达到很大。在实现方式上，又有动态方式和静态方式两种
 * -------------------------------------------------------------
 * [定义]
 * =======
 * 线性表(Linear List) ：是由n(n≧0)个数据元素(结点) [a1，a2， …an] 组成的有限序列。数据元素是一个抽象的符号，其具体含义在不同的情况下一般不同。
 * 该序列中的所有结点具有相同的数据类型。其中数据元素的个数n称为线性表的长度。
 * 当n=0时，称为空表。
 * 当n>0时，将非空的线性表记作： (a1，a2，…an) a1称为线性表的第一个(首)结点，an称为线性表的最后一个(尾)结点。
 * -------------------------------------------------------------
 * [线性表顺序存储]
 * =======
 * 把线性表的结点按逻辑顺序依次存放在一组地址连续的存储单元里，用这种方法存储的线性表简称线性表。
 * -------------------------------------------------------------
 * [顺序存储的线性表的特点]
 * =======
 *    - 线性表的逻辑顺序与物理顺序一致；
 *    - 数据元素之间的关系是以元素在计算机内“物理位置相邻”来体现。
 * -------------------------------------------------------------
 * @param array
 */
class StackExample
{
    /**
     * @var null   栈元素
     */
    protected $elem;
    /**
     * @var null 下一个节点
     */
    protected $next;
    /**
     * @var int 栈长度
     */
    protected $length;

    /**
     * 初始化栈
     * StackExample constructor.
     */
    public function __construct()
    {
        $this->elem   = $this->next = null;
        $this->length = 0;
    }

    /**
     * 判断栈是否空栈
     *
     * @return boolean 如果为空栈返回true,否则返回false
     */
    protected function getIsEmpty()
    {
        return $this->elem ? false : true;
    }

    /**
     * 将所有元素出栈
     *
     * @return array 返回所有栈内元素
     */
    protected function getAllPopStack()
    {
        $result = array ();
        if ($this->getIsEmpty()) {
            return $result;
        }
        while ($this->elem != null) {
            $result[]   = $this->elem->elem;
            $this->elem = $this->elem->next;
        }
        $this->length = 0;
        return $result;
    }

    /**
     * 返回栈内元素个数
     *
     * @return int
     */
    protected function getLength()
    {
        return $this->length;
    }

    /**
     * 元素进栈
     *
     * @param mixed $element 进栈元素值
     * @return void
     **/
    protected function setPushStack($element)
    {
        $stack       = new stdClass();
        $stack->elem = $element;
        $stack->next = $this->elem;
        $this->elem  = &$stack;
        $this->length++;
    }

    /**
     * 元素出栈
     *
     * @return boolean 出栈成功返回true,否则返回false
     **/
    protected function getPopStack()
    {
        if ($this->getIsEmpty()) {
            return false;
        }
        $node       = $this->elem;
        $this->elem = $node->next;
        $this->length--;
    }

    /**
     * 仅返回栈内所有元素
     *
     * @return array 栈内所有元素组成的一个数组
     */
    protected function getAllElem()
    {
        $result = array ();
        if ($this->getIsEmpty()) {
            return $result;
        }
        $node = $this->elem;
        while ($node != null) {
            $result[] = $node->elem;
            $node     = $node->next;
        }
        return $result;
    }

    /**
     * 返回栈内某个元素的个数
     *
     * @param mixed $elem 待查找的元素的值
     * @return int
     **/
    protected function getCountForElem($elem)
    {
        $result = $this->getAllElem();
        $count  = 0;
        foreach ($result as $value) {
            if ($elem === $value) {
                $count++;
            }
        }
        return $count;
    }

    /**
     * 调试用请无视
     *
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        $this->preDispatch(); // 调试用，请无视
        return call_user_func_array(array ($this, $name), $arguments);
    }

    /**
     * 调试用
     *
     * @param bool $isDebug
     * @return bool
     */
    protected function preDispatch($isDebug = true)
    {
        if (!$isDebug) {
            return false;
        }
        $debug      = debug_backtrace()[1];
        $reflection = new ReflectionMethod($this, $debug['args'][0]);
        $args       = '';
        if (isset($debug['args'][1])) {
            foreach ($debug['args'][1] as &$value) {
                if (is_array($value)) {
                    $args .= json_encode($debug['args'][1]) . ', ';
                } else {
                    $args .= $value . ', ';
                }
            }
        }
        $args = trim($args, ', ');
        echo "\t" . $reflection->getDocComment() . PHP_EOL;
        echo "\t{$debug['args'][0]}({$args})\n" . PHP_EOL;
    }
}

$echo = function ($str, $action) {
    echo $str . "\t->\t" . var_export($action, true) . PHP_EOL;
    echo "--------------------------- " . PHP_EOL;
};

//$stack = new StackExample();
//$stack->setPushStack('First');
//$stack->setPushStack('Second');
//$echo('返回栈内所有元素', $stack->getAllElem());
//$stack->setPushStack('Third');
//$echo('返回栈内所有元素', $stack->getAllElem());
//$stack->getPopStack();
//$echo('返回栈内所有元素', $stack->getAllElem());
