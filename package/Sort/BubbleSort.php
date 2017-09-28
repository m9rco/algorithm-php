<?php
/**
 * @example  冒泡排序
 * @author   ShaoWei Pu <pushaowei0727@gmail.com>
 * @date     2017/6/16
 * @license  Mozilla
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
function BubbleSort(array $container)
{
    $count = count($container);
    for ($j = 1; $j < $count; $j++) {
        for ($i = 0; $i < $count - $j; $i++) {
            if ($container[$i] > $container[$i + 1]) {
                $temp = $container[$i];
                $container[$i] = $container[$i + 1];
                $container[$i + 1] = $temp;
            }
        }
    }
    return $container;
}

var_dump(BubbleSort([4, 21, 41, 2, 53, 1, 213, 31, 21, 423]));

/*
array(10) {
  [0] =>
  int(1)
  [1] =>
  int(2)
  [2] =>
  int(4)
  [3] =>
  int(21)
  [4] =>
  int(21)
  [5] =>
  int(41)
  [6] =>
  int(41)
  [7] =>
  int(53)
  [8] =>
  int(213)
  [9] =>
  int(423)
}
 */

// +----------------------------------------------------------------------
// |                        方法二
// +----------------------------------------------------------------------
function BubbleSortV2(array $container)
{
    $len = count($container);
    // 也可以用foreach
    for ($i = 0; $i < $len - 1; $i++) {
        for ($j = $i + 1; $j < $len; $j++) {
            if ($container[$i] > $container[$j]) {
                list($container[$i], $container[$j]) = array($container[$j], $container[$i]);
            }
        }
    }

    return $container;
}

print_r(BubbleSort([4, 21, 41, 2, 53, 1, 213, 31, 21, 423]));
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
