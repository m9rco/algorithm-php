<?php

/**
 * GetCattle
 *
 * @author   Pu ShaoWei <marco0727@gamil.com>
 * @date     2017/8/24
 * @license  MIT
 * -------------------------------------------------------------
 * 思路分析：见下方注释 
 * -------------------------------------------------------------
 *
 * 牛年求牛：
 *      有一母牛，到4岁可生育，每年一头，所生均是一样的母牛
 *          15岁绝育，不再能生，
 *          20岁死亡，问n年后有多少头牛。
 *
 */

// +--------------------------------------------------------------------------
// | 解题方式    | 这儿，可能有用的解决方案
// +--------------------------------------------------------------------------

/**
 * getCattle
 *
 * @param $n
 * @return int
 */
function getCattle($n)
{
    static $num = 1;
    for ($i = 1; $i <= $n; $i++) {
        if ($i == 20) {
            $num--; //死亡需减一
        } else if ($i >= 4 && $i < 15) {
            $num++; //生小母牛（这里有小母牛）
            getCattle($n - $i); //小母牛生小母牛（这里不包含小母牛）
        }
    }
    return $num;
}


// +--------------------------------------------------------------------------
// | 方案测试    | php `this.php` || PHPStorm -> 右键 -> Run `this.php`
// +--------------------------------------------------------------------------

echo '牛年共有：' . getCattle(10);

/*
123456789
   123456
      123
       12
9 - 11

---

 */