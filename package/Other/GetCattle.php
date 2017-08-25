<?php

/**
 * GetCattle
 *
 * @author   Pu ShaoWei <marco0727@gamil.com>
 * @date     2017/8/24
 * @license  Mozilla
 * -------------------------------------------------------------
 * 思路分析：见下方注释 
 * -------------------------------------------------------------
 *
 * 牛年求牛：
 *      有一母牛，到4岁可生育，每年一头，所生均是一样的母牛
 *          15岁绝育，不再能生，
 *          20岁死亡，问n年后有多少头牛。
 *
 * @param      $n
 * @return int
 */
function getCattle($n)
{
    static $num = 1;
    for ($i =1; $i<=$n;$i++){
        if( $i == 20) break;
        if($i >= 4 && $i <15){
            if($i % 4 == 0 ){
                getCattle($n - $i);
                $num++;
            }
            $num++;
        }
    }
    return $num;
}
echo '牛年共有：'.getCattle(10);

/*
123456789
   123456
      123
       12
9 - 11

---

 */