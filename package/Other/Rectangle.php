<?php
/**
 * 面试题：如何判断平面上的四个点能不能组成一个矩形
         A*****B
         *     *
         *     *
         *     *
         C*****D
 * 解题思路： 利用数学知识勾股定理
 * 矩形的特点：四个角都是直角的平行四边形。
 * 以一个点【A】为参考点。分别计算出到任意三点AB、AC、AD的距离，最长的距离的一个一定点是对角线的点D。
 * 剩下的两个点是左右两个点B、C。 用剩下的两个点计算出另外一个对角线的距离BC。如果两条对角线相等【AD==BD】，
 * 还需要判断一个直角
 * 对角线相等不一定是矩形 也可能是菱形、等边梯形。
 * 再判断任意一个角是不是直角。即可判断是不是矩形了。
 *
 *
 */

function rectangle($one=[],$two=[],$three=[],$four=[])
{
    if(empty($one) || empty($two) || empty($three) || empty($four)) {
        return false;
    }

    $array['b'] = $two;
    $array['c'] = $three;
    $array['d'] = $four;
    $data = [];

    foreach ($array as $key=>$value) {
        $x = abs($value[0]-$one[0]);
        $y = abs($value[1]-$one[1]);
        $data[$key] = sqrt(pow($x,2)+pow($y,2));
    }

    asort($data);
    $keys =  array_keys($data);
    $maxKey = array_pop($keys);//对焦点
    $length0 = $data[$maxKey];//对角线长度

    //左右两点 key
    $left = $keys[0];
    $right = $keys[1];

    //算第二条对角线长度
    $x = abs($array[$left][0]-$array[$right][0]);
    $y = abs($array[$left][1]-$array[$right][1]);
    $length = sqrt(pow($x,2)+pow($y,2));

    if(!floatEq($length,$length0)) {
        return false;
    }

    //算直角
    $vertical = sqrt(pow($data[$left],2)+pow($data[$right],2));

    if(!floatEq($length,$vertical)) {
        return false;
    }

    return true;

}

var_dump(rectangle([0,0],[0,1],[1,1],[1,0])); //true
var_dump(rectangle([1,2],[0,1],[1,1],[1,0])); //false

/**
 * 判断两个浮点数是不是相等
 *
 * @param $a float
 * @param $b float
 * @return bool
 */
function floatEq($floatNumber1,$floatNumber2)
{
    if(!$floatNumber1 || !$floatNumber2) {
        return false;
    }
    //精度
    $epsilon = 0.00001;

    if(abs($floatNumber1-$floatNumber2) < $epsilon) {
        return true;
    }
    return false;
}
