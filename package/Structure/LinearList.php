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
 * 把线性表的结点按逻辑顺序依次存放在一组地址连续的存储单元里，用这种方法存储的线性表简称顺序表。
 * -------------------------------------------------------------
 * [顺序存储的线性表的特点]
 * =======
 *    - 线性表的逻辑顺序与物理顺序一致；
 *    - 数据元素之间的关系是以元素在计算机内“物理位置相邻”来体现。
 * -------------------------------------------------------------
 * @param array
 */
class LinearList
{
    const PRECURSOR_KEY   = 0;
    const PRECURSOR_VALUE = 1;

    const SUBSEQUENT_KEY   = 0;
    const SUBSEQUENT_VALUE = 1;

    const ASSIGN_KEY  = 0;
    const DEFAULT_KEY = 1;


    /**
     * @var array|mixed 顺序表
     */
    public $oll;

    /**
     * LinearList constructor.  顺序表初始化
     *
     * @param array $oll
     */
    public function __construct($oll = array ())
    {
        $this->oll = $oll;
    }

    /**
     * @return void 清空顺序表
     */
    public function __destruct()
    {
        $this->preDispatch(); // 调试用，请无视
        foreach ($this->oll as $key => $value) {
            unset($this->oll[$key]);
        }
    }

    /**
     * 判断顺序表是否为空
     *
     * @return boolean 为空返回true,否则返回false
     */
    public function isEmpty()
    {
        $this->preDispatch(); // 调试用，请无视
        return count($this->oll) > 0 ? false : true;
    }

    /**
     * 返回顺序表的长度
     *
     * @return int
     */
    public function getLength()
    {
        $this->preDispatch(); // 调试用，请无视
        return count($this->oll);
    }

    /**
     * 返回顺序表中下标为$key的元素
     *
     * @param mixed $key 顺序表元素的下标
     * @return mixed
     */
    public function getElement($key)
    {
        $this->preDispatch(); // 调试用，请无视
        return $this->oll[$key];
    }

    /**
     * 返回顺序表中某个元素的位置
     *
     * @param mixed $value 顺序表中某个元素的值
     * @return int 从1开始,如果返回-1表示不存在该元素
     */
    public function getElementPosition($value)
    {
        $this->preDispatch(); // 调试用，请无视
        $i = 0;
        foreach ($this->oll as $val) {
            $i++;
            if (strcmp($value, $val) === 0) {
                return $i;
            }
        }
        return -1;
    }

    /**
     * 返回顺序表中某个元素的直接前驱元素
     *
     * @param string $value 顺序表中某个元素的值
     * @param int    $tag   如果$value为下标则为1, 如果$value为元素值则为0
     * @return array|bool        array('value'=>...)直接前驱元素值，array('key'=>...)直接前驱元素下标
     */
    public function getElementPrecursor($value, $tag = self::PRECURSOR_VALUE)
    {
        $this->preDispatch(); // 调试用，请无视
        $i = 0;
        foreach ($this->oll as $key => $val) {
            $i++;
            if ($tag == self::PRECURSOR_VALUE) {
                if (strcmp($key, $value) === 0) {
                    if ($i == 1) {
                        return false;
                    }
                    prev($this->oll);
                    prev($this->oll);
                    return array ('value' => current($this->oll), 'key' => key($this->oll));
                }
            }

            if ($tag == self::PRECURSOR_KEY) {
                if (strcmp($val, $value) === 0) {
                    if ($i == 1) {
                        return false;
                    }
                    prev($this->oll);
                    prev($this->oll);
                    return array ('value' => current($this->oll), 'key' => key($this->oll));
                }
            }
        }
    }

    /**
     * 返回某个元素的直接后继元素
     *
     * @param     $value $value顺序表中某个元素的值
     * @param int $tag   如果$value为下标则为1,如果$value为元素值则为0
     * @return array|bool       array('value'=>...)直接后继元素值，array('key'=>...)直接后继元素下标
     */
    public function getElementSubsequent($value, $tag = self::SUBSEQUENT_KEY)
    {
        $this->preDispatch(); // 调试用，请无视
        $i   = 0;
        $len = count($this->oll);
        foreach ($this->oll as $key => $val) {
            $i++;
            if ($tag == self::SUBSEQUENT_KEY) {
                if (strcmp($key, $value) == 0) {
                    if ($i == $len) {
                        return false;
                    }
                    return array ('value' => current($this->oll), 'key' => key($this->oll));
                }
            }
            if ($tag == self::SUBSEQUENT_VALUE) {
                if (strcmp($val, $value) == 0) {
                    if ($i == $len) {
                        return false;
                    }
                    return array ('value' => current($this->oll), 'key' => key($this->oll));
                }
            }
        }
        return false;
    }

