<?php
/**
 * @example  希尔排序
 * @author   ShaoWei Pu <pushaowei0727@gmail.com>
 * @date     2017/7/22
 * @license  Mozilla
 * -------------------------------------------------------------
 * 思路分析：希尔排序是基于插入排序的，区别在于插入排序是相邻的一个个比较（类似于希尔中h=1的情形），而希尔排序是距离h的比较和替换。
 * -------------------------------------------------------------
 * 希尔排序中一个常数因子n，原数组被分成各个小组，每个小组由h个元素组成，很可能会有多余的元素。
 * 当然每次循环的时候，h也是递减的（h=h/n）。第一次循环就是从下标为h开始。希尔排序的一个思想就是，分成小组去排序。
 * @param array $container
 * @return array
 */
function ShellSort(array $container)
{
    $count = count($container);
    for ($increment = intval($count / 2); $increment > 0; $increment = intval($increment / 2)) {
        for ($i = $increment; $i < $count; $i++) {
            $temp = $container[$i];
            for ($j = $i; $j >= $increment; $j -= $increment) {
                if ($temp < $container[$j - $increment]) {
                    $container[$j] = $container[$j - $increment];
                } else {
                    break;
                }
            }
            $container[$j] = $temp;
        }
    }
    return $container;
}

//var_dump(ShellSort([6, 13, 21, 99, 18, 2, 25, 33, 19, 84]));


