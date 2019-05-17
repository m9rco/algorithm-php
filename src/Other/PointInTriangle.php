<?php

/**
 * 利用向量叉集判断一个点是否在三角形中
 *
 * @author   Neroxiezi  <lampxiezi@163.com>
 * @date     2018/1/11
 * @license  MIT
 * -------------------------------------------------------------
 *   利用向量叉集判断一个点是否在三角形中
 */

// +--------------------------------------------------------------------------
// | 解题方式    | 这儿，可能有用的解决方案
// +--------------------------------------------------------------------------

class PointInTriangle
{
    /**
     * @var array
     */
    protected $point;
    /**
     * @var array
     */
    protected $triangle;

    /**
     * PointInTriangle constructor.
     *
     * @param array $point
     * @param array $triangle
     */
    public function __construct(array $point, array $triangle)
    {
        $this->point = $point;
        if (count($triangle) != 3) {
            exit('这个不是三角形');
        }
        $this->triangle = $triangle;
    }

    /**
     * 向量叉集计算
     *
     * @param $a
     * @param $b
     * @param $p
     * @return mixed
     */
    private function cross($a, $b, $p)
    {
        return ($b['x'] - $a['x']) * ($p['y'] - $a['y']) - ($b['y'] - $a['y']) * ($p['x'] - $a['x']);
    }

    /**
     * 判断是否在左边
     *
     * @param $a
     * @param $b
     * @param $p
     * @return bool
     */
    private function toLeft($a, $b, $p)
    {
        return $this->cross($a, $b, $p) > 0;
    }

    /**
     * 开始构造三角形
     *
     * @return string
     */
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


// +--------------------------------------------------------------------------
// | 方案测试    | php `this.php` || PHPStorm -> 右键 -> Run `this.php`
// +--------------------------------------------------------------------------

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