    /**
     * 在指定位置插入一个新的结点
     *
     * @param string $p     新结点插入位置,从1开始
     * @param string $value 顺序表新结点的值
     * @param null   $key   顺序表新结点的下标
     * @param int    $tag   是否指定新结点的下标,1表示默认下标,0表示指定下标
     * @return bool        插入成功返回true，失败返回false
     */
    public function getInsertElement($p, $value, $key = null, $tag = self::DEFAULT_KEY)
    {
        $this->preDispatch(); // 调试用，请无视

        $p   = (int)$p;
        $len = count($this->oll);
        $oll = array ();
        $i   = 0;
        if ($p > $len || $p < 1) {
            return false;
        }

        foreach ($this->oll as $k => $v) {
            $i++;
            if ($i == (int)$p) {
                if ($tag == self::DEFAULT_KEY) {
                    $oll[] = $value;
                } else if ($tag == self::ASSIGN_KEY) {
                    $keys = array_keys($oll);
                    $j    = 0;
                    if (is_int($key)) {
                        while (in_array($key, $keys, true)) {
                            $key++;
                        }
                    } else {
                        while (in_array($key, $keys, true)) {
                            $j++;
                            $key .= (string)$j;
                        }
                    }
                    $oll[$key] = $value;
                } else {
                    return false;
                }

                $key  = $k;
                $j    = 0;
                $keys = array_keys($oll);
                if (is_int($key)) {
                    $oll[] = $v;
                } else {
                    while (in_array($key, $keys, true)) {
                        $j++;
                        $key .= (string)$j;
                    }
                    $oll[$key] = $v;
                }
            } else {
                if ($i > $p) {
                    $key  = $k;
                    $j    = 0;
                    $keys = array_keys($oll);
                    if (is_int($key)) {
                        $oll[] = $v;
                    } else {
                        while (in_array($key, $keys, true)) {
                            $j++;
                            $key .= (string)$j;
                        }
                        $oll[$key] = $v;
                    }
                } else {
                    if (is_int($k)) {
                        $oll[] = $v;
                    } else {
                        $oll[$k] = $v;
                    }
                }
            }
        }
        $this->oll = $oll;
        return true;
    }

    /**
     * 根据元素位置返回顺序表中的某个元素
     *
     * @param mixed $position 元素位置从1开始
     * @return array|bool  array('value'=>...)元素值，array('key'=>...)元素下标
     */
    public function getElemForPos($position)
    {
        $this->preDispatch(); // 调试用，请无视

        $i        = 0;
        $len      = count($this->oll);
        $position = (int)$position;

        if ($position > $len || $position < 1) {
            return false;
        }

        foreach ($this->oll as $value) {
            $i++;
            if ($i == $position) {
                return array ('value' => current($this->oll), 'key' => key($this->oll));
            }
        }
    }

    /**
     * 根据下标或者元素值删除顺序表中的某个元素
     *
     * @param mixed $value 元素下标或者值
     * @param int   $tag   1表示$value为下标，2表示$value为元素值
     * @return bool 成功返回true,失败返回false
     */
    public function getDeleteElement($value, $tag = 1)
    {
        $this->preDispatch(); // 调试用，请无视

        $len = count($this->oll);
        $oll = array ();
        foreach ($this->oll as $k => $v) {
            if ($tag == 1) {
                if (strcmp($k, $value) === 0) {
                } else {
                    if (is_int($k)) {
                        $oll[] = $v;
                    } else {
                        $oll[$k] = $v;
                    }
                }
            }

            if ($tag == 2) {
                if (strcmp($v, $value) === 0) {
                } else {
                    if (is_int($k)) {
                        $oll[] = $v;
                    } else {
                        $oll[$k] = $v;
                    }
                }
            }
        }
        $this->oll = $oll;
        if (count($this->oll) == $len) {
            return false;
        }
        return true;
    }

    /**
     * 根据元素位置删除顺序表中的某个元素
     *
     * @param int $position 元素位置从1开始
     * @return bool 成功返回true,失败返回false
     */
    public function getDeleteEleForPos($position)
    {
        $this->preDispatch(); // 调试用，请无视

        $len      = count($this->oll);
        $i        = 0;
        $position = (int)$position;
        $oll      = array ();
        if ($position > $len || $position < 1) {
            return false;
        }

        foreach ($this->oll as $k => $v) {
            $i++;
            if ($i == $position) {
            } else {
                if (is_int($k)) {
                    $oll[] = $v;
                } else {
                    $oll[$k] = $v;
                }
            }
        }

        $this->oll = $oll;
        if (count($this->oll) == $len) {
            return false;
        }
        return true;
    }

    /**
     * 调试用
     *
     * @param bool $isDebug
     * @return mixed
     */
    public function preDispatch($isDebug = true)
    {
        if(!$isDebug){
            return false;
        }
        $debug = debug_backtrace()[1];
        $args  = isset($debug['args']) ? implode(',',$debug['args']) : "";
        echo "{$debug['function']}({$args})\n".PHP_EOL;
    }
}

$echo = function () {
    $args = func_get_args();
    echo $args[0] . "\t->\t" . var_export($args[1], true) . PHP_EOL;
    echo "--------------------------- " . PHP_EOL;
};

$oll = new LinearList(array ('name' => 'Jack', 10, "age", 'msg' => 10, 455));
$echo('判断顺序表是否为空,返回false说明不为空', $oll->isEmpty());
$echo('返回顺序表的长度 返回6', $oll->getLength());
$echo('根据下标返回顺序表中的某个元素', $oll->getElement(1));
$echo('返回顺序表中某个元素的位置', $oll->getElementPosition(455));
$echo('返回顺序表中某个元素的直接前驱元素', $oll->getElementPrecursor(455, 2));
$echo('返回顺序表中某个元素的直接后继元素', $oll->getElementSubsequent(455, 2));
$echo('根据元素位置返回顺序表中的某个元素', $oll->getElemForPos(2));
$echo('根据下标或者元素值删除顺序表中的某个元素', $oll->getDeleteElement('name', $tag = 2));
$echo('根据元素位置删除顺序表中的某个元素', $oll->getDeleteEleForPos(1));
$echo('在指定位置插入一个新的结点', $oll->getInsertElement(3, "插入新节点", $key = "msg", $tag = 2));
$echo('$oll->oll的内容 ', $oll->oll);