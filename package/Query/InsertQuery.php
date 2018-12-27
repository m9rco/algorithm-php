<?php
/**
 * 插入查询
 *
 * @author   Pu ShaoWei <pushaowei0727@gmail.com>
 * @date     2017/8/25
 * @license  MIT
 * -------------------------------------------------------------
 * 思路分析：对于数组长度比较大，关键字分布又是比较均匀的来说，插值查找的效率比折半查找的效率高
 * -------------------------------------------------------------
 * 它是二分查找的改进。
 * 在英文词典里查找“apple”，你下意识里翻开词典是翻前面的书页还是后面的书页呢？如果再查“zoo”,你又会怎么查？
 * 显然你不会从词典中间开始查起，而是有一定目的地往前或往后翻。
 *
 */

// +--------------------------------------------------------------------------
// | 解题方式    | 这儿，可能有用的解决方案
// +--------------------------------------------------------------------------
/**
 * insertQuery
 *
 * @param array $container
 * @param       $num
 * @return bool|float|int
 */
function insertQuery(array $container, $num)
{
    $count = count($container);
    $lower = 0;
    $high  = $count - 1;

    while ($lower <= $high) {
        if ($container[ $lower ] == $num) {
            return $lower;
        }
        if ($container[ $high ] == $num) {
            return $high;
        }

        $left  = intval($lower + $num - $container[ $lower ]);
        $right = ($container[ $high ] - $container[ $lower ]) * ($high - $lower);

        $middle = $left /$right;

        if ($num < $container[ $middle ]) {
            $high  = $middle - 1;
        } else if ($num > $container[ $middle ]) {
            $lower = $middle + 1;
        } else {
            return $middle;
        }
    }
    return false;
}


// +--------------------------------------------------------------------------
// | 方案测试    | php `this.php` || PHPStorm -> 右键 -> Run `this.php`
// +--------------------------------------------------------------------------
echo insertQuery([4, 5, 7, 8, 9, 10, 8], 8);
// 6