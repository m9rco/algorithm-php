<?php
/**
 * @example  冒泡排序
 * @author   Openset <openset.wang@gmail.com>
 * @date     2017/9/5
 * @license  MIT
 * -------------------------------------------------------------
 * 思路分析：就是像冒泡一样，每次从数组当中 冒一个最大的数出来。 
 * -------------------------------------------------------------
 * 你可以这样理解：（从小到大排序）存在10个不同大小的气泡，
 * 由底至上的把较少的气泡逐步地向上升，这样经过遍历一次后最小的气泡就会被上升到顶（下标为0）
 * 然后再从底至上地这样升，循环直至十个气泡大小有序。
 * 在冒泡排序中，最重要的思想是两两比较，将两者较少的升上去
 *
 * @param  array $container
 * @return array
 */
function BubbleSort(array $container){
    $len = count($container);
    for($i=0; $i< $len; $i++){
        for($j=$i+1; $j<$len; $j++){
            if($container[$i]>$container[$j]){
                list($container[$i], $container[$j]) = array($container[$j], $container[$i]);
            }
        }
    }
    
    return $container;
}

print_r(BubbleSort([4,21,41,2,53,1,213,31,21,423]));
/*
Array
(
    [0] => 1
    [1] => 2
    [2] => 4
    [3] => 21
    [4] => 21
    [5] => 31
    [6] => 41
    [7] => 53
    [8] => 213
    [9] => 423
)
 */