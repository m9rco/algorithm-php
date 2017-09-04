<?php
/**
 * @example  快速排序
 * @author   ShaoWei Pu <pushaowei0727@gmail.com>
 * @date     2017/6/17
 * @license  Mozilla
 * -------------------------------------------------------------
 * 思路分析：从数列中挑出一个元素，称为 “基准”（pivot) 
 * -------------------------------------------------------------
 * 重新排序数列，所有元素比基准值小的摆放在基准前面
 * 所有元素比基准值大的摆在基准的后面（相同的数可以到任一边）。
 * 递归地（recursive）把小于基准值元素的子数列和大于基准值元素的子数列排序
 *
 * @param  array $container
 * @return mixed
 */
function QulickSort( array $container ){
    $count = count( $container );
    if( $count <= 1 ) {
        return $container;
    }
    $left = $right = [];
    for ($i = 1; $i < $count; $i++) {
        if ($container[$i] < $container[0]) {
            $left[]  = $container[$i];
        } else {
            $right[] = $container[$i];
        }
    }
    $left  = QulickSort($left);
    $right = QulickSort($right);
    return array_merge($left,[$container[0]],$right);
}

var_dump( QulickSort([4,21,41,2,53,1,213,31,21,423]) );