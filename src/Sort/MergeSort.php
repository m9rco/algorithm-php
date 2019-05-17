<?php

/**
 * 归并排序
 *
 * @author   ShaoWei Pu <pushaowei0727@gmail.com>
 * @date     2017/7/22
 * @license  MIT
 * -------------------------------------------------------------
 * 思路分析：
 * 大O表示： O(n log n)
 * -------------------------------------------------------------
 * 比较a[i]和b[j]的大小，若a[i]≤b[j]，则将第一个有序表中的元素a[i]复制到r[k]中，
 * 并令i和k分别加上1；否则将第二个有序表中的元素b[j]复制到r[k]中，并令j和k分别加上1，
 * 如此循环下去，直到其中一个有序表取完，然后再将另一个有序表中剩余的元素复制到r中从下标k到下标t的单元。
 * 归并排序的算法我们通常用递归实现，先把待排序区间[s,t]以中点二分，接着把左边子区间排序，再把右边子区间排序，
 * 最后把左区间和右区间用一次归并操作合并成有序的区间[s,t]
 */


// +--------------------------------------------------------------------------
// | 解题方式
// +--------------------------------------------------------------------------

class MergeSort
{
    /**
     * MergeSort constructor.
     * 是开始递归函数的一个驱动函数
     *
     * @param array $arr 待排序的数组
     */
    public function __construct(array $arr)
    {
        $this->mSort($arr, 0, count($arr) - 1);
        var_dump($arr);
    }

    /**
     * 实际实现归并排序的程序
     *
     * @param $arr     array   需要排序的数组
     * @param $left    int     子序列的左下标值
     * @param $right   int     子序列的右下标值
     */
    public function mSort(&$arr, $left, $right)
    {
        if ($left < $right) {
            //说明子序列内存在多余1个的元素，那么需要拆分，分别排序，合并
            //计算拆分的位置，长度/2 去整
            $center = floor(($left + $right) / 2);
            //递归调用对左边进行再次排序：
            $this->mSort($arr, $left, $center);
            //递归调用对右边进行再次排序
            $this->mSort($arr, $center + 1, $right);
            //合并排序结果
            $this->mergeArray($arr, $left, $center, $right);
        }
    }

    /**
     * 将两个有序数组合并成一个有序数组
     *
     * @param &$arr   , 待排序的所有元素
     * @param $left   , 排序子数组A的开始下标
     * @param $center , 排序子数组A与排序子数组B的中间下标，也就是数组A的结束下标
     * @param $right  , 排序子数组B的结束下标（开始为$center+1)
     */
    public function mergeArray(&$arr, $left, $center, $right)
    {
        echo '| ' . $left . ' - ' . $center . ' - ' . $right . ' - ' . implode(',', $arr) . PHP_EOL;
        //设置两个起始位置标记
        $a_i  = $left;
        $b_i  = $center + 1;
        $temp = [];

        while ($a_i <= $center && $b_i <= $right) {
            //当数组A和数组B都没有越界时
            if ($arr[ $a_i ] < $arr[ $b_i ]) {
                $temp[] = $arr[ $a_i++ ];
            } else {
                $temp[] = $arr[ $b_i++ ];
            }
        }
        //判断 数组A内的元素是否都用完了，没有的话将其全部插入到C数组内：
        while ($a_i <= $center) {
            $temp[] = $arr[ $a_i++ ];
        }
        //判断 数组B内的元素是否都用完了，没有的话将其全部插入到C数组内：
        while ($b_i <= $right) {
            $temp[] = $arr[ $b_i++ ];
        }

        //将$arrC内排序好的部分，写入到$arr内：
        for ($i = 0, $len = count($temp); $i < $len; $i++) {
            $arr[ $left + $i ] = $temp[ $i ];
        }
    }
}



// +--------------------------------------------------------------------------
// | 方案测试
// +--------------------------------------------------------------------------

//do some test:
new mergeSort([4, 7, 6, 3, 9, 5, 8]);

/*

| 0 - 0 - 1 - 4,7,6,3,9,5,8
| 2 - 2 - 3 - 4,7,6,3,9,5,8
| 0 - 1 - 3 - 4,7,3,6,9,5,8
| 4 - 4 - 5 - 3,4,6,7,9,5,8
| 4 - 5 - 6 - 3,4,6,7,5,9,8
| 0 - 3 - 6 - 3,4,6,7,5,8,9

array(7) {
  [0] =>
  int(3)
  [1] =>
  int(4)
  [2] =>
  int(5)
  [3] =>
  int(6)
  [4] =>
  int(7)
  [5] =>
  int(8)
  [6] =>
  int(9)
}
 */