<?php

/**
 * Only Numbers
 *
 * @author   Pu ShaoWei <marco0727@gamil.com>
 * @date     2017/8/30
 * @license  Mozilla
 * -------------------------------------------------------------
 * 思路分析：快排同时做唯一标示
 * -------------------------------------------------------------
 * 一个数组里只有唯一一个元素是不同于别的元素，其余元素是两两相等如何得到这个元素
 *
 * @param array $container
 * @return mixed
 */
function OnlyNumbers(array $container)
{
    $count = count($container);
    if ($count <= 1) {
        return $container;
    }
    $exist = [];
    for ($i = 0; $i < $count; $i++) {
        if (isset($exist[$container[$i]])) {
            unset($exist[$container[$i]]);
            continue;
        }
        $exist[$container[$i]] = true;
    }
    return !empty($exist) ? array_keys($exist)[0] : false;
}

var_dump(OnlyNumbers([11, 22, 22, 11, 5, 63, 13, 5, 63, 18, 89, 13, 89]));


// +----------------------------------------------------------------------
// |                        方法二
// +----------------------------------------------------------------------
/**
 * @author      Openset <openset.wang@gmail.com>
 * @link        https://github.com/openset
 * @date        2017/9/7
 * @param array $container
 * @return null
 */
function OnlyNumbersV2(array $container)
{
    $res = array_flip(array_count_values($container));

    return isset($res[1]) ? $res[1] : null;
}

var_dump(OnlyNumbersV2([11, 22, 22, 11, 5, 63, 13, 5, 63, 18, 89, 13, 89]));
