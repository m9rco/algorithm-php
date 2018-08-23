<?php
/**
 * Created by PhpStorm.
 * User: 南丞
 * Date: 2018/3/19
 * Time: 15:03
 * Facebook 面试题之 判断四个点能否组成正方形
 */

class Square
{
    protected $point = [];

    public function __construct(array $point)
    {
        $this->point = $point;
    }

    public function check()
    {
        $result = [];
        if (count($this->point) != 4) return false;
        for ($i = 0; $i < 4; $i++) {
            for ($j = $i + 1; $j < 4; $j++) {
                $result[]=$this->_calculation($i,$j);
            }
        }
        sort($result);
        if ($result[0] == $result[1] && $result[4] == $result[5] && $result[4] > $result[1]) {
            return true;
        }
        return false;

    }

    private function _calculation($i, $j)
    {
        return pow($this->point[$i][0] - $this->point[$j][0],2) + pow($this->point[$i][1] - $this->point[$j][1] ,2);
    }
}

$obj = new Square([[0, 0], [1, 0], [1, 1], [0, 1]]);
var_dump($obj->check());
