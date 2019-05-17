<?php

/**
 * LinearList  线性表
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
class LinearOrder extends ArrayObject
{
    const PRECURSOR_KEY    = 0;
    const PRECURSOR_VALUE  = 1;

    const SUBSEQUENT_KEY   = 0;
    const SUBSEQUENT_VALUE = 1;

    const ASSIGN_KEY       = 0;
    const DEFAULT_KEY      = 1;

    const DELETE_KEY       = 0;
    const DELETE_VALUE     = 1;

    /**
     * @var array|mixed 线性表
     */
    public $oll;

    /**
     * LinearList constructor.  线性表初始化
     *
     * @param array $oll
     */
    public function __construct($oll = array ())
    {
        echo '---------------------------'.PHP_EOL;
        echo var_export($oll).PHP_EOL;
        echo '---------------------------'.PHP_EOL;
        parent::__construct($oll);
        $this->oll = $this->getIterator();
    }

    /**
     * @return void 清空线性表
     */
    public function __destruct()
    {
        unset($this->oll);
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
        return call_user_func_array(array($this, $name), $arguments);
    }

    /**
     * 判断线性表是否为空
     *
     * @return boolean 为空返回true,否则返回false
     */
    protected function isEmpty()
    {
        return $this->getLength() > 0 ? false : true;
    }

    /**
     * 返回线性表的长度
     *
     * @return int
     */
    protected function getLength()
    {
        return $this->oll->count();
    }

    /**
     * 返回线性表中下标为$key的元素
     *
     * @param mixed $key 线性表元素的下标
     * @return mixed
     */
    protected function getElement($key)
    {
        return $this->oll->offsetGet($key);
    }

    /**
     * 返回线性表中某个元素的位置
     *
     * @param mixed $value 线性表中某个元素的值
     * @return int 从1开始,如果返回-1表示不存在该元素
     */
    protected function getElementPosition($value)
    {
        $i = 0;
        $this->oll->rewind();
        while ($this->oll->valid()) {
            $i++;
            if (strcmp($value, $this->oll->current()) === 0) {
                return $i;
            }
            $this->oll-> next();
        }
        return -1;
    }

    /**
     * 返回线性表中某个元素的直接前驱元素
     *
     * @param string $value 线性表中某个元素的值
     * @param int    $tag   如果$value为下标则为1, 如果$value为元素值则为0
     * @return array|bool        array('value'=>...)直接前驱元素值，array('key'=>...)直接前驱元素下标
     */
    protected function getElementPrecursor($value, $tag = self::PRECURSOR_VALUE)
    {
        $i    = 0;
        $prev = null;
        $this->oll->rewind();
        while ($this->oll->valid()) {
            $key     = $this->oll->key();
            $current = $this->oll->current();
            if (strcmp($key, $value) === 0) {
                if ($i == 1) {
                    return false;
                }
                return array ('value' => $this->getElement($prev), 'key' => $prev);
            }
            if ($tag == self::PRECURSOR_VALUE) {
                if (strcmp($current, $value) === 0) {
                    if ($i == 1) {
                        return false;
                    }
                    return array ('value' => $this->getElement($prev), 'key' => $prev);
                }
            }
            $i++;
            $prev = $this->oll->key();
            $this->oll->next();
        }
    }

    /**
     * 返回某个元素的直接后继元素
     *
     * @param string   $value $value线性表中某个元素的值
     * @param int $tag   如果$value为下标则为1,如果$value为元素值则为0
     * @return array|bool       array('value'=>...)直接后继元素值，array('key'=>...)直接后继元素下标
     */
    protected function getElementSubsequent($value, $tag = self::SUBSEQUENT_KEY)
    {
        $i   = 0;
        $len = $this->getLength();
        $this->oll->rewind();
        while ($this->oll->valid()) {
            $key     = $this->oll->key();
            $current = $this->oll->current();
            if ($tag == self::SUBSEQUENT_KEY) {
                if (strcmp($key, $value) == 0) {
                    if ($i == $len) {
                        return false;
                    }
                    $this->oll->next();
                    return array ('value' => $this->oll->current(), 'key' => $this->oll->key());
                }
            }
            if ($tag == self::SUBSEQUENT_VALUE) {
                if (strcmp($current, $value) == 0) {
                    if ($i == $len) {
                        return false;
                    }
                    $this->oll->next();
                    return array ('value' => $this->oll->current(), 'key' => $this->oll->key());
                }
            }
            $i++;
            $this->oll->next();
        }
        return false;
    }

    /**
     * 在指定位置插入一个新的结点
     *
     * @param string $p     新结点插入位置,从0开始
     * @param string $value 线性表新结点的值
     * @param null   $key   线性表新结点的下标
     * @param int    $tag   是否指定新结点的下标,1表示默认下标,0表示指定下标
     * @return bool         插入成功返回true，失败返回false
     */
    protected function getInsertElement($p, $value, $key = null, $tag = self::DEFAULT_KEY)
    {
        $p   = (int)$p;
        $i   = 0;
        if ($p > $this->getLength() || $p < 1) {
            return false;
        }
        $this->oll->rewind();
        while ($this->oll->valid()) {
            if ($i != $p) {
                $i++;
                $this->oll->next();
            }
            switch ($tag){
                case self::DEFAULT_KEY:
                    $this->oll->append($value);
                    break 2;
                case self::ASSIGN_KEY:
                    $this->oll->offsetSet($key, $value);
                    break 2;
            }
        }
        return true;
    }

    /**
     * 根据元素位置返回线性表中的某个元素
     *
     * @param mixed $position 元素位置从1开始
     * @return array|bool  array('value'=>...)元素值，array('key'=>...)元素下标
     */
    protected function getElemForPos($position)
    {
        $i        = 0;
        $len      = $this->getLength();
        $position = (int)$position;
        if ($position > $len || $position < 1) {
            return false;
        }
        $this->oll->rewind();
        while ($this->oll->valid()) {
            if ($i == $position) {
                return array ('value' => $this->oll->current(), 'key' => $this->oll->key());
            }
            $i++;
            $this->oll->next();
        }
    }

    /**
     * 根据下标或者元素值删除线性表中的某个元素
     *
     * @param mixed $value 元素下标或者值
     * @param int   $tag   0表示$value为下标，1表示$value为元素值
     * @return bool 成功返回true,失败返回false
     */
    protected function getDeleteElement($value, $tag = self::DELETE_KEY)
    {
        $this->oll->rewind();
        while ($this->oll->valid())
        {
            $key     = $this->oll->key();
            $current = $this->oll->current();
            if ($tag ==  self::DELETE_KEY) {
                if (strcmp($key, $value) === 0) {
                    $this->oll->offsetUnset($key);
                }
            }
            if ($tag == self::DELETE_VALUE) {
                if (strcmp($current, $value) === 0) {
                    $this->oll->offsetUnset($key);
                }
            }
            $this->oll->next();
        }
        return true;
    }

    /**
     * 根据元素位置删除线性表中的某个元素
     *
     * @param int $position 元素位置从1开始
     * @return bool 成功返回true,失败返回false
     */
    protected function getDeleteEleForPos($position)
    {
        $len      = $this->getLength();
        $i        = 0;
        $position = (int)$position;
        if ($position > $len || $position < 1) {
            return false;
        }
        $this->oll->rewind();
        while ($this->oll->valid()) {
            $key     = $this->oll->key();
            if ($i == $position) {
                $this->oll->offsetUnset($key);
            }
            $i++;
            $this->oll->next();
        }
        return true;
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
        if(isset($debug['args'][1])){
            foreach ($debug['args'][1] as &$value){
                if( is_array($value )){
                    $args .= json_encode($debug['args'][1]).', ';
                }else{
                    $args .= $value.', ';
                }
            }
        }
        $args = trim($args,', ');
        echo "\t".$reflection->getDocComment() . PHP_EOL;
        echo "\t{$debug['args'][0]}({$args})\n" . PHP_EOL;
    }
}

