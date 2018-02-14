<?php

/**
 * 双向队列
 *
 * @author   Pu ShaoWei <marco0727@gamil.com>
 * @date     2018/1/11
 * @license  MIT
 * -------------------------------------------------------------
 * 双向队列的实现及应用
 * -------------------------------------------------------------
 * 思路分析： 考察PHP几个内置数组的函数
 * 双向队列是一种双向开口的连续线性空间，可以高效的在头尾两端插入和删除元素
 */

// +--------------------------------------------------------------------------
// | 解题方式    | 这儿，可能有用的解决方案
// +--------------------------------------------------------------------------

class BidirectionalQueue
{
    /**
     * @var array
     */
    public $queue     = [];
    public $maxLength = 0;  // 对列最大长度，0表示不限
    public $type      = 0;  // 对列类型
    public $frontNum  = 0;  // 前端插入的数量
    public $rearNum   = 0;  // 后端插入的数量

    const C_AT_BOTH_ENDS        = 1;   // 1:两端均可输入输出
    const C_FRONT_ONLY_INPUT    = 2;   // 2:前端只能输入，后端可输入输出
    const C_FRONT_ONLY_OUTPUT   = 3;   // 3:前端只能输出，后端可输入输出
    const C_BACK_ONLY_INPUT     = 4;   // 4:后端只能输入，前端可输入输出
    const C_BACK_ONLY_OUTPUT    = 5;   // 5:后端只能输出，前端可输入输出
    const C_BOTH_WAY_ONLY_INPUT = 6;   // 6:两端均可输入输出，在哪端输入只能从哪端输出

    /**
     * BidirectionalQueue 初始化.
     *
     * @param int $type
     * @param int $maxLength
     */
    public function __construct($type = self::C_AT_BOTH_ENDS, $maxLength = 0)
    {
        var_dump($this->getConfig());
        $this->_type      = in_array($type, [1, 2, 3, 4, 5, 6]) ? $type : self::C_AT_BOTH_ENDS;
        $this->_maxLength = intval($maxLength);
    }

    /**
     * addFirst   前端入列
     *
     * @param $item
     * @return int
     */
    public function addFirst($item)
    {
        return array_unshift($this->queue, $item);
    }

    /**
     * addLast 尾部入列
     *
     * @param $item
     * @return int
     */
    public function addLast($item)
    {
        return array_push($this->queue, $item);
    }

    /**
     * removeFirst 头部出列
     *
     * @return mixed
     */
    public function removeFirst()
    {
        return array_shift($this->queue);
    }

    /**
     * removeLast 尾部出列
     *
     * @return mixed
     */
    public function removeLast()
    {
        return array_pop($this->queue);
    }

    /**
     * 清空队列
     */
    public function makeEmpty()
    {
        unset($this->queue);
    }

    /**
     * 获取列头
     *
     * @return mixed
     */
    public function getFirst()
    {
        return reset($this->queue);
    }

    /**
     * 获取列尾
     *
     * @return mixed
     */
    public function getLast()
    {
        return end($this->queue);
    }

    /**
     * 获取长度
     *
     * @return int
     */
    public function getLength()
    {
        return count($this->queue);
    }

    /**
     * 获取配置常量
     */
    protected function getConfig()
    {
        return [
            self::C_AT_BOTH_ENDS,          // 1:两端均可输入输出
            self::C_FRONT_ONLY_INPUT,      // 2:前端只能输入，后端可输入输出
            self::C_FRONT_ONLY_OUTPUT,     // 3:前端只能输出，后端可输入输出
            self::C_BACK_ONLY_INPUT,       // 4:后端只能输入，前端可输入输出
            self::C_BACK_ONLY_OUTPUT,      // 5:后端只能输出，前端可输入输出
            self::C_BOTH_WAY_ONLY_INPUT,   // 6:两端均可输入输出，在哪端输入只能从哪端输出
        ];
    }
}

// +--------------------------------------------------------------------------
// | 方案测试    | php `this.php` || PHPStorm -> 右键 -> Run `this.php`
// +--------------------------------------------------------------------------


new BidirectionalQueue();