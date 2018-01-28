<?php

/**
 *  根据向量叉集计算一个点是否在三角形当中
 *
 */
class PointInTriangle
{
    protected $point;
    protected $triangle;

    public function __construct(array $point, array $triangle)
    {
        $this->point = $point;
        if (count($triangle) != 3) {
            exit('这个不是三角形');
        }
        $this->triangle = $triangle;
    }

    //向量叉集计算
    private function cross($a, $b, $p)
    {
        return ($b['x'] - $a['x']) * ($p['y'] - $a['y']) - ($b['y'] - $a['y']) * ($p['x'] - $a['x']);
    }

    //判断是否在左边
    private function toLeft($a, $b, $p)
    {
        return $this->cross($a, $b, $p) > 0;
    }

    //开始构造三角形
    public function inTriangle()
    {
        $res = $this->toLeft($this->triangle[0], $this->triangle[1], $this->point);

        if ($res != $this->toLeft($this->triangle[1], $this->triangle[2], $this->point)) {
            return '不在三角形中';
        }
        if ($res != $this->toLeft($this->triangle[2], $this->triangle[0], $this->point)) {
            return '不在三角形中';
        }

        if ($this->cross($this->triangle[0], $this->triangle[1], $this->triangle[2]) == 0) {
            return '不在三角形中';
        }
        return '点' . json_encode($this->point) . '在三角形中';
    }
}

$point = [
    'x' => 4,
    'y' => 1
];
$point1 = [
    'x' => 4,
    'y' => 5
];
$triangle = [
    ['x' => 1, 'y' => 1],
    ['x' => 6, 'y' => 3],
    ['x' => 4, 'y' => 7],
];

$obj = new PointInTriangle($point1, $triangle);

var_dump($obj->inTriangle());
exit;