$echo = function ($str, $action) {
    echo $str . "\t->\t" . var_export($action, true) . PHP_EOL;
    echo "--------------------------- " . PHP_EOL;
};

$oll = new LinearOrder(array ('name' => 'Jack', 10, "age", 'msg' => 10, 666));
$echo('判断线性表是否为空', $oll->isEmpty());
$echo('返回线性表的长度', $oll->getLength());
$echo('根据下标返回线性表中的某个元素', $oll->getElement(1));
$echo('返回线性表中某个元素的位置', $oll->getElementPosition(666));
$echo('返回线性表中某个元素的直接前驱元素', $oll->getElementPrecursor(666, LinearOrder::PRECURSOR_VALUE));
$echo('返回线性表中某个元素的直接后继元素', $oll->getElementSubsequent(0, LinearOrder::SUBSEQUENT_KEY));
$echo('根据元素位置返回线性表中的某个元素', $oll->getElemForPos(2));
$echo('根据下标或者元素值删除线性表中的某个元素', $oll->getDeleteElement('name', LinearOrder::DELETE_KEY));
$echo('在指定位置插入一个新的结点', $oll->getInsertElement(3, "插入新节点", "qzone", LinearOrder::ASSIGN_KEY));
$echo('$oll->oll的内容 ', $oll->oll);