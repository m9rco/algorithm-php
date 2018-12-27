<?php
/**
 * Created by PhpStorm.
 * User: 南丞
 * Date: 2018/4/3
 * Time: 9:25
 */

class CartesianProduct
{
    protected $params;
    public function __construct()
    {
        $this->params = func_get_args();
    }
    public function combineDika()
    {
        $result = [];
        if(count($this->params[0])!=count($this->params[0], 1)){
            $this->params = $this->params[0];
        }
        $cnt = count($this->params);
        foreach($this->params[0] as $item) {
            $result[] = [$item];
        }
        for($i = 1; $i < $cnt; $i++) {
            $result = $this->combineArray($result,$this->params[$i]);
        }
        return $result;
    }

    private function combineArray($arr_a, $arr_b)
    {
        $result = [];
        foreach ($arr_a as $item) {
            foreach ($arr_b as $item2) {
                $temp = $item;
                $temp[] = $item2;
                $result[] = $temp;
            }
        }
        return $result;
    }
}

$color = array('白色','黑色','红色');
$size = array('透气','防滑');
$local = array('37码','38码','39码');

$obj = new CartesianProduct($color,$size,$local);
print_r($obj->combineDika());

$sets = array(
    array('白色','黑色','红色'),
    array('透气','防滑'),
    array('37码','38码','39码'),
    array('男款','女款')
);

$obj1  = new CartesianProduct($sets);
print_r($obj1->combineDika());