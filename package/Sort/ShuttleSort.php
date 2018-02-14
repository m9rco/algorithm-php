<?php

/**
 * 飞梭排序
 *
 * @author    ShaoWei Pu <pushaowei0727@gmail.com>
 * @date      2017/12/19
 * @version   1.0
 * -------------------------------------------------------------
 * 思路分析：飞梭排序是冒泡排序的轻微变形。不同的地方在于，飞梭排序是从低到高然后从高到低来回排序，而冒泡排序则仅从低到高去比较序列里的每个元素。
 * -------------------------------------------------------------
 * 先对数组从左到右进行冒泡排序（升序），则最大的元素去到最右端
 * 再对数组从右到左进行冒泡排序（降序），则最小的元素去到最左端
 * 以此类推，依次改变冒泡的方向，并不断缩小未排序元素的范围，直到最后一个元素结束
 */


// +--------------------------------------------------------------------------
// | 解题方式    | 这儿，可能有用的解决方案
// +--------------------------------------------------------------------------


/**
 * ShuttleSort
 *
 * @param array $data
 * @return array
 */
function ShuttleSort(array $data)
{
    /**
     * 替换方法
     *
     * @param array $data
     * @param       $i
     * @param       $j
     * @return array
     */
    $swap = function (array &$data, $i, $j) {
        $temp     = $data[$i];
        $data[$i] = $data[$j];
        $data[$j] = $temp;
        return $data;
    };

    $count = count($data);
    $left  = 0;
    $right = $count - 1;

    while ($left < $right) {
        // 从左到右
        $lastRight = 0;
        for ($i = $left; $i < $right; $i++) {
            if ($data[$i] > $data[$i + 1]) {
                $swap($data, $i, 1 + $i);
                $lastRight = $i;
            }
        }
        $right = $lastRight;
        // 从右到左
        $lastLeft = 0;
        for ($j = $right; $left < $j; $j--) {
            if ($data[$j - 1] > $data[$j]) {
                $swap($data, $j - 1, $j);
                $lastLeft = $j;
            }
        }
        $left = $lastLeft;
    }
    return $data;
}

// +--------------------------------------------------------------------------
// | 方案测试    | php `this.php` || PHPStorm -> 右键 -> Run `this.php`
// +--------------------------------------------------------------------------


var_dump(ShuttleSort([6, 13, 21, 99, 18, 2, 25, 33, 19, 84]));
