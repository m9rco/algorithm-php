<?php

/**
 * QulickQuery
 *
 * @author   Pu ShaoWei <pushaowei0727@gmail.com>
 * @date     2017/8/23
 * @license  Mozilla
 * -------------------------------------------------------------
 * 思路分析：数组中间的值floor((low+top)/2) 
 * -------------------------------------------------------------
 * 重复第二步操作直至找出目标数字
 *
 * @param     $array
 * @param     $k
 * @param int $low
 * @param int $high
 * @return int
 */
function QulickQuery($array, $k, $low = 0, $high = 0)
{
    //判断是否为第一次调用
    if (count($array) != 0 and $high == 0) {
        $high = count($array);
    }
    //如果还存在剩余的数组元素
    if ($low <= $high) {
        //取$low和$high的中间值
        $mid = intval(($low + $high) / 2);
        //如果找到则返回
        if ($array[ $mid ] == $k) {
            return $mid;
        }else if ($k < $array[ $mid ]) {//如果没有找到，则继续查找
            return QulickQuery($array, $k, $low, $mid - 1);
        } else {
            return QulickQuery($array, $k, $mid + 1, $high);
        }
    }
    return -1;
}

echo QulickQuery([4, 5, 7, 8, 9, 10, 8], 8);