<?php
/**
 * Created by PhpStorm.
 * User: 南丞
 * Date: 2018/3/14
 * Time: 10:01
 *
 * 题目描述:
 *
 * 以二维整数网格的形式给出地图，1代表陆地，0代表水。

    网格单元水平/垂直连接（不包含对角）。

    整张地图被水完全包围，并且有一个岛（即一个或多个连接的陆地单元）。

    岛上没有“湖泊”（里面的水没有连接到岛外的水）。

    一个单元格是边长为1的正方形。 网格为矩形，宽度和高度不超过100。

    确定岛屿的周长。
 */

class Solution
{
    protected $grid;
    public $result = 0;

    public function __construct(array $grid)
    {
        $this->grid = $grid;
        $this->islandPerimeter();
    }

    public function islandPerimeter()
    {
        if (empty($this->grid) || empty($this->grid[0])) return 0;

        foreach ($this->grid as $key => $val) {

            foreach ($this->grid[0] as $k => $v) {
                if ($this->grid[$key][$k] == 0) continue;
                $this->result += 4;

                if ($key > 0 && $this->grid[$key - 1][$k] == 1) {
                    $this->result -= 2;
                }
                if ($k > 0 && $this->grid[$key][$k - 1] == 1) {
                    $this->result -= 2;
                }
            }
        }
    }
}

$arr = [
    [0,1,0,0],
    [1,1,1,0],
    [0,1,0,0],
    [1,1,0,0]
];

$result = new Solution($arr);
var_dump($result->result);