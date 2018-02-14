<?php

/**
 * 彩色砖块
 *
 * @author   Pu ShaoWei <pushaowei0727@gmail.com>
 * @date     2017/9/1
 * @license  MIT
 * -------------------------------------------------------------
 * 思路分析：
 *  例如: s = "ABAB",那么小易有六种排列的结果:
 *  "AABB","ABAB","ABBA","BAAB",    "BBAA"   "BABA",
 *      1-2     0      2-3    0-1       0-3      1-2
 *    "ABAB",   0
 *    "BAAB",   0-1
 *    "AABB",   0-2
 *    "BABA"    0-3
 *    "ABBA",   1-2
 *    "BBAA"    1-3
 * -------------------------------------------------------------
 * 小易有一些彩色的砖块。每种颜色由一个大写字母表示。各个颜色砖块看起来都完全一样。
 * 现在有一个给定的字符串s,s中每个字符代表小易的某个砖块的颜色。小易想把他所有的砖块排成一行。
 * 如果最多存在一对不同颜色的相邻砖块,那么这行砖块就很漂亮的。
 * -------------------------------------------------------------
 * 请你帮助小易计算有多少种方式将他所有砖块排成漂亮的一行。(如果两种方式所对应的砖块颜色序列是相同的,那么认为这两种方式是一样的。)
 * -------------------------------------------------------------
 *  例如: s = "ABAB",那么小易有六种排列的结果:
 *    "AABB","ABAB","ABBA","BAAB","BABA","BBAA"
 *     其中只有"AABB"和"BBAA"满足最多只有一对不同颜色的相邻砖块。
 *  -------
 *  输入描述:
 *           输入包括一个字符串s,字符串s的长度length(1 ≤ length ≤ 50), [s中的每一个字符都为一个大写字母(A到Z)]。
 *  输出描述:
 *           输出一个整数,表示小易可以有多少种方式。
 *  -------
 *  输入例子1:
 *           ABAB
 *  输出例子1:
 *           2
 */

// +--------------------------------------------------------------------------
// | 解题方式    | 这儿，可能有用的解决方案
// +--------------------------------------------------------------------------

/**
 * ColorBricks
 *
 * @param $inputting
 * @return bool|int
 */
function ColorBricks($inputting)
{
    $count = strlen($inputting);
    $ascii = ord($inputting);

    if (!($ascii > 64 && $ascii < 91)) {
        return false;
    }
    if (!(1 <= $count && $count <= 50)) {
        return false;
    }

    $container = array ();
    $max       = floor($count / 2);

    for ($i = 0; $i < $max; $i++) {
        for ($j = 1; $j < $count; $j++) {
            $temp          = $inputting[$j];
            $inputting[$j] = $inputting[0];
            $inputting[0]  = $temp;
            array_push($container, $inputting);
        }
    }
    $containerCount = count($container);
    $counter   = 0;

    for ($i = 0; $i < $max; $i++) {
        $success = false;
        for ($j = 0; $j < $containerCount; $j++) {
            $str = $container[$j];
            if ($str[$i] == $str[0]) {
                $success = true;
            }
        }
        if ($success) {
            $counter++;
        }
    }
    return $counter;
}


// +--------------------------------------------------------------------------
// | 方案测试    | php `this.php` || PHPStorm -> 右键 -> Run `this.php`
// +--------------------------------------------------------------------------

echo ColorBricks("AABB");