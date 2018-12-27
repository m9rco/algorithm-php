<?php
/**
 *
    背包问题：有一个背包，背包容量是M=150。有7个物品，物品可以分割成任意大小。要求尽可能让装入背包中的物品总价值最大，但不能超过总容量。
    物品 A B C D E F G
    重量 35 30 60 50 40 10 25
    价值 10 40 30 50 35 40 30
 */

  # 定义一个物品类

class Knapsack{
    protected $weight; # 物品的重量
    protected $value;  # 物品的价值
    protected $total_weight ; # 包的总重量
    public function __construct(array $weight,array  $value,$total_weight = 150)
    {
        $this->weight = $weight;
        $this->value =  $value;
        $this->total_weight =  $total_weight;
    }

    # 贪心算法去算最佳的物品
    public function bag()
    {
        $product = [];
        foreach ($this->weight as $k => $v) {
            $product[] = ['weight' => $v, 'value' => $this->value[$k], 'pj_value' => ($this->value[$k] / $v)];
        }

        $total_value = 0;
        //按价值比去排序
        $sorted_product = $this->sortByPj_value($product);
        //print_r($sorted_product);
        $total = 0;
        foreach ($sorted_product as $k => $v) {
            if ($total + $v['weight'] <= $this->total_weight) {

                $total_value += $v['value'];

                $total += $v['weight'];
            } elseif ($total < $this->total_weight) {

                for ($j = $k + 1; $j < count($sorted_product); $j++) {
                    if (($sorted_product[$j]['weight'] + $total) <= 150) {
                        $total_value += $sorted_product[$j]['value'];
                        $total += $sorted_product[$j]['weight'];
                    }
                }

                break;

            }else{

                break;
            }
        }

        return [$total ,$total_value ];

    }

    private function sortByPj_value($product)
    {
        for ($i = 0; $i < count($product); $i++) {
            for ($j = $i + 1; $j < count($product); $j++) {
                if ($product[$i]['pj_value'] < $product[$j]['pj_value']) {
                    $temp = $product[$i];
                    $product[$i] = $product[$j];
                    $product[$j] = $temp;
                }
            }

        }
        return $product;
    }
}

$obj = new Knapsack([35, 30, 60, 50, 40, 15, 10],[10, 40, 30, 50, 35, 40, 30],150);
var_dump($obj->bag());



