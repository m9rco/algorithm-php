<?php
/**
 * 抽奖区间算法
 *
 * @author   Neroxiezi  <lampxiezi@163.com>
 * @date     2018/1/11
 * @license  MIT
 * -------------------------------------------------------------
 *
 * 不同概率的抽奖原理就是把0到*（比重总数）的区间分块
 * 分块的依据是物品占整个的比重，再根据随机数种子来产生0-* 中的某个数
 * 判断这个数是落在哪个区间上，区间对应的就是抽到的那个物品。
 * 随机数理论上是概率均等的，那么相应的区间所含数的多少就体现了抽奖物品概率的不同。
 */


// +--------------------------------------------------------------------------
// | 解题方式    | 这儿，可能有用的解决方案
// +--------------------------------------------------------------------------

/**
 * get_rand
 *
 * @param $proArr
 * @return array
 */
function get_rand($proArr)
{
    $result = array();
    foreach ($proArr as $key => $val) {
        $arr[$key] = $val['v'];
    }
    $proSum = array_sum($arr);      // 计算总权重
    $randNum = mt_rand(1, $proSum);
    $d1 = 0;
    $d2 = 0;
    for ($i = 0; $i < count($arr); $i++) {
        $d2 += $arr[$i];
        if ($i == 0) {
            $d1 = 0;
        } else {
            $d1 += $arr[$i - 1];
        }
        if ($randNum >= $d1 && $randNum <= $d2) {
            $result = $proArr[$i];
        }
    }
    unset ($arr);
    return $result;
}

/**
 * 使用较多的为这个方法
 *
 * @param $proArr
 * @return array
 */
function get_rand1($proArr)
{
    $result = array();
    foreach ($proArr as $key => $val) {
        $arr[$key] = $val['v'];
    }
    // 概率数组的总概率
    $proSum = array_sum($arr);
    asort($arr);
    // 概率数组循环
    foreach ($arr as $k => $v) {
        $randNum = mt_rand(1, $proSum);
        if ($randNum <= $v) {
            $result = $proArr[$k];
            break;
        } else {
            $proSum -= $v;
        }
    }
    return $result;
}


// +--------------------------------------------------------------------------
// | 方案测试    | php `this.php` || PHPStorm -> 右键 -> Run `this.php`
// +--------------------------------------------------------------------------

$arr = array(
    array('id' => 1, 'name' => '特等奖', 'v' => 1),
    array('id' => 2, 'name' => '一等奖', 'v' => 5),
    array('id' => 3, 'name' => '二等奖', 'v' => 10),
    array('id' => 4, 'name' => '三等奖', 'v' => 12),
    array('id' => 5, 'name' => '四等奖', 'v' => 22),
    array('id' => 6, 'name' => '没中奖', 'v' => 50)
);

var_dump(get_rand($arr));

