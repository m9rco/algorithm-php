<?php

/**
 * 斐波那契查询
 *
 * @author   Pu ShaoWei <pushaowei0727@gmail.com>
 * @date     2017/8/23
 * @license  MIT
 * -------------------------------------------------------------
 * 思路分析：斐波那契查找 利用黄金分割原理
 * -------------------------------------------------------------
 * $num == $container[$mid],直接返回
 * $num <  $container[$mid],新范围是第 $low   个到 $mid-1 个，此时范围个数为 produced($key-1)-1 个
 * $num >  $container[$mid],新范围是第 $mid+1 个到 $high  个，此时范围个数为 produced($key-2)-1 个
 */


// +--------------------------------------------------------------------------
// | 解题方式
// +--------------------------------------------------------------------------

class FibonacciQuery
{
    /**
     * FibonacciQuery constructor.
     *
     * @param array $container
     * @param       $num
     */
    public function __construct(array $container, $num)
    {
        $count = count($container);
        $lower = $key = $result = 0;
        $high  = $count - 1;
        //计算$count位于斐波那契数列的位置
        while ($count > ($this->produced($key) - 1)) {
            $key++;
        }
        //将不满的数值补全，补的数值为数组的最后一位
        for ($j = $count; $j < $this->produced($key) - 1; $j++) {
            $container[$j] = $container[$count - 1];
        }
        //查找开始
        while ($lower <= $high) {
            //计算当前分隔的下标
            $mid = $lower + $this->produced($key - 1) - 1;
            if ($num < $container[$mid]) {
                $high = $mid - 1;
                $key  -= 1;    //斐波那契数列数列下标减一位
            } else if ($num > $container[$mid]) {
                $lower = $mid + 1;
                $key   -= 2;    //斐波那契数列数列下标减两位
            }
            if ($mid <= $count - 1) {
                $result = $mid;
                break;
            } else { //这里$mid大于$count-1说明是补全数值，返回$count-1
                $result = $count - 1;
                break;
            }
        }
        var_dump($result);
    }

    /**
     * 创建一个生产斐波那契数列
     *
     * @param $length
     * @return int
     */
    public function produced($length)
    {
        if ($length < 2) {
            return ($length == 0 ? 0 : 1);
        }
        return $this->produced($length - 1) + $this->produced($length - 2);
    }
}

// +--------------------------------------------------------------------------
// | 方案测试
// +--------------------------------------------------------------------------

new FibonacciQuery([4, 5, 7, 8, 9, 10, 8], 8);