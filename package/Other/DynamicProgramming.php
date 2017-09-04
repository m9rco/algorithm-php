<?php

/**
 * DynamicProgramming
 *
 * @author   Pu ShaoWei <marco0727@gamil.com>
 * @date     2017/8/28
 * @license  Mozilla
 * -------------------------------------------------------------
 * 思路分析：动态规划原理思想，max(opt(i-1,w),wi+opt(i-1,w-wi)) 当中最大值，opt(i-1,w-wi)指上一个最优解
 * -------------------------------------------------------------
 * 一个承受最大重量为W的背包，现在有n个物品，每个物品重量为t, 每个物品的价值为v。
 * 要使得这个背包重量最大(但不能超过W),同时又需要背包的价值最大
 * @return int
 */
function DynamicProgramming($maxSize, $goods, $cost)
{
    $container  = [];
    $goodsCount = count($goods);

    //初始化
    for ($i = 0; $i <= $maxSize; $i++) {
        $container[0][$i] = 0;
    }
    for ($j = 0; $j <= $goodsCount; $j++) {
        $container[$j][0] = 0;
    }
    for ($j = 1; $j <= $goodsCount; $j++) {
        for ($i = 1; $i <= $maxSize; $i++) {
            $container[$j][$i] = $container[$j - 1][$i];
            //不大于最大的w=15
            if ($goods[$j - 1] <= $maxSize) {
                if (!isset($container[$j - 1][$i - $goods[$j - 1]])) {
                    continue;
                }
                //wi+opt(i-1,wi)
                $tmp = $container[$j - 1][$i - $goods[$j - 1]] + $cost[$j - 1];
                //opt(i-1,w),wi+opt(i-1,w-wi) => 进行比较
                if ($tmp > $container[$j][$i]) {
                    $container[$j][$i] = $tmp;
                }
            }
        }
    }
    var_dump($container[$j - 1][$i - 1]);
}

echo DynamicProgramming(15, [3, 4, 5, 6], [8, 7, 4, 9]);
