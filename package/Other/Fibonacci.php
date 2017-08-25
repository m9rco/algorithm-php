<?php
/**
 * Fibonacci
 *
 * @author   Pu ShaoWei <pushaowei0727@gmail.com>
 * @date     2017/8/25
 * @license  Mozilla
 * -------------------------------------------------------------
 * 思路分析：
 * -------------------------------------------------------------
 * 斐波那契数列（Fibonacci Sequence）又称黄金分割数列 兔子数列
 * 指的是这样一个数列：1、1、2、3、5、8、13、21
 * 在数学上，斐波纳契数列以如下被以递归的方法定义：F0=0，F1=1，Fn=F(n-1)+F(n-2)（n>=2，n∈N*）。
 *
 * @param $n
 * @return int
 */

// recursion
/*
function Fibonacci($n)
{
    if ($n <= 1 ) {
        return $n;
    }
    return Fibonacci($n - 1) + Fibonacci($n - 2);
}
*/
// 55

// not recursion
function Fibonacci($n)
{
    if ($n <= 1) {
        return $n;
    }
    for ($fib = [0, 1], $i = 2; $i <= $n; $i++) {
        $fib[$i] = $fib[$i - 1] + $fib[$i - 2];
    }
    return $fib[$n];
}

echo Fibonacci(10);
// 55
