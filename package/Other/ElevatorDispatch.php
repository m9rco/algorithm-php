<?php

/**
 * 编程之美-电梯调度算法
 *
 * @author   Neroxiezi  <lampxiezi@163.com>
 * @date     2018/1/11
 * @license  MIT
 * -------------------------------------------------------------
 * 解决方案：
 * (1)使用简单的方法，直接将楼层从1到n开始遍历
 *      sum(person[i] *  |i - j| ) 此表达式为一个双重循环，i与j均为1-n的循环。
 *      j下标表示电梯停靠的楼层。
 *      person数组表示，对应i层的下电梯的人数。此算法负责度为o(n*n)
 *      对应的j是上述和为最小的一层即为所求。 上面的算法复杂度为o(n)
 *
 * (2)下面考虑一个简单的算法，使其复杂度达到o(n)
 *      考虑假如电梯停靠在某一楼层i处，假设在i处下楼的客人为$first_layer,
 *      在i以上楼层的客人数目为$first_layer_above ，在i一下楼层的客人数目为$first_layer_below。
 *      且将电梯在i层停止时，全部人员的路程之和记为T。
 *
 *      那么加入电梯在i-1层停的话，则原来i层之上的人需要多爬一层，即增加了$first_layer_above
 *      第i层的人需要多爬一层，则结果增加了$first_layer,  i层之下的人则少爬了一层，结果减去$first_layer_below
 *      所以第i-1层的结果为$time- $first_layer_below + $first_layer + $first_layer_above 。即结果可以即为$time-($first_layer_below - $first_layer - $first_layer_above)
 *
 *
 * 下面考虑在i+1层的结果，若电梯在i+1层停止的话，原来i层之上的客户都会少爬一层，
 * 则结果减少$first_layer_above ，而i层之下的人员则都会多爬一层即增加了$first_layer_below ，第i层的人员都会多爬一层
 * 即为增加了$first_layer 。则结果为$time+ $first_layer_below + $first_layer - $first_layer_above
 *
 * 综上我们得出，
 *      (1)若$first_layer_below > $first_layer + $first_layer_above的时候， 我们在第i-1层 选择电梯停止最好。
 *      (2)若$first_layer_below + $first_layer < $first_layer_above的时候， 我们选择在第i+1层停止电梯最好。
 *
 * 下面我们可以先计算出来当i=1时候的T ，然后判断是否需要在i+1层停止，若是i+1层的花费
 * 大于i层，则我们可以继续计算，否则退出。
 */


// +--------------------------------------------------------------------------
// | 解题方式    | 这儿，可能有用的解决方案
// +--------------------------------------------------------------------------

class ElevatorDispatch
{
    protected $n = 10;
    protected $person;
    protected $time = 0; //先计算出在第一层停止的时候 所需要的花费
    protected $first_layer_below = 0;   //在第一层以下下的人数
    protected $first_layer;
    protected $first_layer_above = 0;//在第一层之上下电梯的人数
    public $floor = 1;//存储停靠的楼层

    public function __construct($person = [])
    {
        if (empty($person)) {
            $this->person = [0, 2, 5, 7, 3, 5, 2, 6, 2, 6, 3];
        }
        $this->first_layer = $this->person[1]; //在第一层处下的人数

    }

    public function compute()
    {

        //先计算出第1层停止需要爬取的楼层数目
        for ($i = 2; $i <= $this->n; $i++) {
            $this->time += $this->person[$i] * ($i - 1);
            $this->first_layer_above += $this->person[$i];
        }
        for ($j = 2; $j <= $this->n; $j++) {
            if ($this->first_layer_below + $this->first_layer <= $this->first_layer_above) { //说明第i+1层的结果会大于第i层
                $this->time += $this->first_layer_below + $this->first_layer - $this->first_layer_above;
                $this->first_layer_below += $this->first_layer;
                $this->first_layer = $this->person[$j];
                $this->first_layer_above -= $this->person[$j];
                $this->floor = $j;
            } else {
                //否则第i层的结果已经最小，故不需要计算第i+1层
                break;
            }
        }
        return $this->floor;
    }

    public function computeTwo()
    {
        $min = 6553;//存储最小值 ;
        for ($i = 1; $i <= $this->n; $i++) { //表示第i楼层电梯停靠
            $this->time = 0;
            for ($j = 1; $j < $this->n; $j++) {
                $this->time += abs(($i - $j)) * $this->person[$j];
            }
            if ($min > $this->time) {
                $min = $this->time;
                $this->floor = $i;
            }
        }
        return $this->floor;
    }

}

// +--------------------------------------------------------------------------
// | 方案测试    | php `this.php` || PHPStorm -> 右键 -> Run `this.php`
// +--------------------------------------------------------------------------


$obj = new ElevatorDispatch();
var_dump($obj->compute());
var_dump($obj->computeTwo());