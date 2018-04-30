<?php
/**
 *
 * 从扑克牌中随机抽取5张牌，判断是不是一个顺子，
 * 即这5张牌是不是连续的2-10位数字本身，A为1，J为11，Q为12，K为13，而大小王可以看成任意数字。
 *
 * 解题思路：
 * 我们需要把扑克牌的背景抽象成计算机语言。不难想象，我们可以把5张牌看成由5个数字组成的数组。
 * 大小王是特殊的数字，我们不妨把它们都当成0，这样和其他扑克牌代表的数字就不重复了。
 * 接下来我们来分析怎样判断5个数字是不是连续的。最直观的是，我们把数组排序。
 * 但值得注意的是，由于0可以当成任意数字，我们可以用0去补满数组中的空缺。
 * 也就是排序之后的数组不是连续的，即相邻的两个数字相隔若干个数字，
 * 但如果我们有足够的0可以补满这两个数字的空缺，这个数组实际上还是连续的。
 */

function judge(array $array)
{
    sort($array);
    $count = count($array);
    $min = $array[0];
    $max = $array[$count-1];
    $zero = 0;
    for ($i = 0; $i < $count;$i++) {
        if($array[$i] == 0) {
            $zero++;
        }
        //判断是否有重牌，排除王牌
        if($i < $count-1) {
            if($array[$i+1] == $array[$i] && $array[$i] !== 0) {
                return false;
            }
        }
    }
    $min = $array[$zero];
    $distance = $max-$min;
    // 没有王牌
    // 最大和最小值差4
    if($zero == 0) {
        if($distance == 4) {
            return true;
        }
        return false;
    }
    // 有一个王牌
    if($zero == 1) {
        if($distance == 4 || $distance == 3) {
            return true;
        }
        return false;
    }
    // 有2个王牌
    //  00 234 distance  =  2
    //  00 256 distatnce =  4
    //  00 235 distance  =  3
    if($zero == 2) {
        if($distance == 4 || $distance == 3 || $distance == 2) {
            return true;
        }
        return false;
    }

    return false;

}
$res1 = judge([1,2,3,4,5]); //没有王
$res2 = judge([1,2,0,3,5]);// 一张王
$res3 = judge([1,5,0,3,0]); // 两张王牌
$res4 = judge([1,5,8,3,7]);
var_dump($res1,$res2,$res3,$res4);