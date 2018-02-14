<?php

/**
 * 迷宫寻址
 *
 * @author   Neroxiezi  <lampxiezi@163.com>
 * @date     2018/1/11
 * @license  MIT
 * -------------------------------------------------------------
 *   构造迷宫二维数组
 */

// +--------------------------------------------------------------------------
// | 解题方式    | 这儿，可能有用的解决方案
// +--------------------------------------------------------------------------


//迷宫一
for ($l = 0; $l <= 5; $l++) {
    for ($m = 0; $m <= 5; $m++) {
        if ($l == 1 && $m <= 3)
            $arr[$l][$m] = 0;
        elseif ($l == 2 && ($m == 1 || $m == 3 || $m == 4))
            $arr[$l][$m] = 0;
        elseif ($l == 3 && $m <= 4 && $m != 0 && $m != 3)
            $arr[$l][$m] = 0;
        elseif ($l == 4 && ($m == 1 || $m >= 4))
            $arr[$l][$m] = 0;
        else
            $arr[$l][$m] = 1;

        echo $arr[$l][$m] . ' ';
    }
    echo '<br/>';
}
echo '<br/><br/><br/><span style="color:red">寻地址算法的实现：</span><br/>';

/**
 * findPath
 *
 * @param $i
 * @param $j
 * @param $dir
 * @param $arr
 * @param $iline
 * @param $jline
 * @param $dirline
 * @return int
 */
