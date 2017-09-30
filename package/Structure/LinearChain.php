<?php

/**
 * LinearChain  线性表 - 单链表存储
 *
 * @author   Pu ShaoWei <pushaowei0727@gmail.com>
 * @date     2017/9/29
 * @license  MIT
 * -------------------------------------------------------------
 * [基本说明]
 * =======
 * 线性表中数据元素之间的关系是一对一的关系，即除了第一个和最后一个数据元素之外，其它数据元素都是首尾相接的
 * 注意，这句话只适用大部分线性表，而不是全部。比如，循环链表逻辑层次上也是一种线性表（存储层次上属于链式存储）
 * 但是把最后一个数据元素的尾指针指向了首位结点）。
 * [基本特点]
 * =======
 *   - 存在一个唯一的被称为`第一个`的数据元素
 *   - 存在一个唯一的被称为`最后一个`的数据元素
 *   - 除第一个元素外，每个元素均有唯一一个直接前驱
 *   - 除最后一个元素外，每个元素均有唯一一个直接后继
 * -------------------------------------------------------------
 * [定义]
 * =======
 * 线性表(Linear List) ：是由n(n≧0)个数据元素(结点) [a1，a2， …an] 组成的有限序列。数据元素是一个抽象的符号，其具体含义在不同的情况下一般不同。
 * 该序列中的所有结点具有相同的数据类型。其中数据元素的个数n称为线性表的长度。
 * 当n=0时，称为空表。
 * 当n>0时，将非空的线性表记作： (a1，a2，…an) a1称为线性表的第一个(首)结点，an称为线性表的最后一个(尾)结点。
 * -------------------------------------------------------------
 * [线性表单链存储]
 * =======
 * 用一组任意的存储单元存储线性表中的数据元素，用这种方法存储的线性表简称线性链表。
 * -------------------------------------------------------------
 * [单链存储的线性表的特点]
 * =======
 *    - 存储链表中结点的一组任意的存储单元可以是连续的，也可以是不连续的，甚至是零散分布在内存中的任意位置上
 *    - 链表中结点的逻辑顺序和物理顺序不一定相同
 * -------------------------------------------------------------
 * @param array
 */
class LinearChain
{
    /**
     * @var  string  下一结点指针
     */
    public $next;

    /**
     * @var string 头结点数据
     */
    public $elem;

    /**
     * @var int 链表长度
     */
    public $length;

    /**
     * LinearChain constructor.  线性表初始化
     */
    public function __construct()
    {
        $this->next = $this->elem = $this->length = null;
    }

    /**
     * 清空单链表
     *
     * @return mixed
     */
    public function clearChain()
    {
        if ($this->length <= 0) {
            return false;
        }
        while ($this->next != null) {
            $q          = $this->next->next;
            $this->next = null;
            unset($this->next);
            $this->next = $q;
        }
        $this->length = 0;
    }

    /**
     * 返回单链表长度
     *
     * @return mixed
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * 判断单链表是否为空
     *
     * @return bool 为空返回true,不为空返回false
     */
    public function getIsEmpty()
    {
        return $this->length == 0 && $this->next == null;
    }

    /**
     * 头插入法建表
     *
     * @param array $arr 建立单链表的数据
     * @return mixed
     */
    protected function getHeadCreateChain(array $arr)
    {
        $this->clearChain();
        $iterator = $this->generator($arr);
        $iterator->rewind();
        while ($iterator->valid()) {
            $node       = new stdClass();
            $node->elem = $iterator->current();
            $node->next = $this->next;
            $this->next = $node;
            $this->length++;
            $iterator->next();
        }
        return $this->next;
    }

    /**
     * 尾插入法建表
     *
     * @param array $arr 建立单链表的数据
     * @return mixed
     */
    protected function getTailCreateChain(array $arr)
    {
        $this->clearChain();
        $self     = $this;
        $iterator = $this->generator($arr);
        $iterator->rewind();
        while ($iterator->valid()) {
            $node       = new stdClass();
            $node->elem = $iterator->current();
            $node->next = $self->next;
            $self->next = $node;
            $self       = $node;
            $iterator->next();
            $this->length++;
        }
        return $this->next;
    }

    /**
     * 返回第$i个元素
     *
     * @param int $i 元素位序，从1开始
     * @return mixed
     */
    protected function getElemForPos($i)
    {
        $i = (int)$i;
        if ($i > $this->length || $i < 1) {
            return null;
        }
        $mark = 1;
        $self = $this->next;
        while ($mark < $i) {
            $box  = $self->next;
            $self = $box;
            $mark++;
        }
        return $self;
    }

