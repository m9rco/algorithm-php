<?php

/**
 * MonkeyKing
 *
 * @author   Pu ShaoWei <marco0727@gamil.com>
 * @date     2017/8/23
 * @license  Mozilla
 * -------------------------------------------------------------
 * 思路分析：约瑟夫环问题
 * -------------------------------------------------------------
 * 有M个monkey ，转成一圈，第一个开始数数，数到第N个出圈，下一个再从1开始数，再数到第N个出圈，直到圈里只剩最后一个就是大王
 */
class MonkeyKing
{
    protected $next;
    protected $name;

    /**
     * MonkeyKing constructor.
     *
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * whoIsKing
     *
     * @static
     * @param $count
     * @param $num
     * @return mixed
     */
    public static function whoIsKing($count, $num)
    {
        // 构造单向循环链表
        $current = $first = new MonkeyKing(1);
        for ($i = 2; $i <= $count; $i++){
            $current->next = new MonkeyKing($i);
            $current       = $current->next;
        }
        // 最后一个指向第一个
        $current->next = $first;
        // 指向第一个
        $current = $first;
        // 定义一个数字
        $cn = 1;
        while ($current !== $current->next){
            $cn++;
            if ($cn == $num) {
                $current->next = $current->next->next;
                $cn            = 1;
            }
            $current = $current->next;
        }
        // 返回猴子姓名
        return $current->name;
    }
}

// 共10个猴子每3个出圈
var_dump(MonkeyKing::whoIsKing(10, 3));

function whoIsKing($n,$m){
    $r = 0;
    for ($i=2; $i <= $n ; $i++) {
        $r = ($r + $m) % $i;
    }
    return $r+1;
}

var_dump(whoIsKing(10,3));

function king($n, $m){
    $monkeys = range(1, $n);
    $i=0;
    $k=$n;
    while (count($monkeys)>1) {
        if(($i+1)%$m==0) {
            unset($monkeys[$i]);
        } else {
            array_push($monkeys,$monkeys[$i]);
            unset($monkeys[$i]);
        }
        $i++;
    }
    return current($monkeys);
}
$a = king(10, 3);
var_dump($a);