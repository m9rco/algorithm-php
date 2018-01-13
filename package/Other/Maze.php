<?php
//zairwolf z@cot8.com
header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);

//n宫格迷宫
define('M', 39);//宫数
define("S", 20);//迷宫格大小
$_posArr = array(array(0, -1), array(1, 0), array(0, 1), array(-1, 0));//当前点寻址的四个xy方向 上右下左

//生成迷宫
$maze = array();
$mazeUnit = array(1, 1, 1, 1);//上右下左
for ($x = 0; $x <= M; $x++) {
    for ($y = 0; $y <= M; $y++) {
        $maze[$x][$y] = $mazeUnit;
    }
}
$maze2 = array();//破墙后的已访问格子
$mazeOrder = array();//破墙顺序
$x = $y = 0;//初始入口
while (count($maze) > 0) {
    $tmpArr = array();
    foreach ($_posArr as $val) {
        $nx = $x + $val[0];
        $ny = $y + $val[1];
        if (isset($maze[$nx][$ny])) {//未破墙过的格子
            $tmpArr[] = array($nx, $ny);
        }
    }
    if ($tmpArr) {//有未破墙的格子，随机出一个，破墙
        list($nx, $ny) = $tmpArr[array_rand($tmpArr)];
        $maze2[$nx][$ny] = $maze[$nx][$ny];
        if (empty($maze2[$x][$y])) $maze2[$x][$y] = $maze[$x][$y];
        $pos = array($nx - $x, $ny - $y);
        foreach ($_posArr as $key => $val) {//循环四个方向，找出需要破的墙
            if ($pos == $val) {
                $maze2[$x][$y][$key] = 0;//原格子破墙
                $maze2[$nx][$ny][($key + 2) % 4] = 0;//新格子破墙
            }
        }
        //设置新的当前格后返回继续while循环
        $x = $nx;
        $y = $ny;
        $mazeOrder[] = array($x, $y);
        unset($maze[$x][$y]);//去掉已破墙的格子
        if (empty($maze[$x])) unset($maze[$x]);
    } else {//当前xy周围不存在未破墙的格子，返回上一个格子继续破墙
        array_pop($mazeOrder);
        if ($mazeOrder) list($x, $y) = $mazeOrder[count($mazeOrder) - 1];
    }
}
//留出出口
$maze = $maze2;
$maze[0][0][3] = 0;
$maze[M][M][1] = 0;

//寻址
$pathArr = findPath($maze, 0, 0, false);
var_dump($pathArr);exit;
/*printMaze($maze, $pathArr);

echo "<img src='maze.png'> <a href='javascript:;' onclick='location.reload();'>刷新</a>";

//打印迷宫和寻址结果by z@cot8.com
function printMaze($maze, $pathArr)
{
    $im = ImageCreate((M + 1) * S + 1, (M + 1) * S + 1);
    $bg = ImageColorAllocate($im, 236, 233, 216);
    $pathColor = ImageColorAllocate($im, 255, 0, 0);
    $exitColor = ImageColorAllocate($im, 134, 255, 0);
    $borderColor = ImageColorAllocate($im, 0, 0, 0);
    ImageRectangle($im, 0, 0, (M + 1) * S, (M + 1) * S, $borderColor);//包边
    ImageLine($im, 0, 0, 0, S, $bg);//右上边开口
    ImageLine($im, (M + 1) * S, M * S, (M + 1) * S, (M + 1) * S, $bg);//左下边开口
    foreach ($maze as $x => $xarr) {//生成格子
        foreach ($xarr as $y => $unit) {
            if ($unit[0]) ImageLine($im, $x * S, $y * S, ($x + 1) * S, $y * S, $borderColor);//上有线
            if ($unit[1]) ImageLine($im, ($x + 1) * S, $y * S, ($x + 1) * S, ($y + 1) * S, $borderColor);//右有线
            if ($unit[2]) ImageLine($im, $x * S, ($y + 1) * S, ($x + 1) * S, ($y + 1) * S, $borderColor);//下有线
            if ($unit[3]) ImageLine($im, $x * S, $y * S, $x * S, ($y + 1) * S, $borderColor);//左有线
            //if(in_array(array($x, $y), $pathArr)) ImageFilledEllipse($im, $x * S + S/2, $y * S + S/2, S, S, $pathColor);//寻址格
            if (in_array(array($x, $y), $pathArr)) ImageString($im, 1, $x * S + S / 5, $y * S + S / 5, array_search(array($x, $y), $pathArr), $pathColor);//寻址格
        }
    }
    ImagePNG($im, 'maze.png');
    ImageDestroy($im);
}*/

//寻址函数 z@cot8.com
function findPath($maze, $x, $y, $fromxy)
{
    global $_posArr;
    if ($x == M && $y == M) {//到达出口
        Return array(array($x, $y));
    }
    foreach ($_posArr as $key => $val) {
        if ($maze[$x][$y][$key]) continue;//为1则不通
        $nx = $x + $val[0];
        $ny = $y + $val[1];
        if (!isset($maze[$nx][$ny]) || $fromxy == array($nx, $ny)) continue;//边界超出或为来源点
        if ($pathArr = findPath($maze, $nx, $ny, array($x, $y))) {
            array_unshift($pathArr, array($x, $y));
            Return $pathArr;//能到达出口
        }
    }
    Return false;
}