function findPath($i, $j, $dir, $arr, $iline, $jline, $dirline)
{

    //判断是否结束
    if ($i == 4 && $j == 5) return 1;
    $ifdirs = 0;
    $newdir = $dir;
    $lastdir = $dir;


    //如果该点为0,则前进
    if ($arr[$i][$j] == 0) {
        //判断方向增量
        switch ($dir) {
            case 0:
                $ii = 0;
                $jj = 1;
                break;
            case 1:
                $ii = 1;
                $jj = 0;
                break;
            case 2:
                $ii = 0;
                $jj = -1;
                break;
            case 3:
                $ii = -1;
                $jj = 0;
                break;
        }

        //判断是否路口
        for ($n = 1; $n <= 4; $n++) {
            switch ($newdir) {
                case 0:
                    $aa = 0;
                    $bb = 1;
                    break;
                case 1:
                    $aa = 1;
                    $bb = 0;
                    break;
                case 2:
                    $aa = 0;
                    $bb = -1;
                    break;
                case 3:
                    $aa = -1;
                    $bb = 0;
                    break;
            }
            if ($arr[($i + $aa)][($j + $bb)] == 0) {
                $ifdirs++;
            }
            $newdir = ($newdir + 1) % 4;
        }

        //判断是否路口，是则记录位置和方向
        if ($ifdirs > 2) {

            if (in_array($i, $iline) && in_array($j, $jline)) {
            } else {
                echo "该点是路口:|$i,$j,$dir|<br/>";
                $iline[] = $i;
                $jline[] = $j;
                $dirline[] = $dir;
            }
        }

        if ($ifdirs > 1) {
            //不是死路，前进
            if ($arr[($i + $ii)][($j + $jj)] == 0) {
                //方向不变，可以前进
                $i += $ii;
                $j += $jj;
                echo "方向不变，可以前进:|$i,$j,$dir|<br/>";
                findPath($i, $j, $dir, $arr, $iline, $jline, $dirline);
            } else {
                //方向改变，试探
                if ($ifdirs > 2) {
                    //该点是路口,取来时方向为路口记录方向
                    $lastdir = $dirline[(count($dirline) - 1)];
                } else {
                    //不是路口，则在改变方向前记录方向
                    $lastdir = $dir;
                }

                //判断来时方向，不能走回头路
                switch ($lastdir) {
                    case 0:
                        $errdir = 2;
                        break;
                    case 1:
                        $errdir = 3;
                        break;
                    case 2:
                        $errdir = 0;
                        break;
                    case 3:
                        $errdir = 1;
                        break;
                }
                //改变方向
                $dir = ($dir + 1) % 4;

                //判断改变后方向是否为来时方向
                echo "不能走回头路：err:$errdir,dir:$dir<br/>";
                if ($dir != $errdir) {
                    echo "turn:($i,$j,$dir)<br/>";
                    switch ($dir) {
                        case 0:
                            $mm = 0;
                            $nn = 1;
                            break;
                        case 1:
                            $mm = 1;
                            $nn = 0;
                            break;
                        case 2:
                            $mm = 0;
                            $nn = -1;
                            break;
                        case 3:
                            $mm = -1;
                            $nn = 0;
                            break;
                    }
                    if ($arr[($i + $mm)][($j + $nn)] == 0) {
                        $i += $mm;
                        $j += $nn;
                        echo "可以前进:$i,$j,$dir<br/>";
                        findPath($i, $j, $dir, $arr, $iline, $jline, $dirline);
                    } else {
                        $dir = ($dir + 1) % 4;
                        echo "再改变方向,试探:$i,$j,$dir<br/>";
                        if ($dir != $errdir) {
                            echo "turn:($i,$j,$dir)<br/>";
                            switch ($dir) {
                                case 0:
                                    $ii = 0;
                                    $jj = 1;
                                    break;
                                case 1:
                                    $ii = 1;
                                    $jj = 0;
                                    break;
                                case 2:
                                    $ii = 0;
                                    $jj = -1;
                                    break;
                                case 3:
                                    $ii = -1;
                                    $jj = 0;
                                    break;
                            }
                            if ($arr[($i + $ii)][($j + $jj)] == 0) {
                                $i += $ii;
                                $j += $jj;
                                echo "可以前进:$i,$j,$dir<br/>";
                                findPath($i, $j, $dir, $arr, $iline, $jline, $dirline);
                            }
                        } else {
                            $dir = ($dir + 1) % 4;
                            echo "再改变方向,试探:$i,$j,$dir<br/>";
                            switch ($dir) {
                                case 0:
                                    $ii = 0;
                                    $jj = 1;
                                    break;
                                case 1:
                                    $ii = 1;
                                    $jj = 0;
                                    break;
                                case 2:
                                    $ii = 0;
                                    $jj = -1;
                                    break;
                                case 3:
                                    $ii = -1;
                                    $jj = 0;
                                    break;
                            }
                            if ($arr[($i + $ii)][($j + $jj)] == 0) {
                                $i += $ii;
                                $j += $jj;
                                echo "OK:$i,$j,$dir<br/>";
                                findPath($i, $j, $dir, $arr, $iline, $jline, $dirline);
                            }

                        }
                    }

                } else {
                    $dir = ($dir + 1) % 4;
                    echo "不能回头,再改变方向,试探:$i,$j,$dir<br/>";
                    switch ($dir) {
                        case 0:
                            $ii = 0;
                            $jj = 1;
                            break;
                        case 1:
                            $ii = 1;
                            $jj = 0;
                            break;
                        case 2:
                            $ii = 0;
                            $jj = -1;
                            break;
                        case 3:
                            $ii = -1;
                            $jj = 0;
                            break;
                    }
                    if ($arr[($i + $ii)][($j + $jj)] == 0) {
                        $i += $ii;
                        $j += $jj;
                        echo "可以前进:$i,$j,$dir<br/>";
                        findPath($i, $j, $dir, $arr, $iline, $jline, $dirline);
                    }
                }
            }
        } else {
            //是死路，需要返回到上个路口，改变方向，试探
            $dir = $dirline[(count($dirline) - 1)];
            $i = $iline[(count($iline) - 1)];
            $j = $jline[(count($jline) - 1)];
            echo "是死路，返回到上个路口，记录为：#$i,$j,$dir#<br/>";
            $dir = ($dir + 1) % 4;
            findPath($i, $j, $dir, $arr, $iline, $jline, $dirline);

        }

    }
}

$a[] = $b[] = $c[] = 0;
echo '初始值=>节点:($i=1,$j=1),方向:($dir=0).<br/><br/>';
findPath(1, 1, 0, $arr, $a, $b, $c);