    /**
     * 查找单链表中是否存在某个值的元素
     * 如果有返回该元素结点，否则返回null
     *
     * @param mixed $value 查找的值
     * @return mixed
     */
    protected function getElemIsExist($value)
    {
        $self = $this;
        while ($self->next != null && strcmp($self->elem, $value) !== 0) {
            $self = $self->next;
        }
        if (strcmp($self->elem, $value) === 0) {
            return $self;
        }
        return null;
    }

    /**
     * 查找单链表中是否存在某个值的元素
     * 如果有返回该元素位序，否则返回-1
     *
     * @param mixed $value 查找的值
     * @return mixed
     */
    protected function getElemPosition($value)
    {
        $self = $this;
        $mark = 0;
        while ($self->next != null && strcmp($self->elem, $value) !== 0) {
            $self = $self->next;
            $mark++;
        }
        if (strcmp($self->elem, $value) === 0) {
            return $mark;
        }
        return -1;
    }

    /**
     * 单链表的插入操作
     *
     * @param int   $key   插入元素的位序，即在什么位置插入新的元素,从1开始
     * @param mixed $value 插入的新的元素值
     * @return boolean 插入成功返回true，失败返回false
     */
    protected function getInsertElem($key, $value)
    {
        if ($key > $this->length || $key < 1) {
            return false;
        }
        $mark = 1;
        $self = $this;
        while ($self->next != null && $mark < $key) {
            $self = $self->next;
            $mark++;
        }
        $node       = new stdClass();
        $node->elem = $value;
        $node->next = $self->next;
        $self->next = $node;
        $this->length++;
        return true;
    }

    /**
     * 遍历单链表中的所有元素
     *
     * @return array 包括单链中的所有元素
     */
    protected function getAllElem()
    {
        $result = array ();
        if ($this->getIsEmpty()) {
            return $result;
        }
        $self = $this->next;
        while ($self->next != null) {
            array_push($result, $self->elem);
            $self = $self->next;
        }
        array_push($result, $self->elem);
        return $result;
    }

    /**
     * 根据Key 删除单链中的元素
     *
     * @param int $key 元素位序
     * @return boolean 删除成功返回true,失败返回false
     */
    protected function getDeleteElem($key)
    {
        $key = (int)$key;
        if ($key > $this->length || $key < 1) {
            return false;
        }
        $self = $this;
        $mark = 1;
        while ($mark < $key) {
            $self = $self->next;
            $mark++;
        }
        $node       = $self->next;
        $self->next = $node->next;
        $this->length--;
        return true;
    }

    /**
     * 删除单链表中值为$value的前 $i($i>=1) 个结点
     *
     * @param mixed mixed 待查找的值
     * @param $i    mixed 删除的次数，即删除查找到的前$i个
     * @return mixed
     */
    protected function getDeleteElemForValue($value, $i = 1)
    {
        if ($i > 1) {
            $this->getDeleteElemForValue($value, $i - 1);
        }
        $vp = $this->getElemPosition($value);
        $this->getDeleteElem($vp);
        return $this->getAllElem();
    }

    /**
     * 删除单链表所有重复的值
     *
     * @return mixed
     */
    protected function getElemUnique()
    {
        if ($this->getIsEmpty()) {
            return $this->getAllElem();
        }
        $self = $this;
        while ($self->next != null) {
            $node = $self->next;
            $ptr  = $self;
            while ($node->next != null) {
                if (strcmp($self->elem, $node->elem) === 0) {
                    $ptr->next = $node->next;
                    unset($node->next);
                    $node = $ptr->next;
                    $this->length--;
                } else {
                    $ptr  = $node;
                    $node = $node->next;
                }
            }
            $self = $self->next;
        }
        return $this->getAllElem();
    }

    /**
     * 迭代器生产
     *
     * @param array $info
     * @return \ArrayIterator
     */
    protected function generator(array $info)
    {
        return (new ArrayObject($info))->getIterator();
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
     * 调试用请无视！
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

$echo     = function ($str, $action) {
    echo $str . "\t->\t" . var_export($action, true) . PHP_EOL;
    echo "--------------------------- " . PHP_EOL;
};
$personal = array (
    "One",
    "Two",
    "Three",
    "Four",
    "Five",
);

$oll = new LinearChain();
$echo('头插入链表数据', $oll->getHeadCreateChain($personal));
$echo('尾插入链表数据', $oll->getTailCreateChain($personal));
$echo('返回第二个数据', $oll->getElemForPos(2));
$echo('是否存在Tow呢？', $oll->getElemIsExist("Two"));
$echo('One 的下标示是', $oll->getElemPosition("One"));
$echo('从2号位插入一个Four', $oll->getInsertElem(2, "Four"));
$echo('遍历整个单链表', $oll->getAllElem());
$echo('删除第一个元素', $oll->getDeleteElem(1));
$echo('删除Three 前一个', $oll->getDeleteElemForValue("Three", 1));
$echo('去重链表中重复值', $oll->getElemUnique());