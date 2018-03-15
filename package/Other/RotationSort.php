<?php
/**
 * Created by PhpStorm.
 * User: 南丞
 * Date: 2018/3/15
 * Time: 16:02
 */
//回旋
class RotationSort
{
    public $res;
    protected $row;
    protected$col;
    protected $start;
    public function __construct($row,$col, $start = 1)
    {
        $this->row = $row;
        $this->col =$col;
        $this->start = $start;
        $this->print_matrix();
    }

    private function print_matrix()
    {
        //当前遍历层数
        $small =$this->col < $this->row ?$this->col : $this->row;

        $count = ceil($small / 2);

        for($i=0; $i < $count; $i++)
        {
            $maxRight  = $this->col -1 - $i;    //右边最大坐标
            $maxBottom = $this->row -1 - $i;   //下面最大坐标

            for($j=$i; $j<=$maxRight; $j++)
            {
                $this->res[$i][$j] = $this->start++;
            }
            for($j=$i; $j<$maxBottom; $j++)
            {
                $this->res[$j+1][$maxRight] = $this->start++;
            }
            for($j=$maxRight-1;$j>=$i; $j--)
            {
                if(isset($this->res[$maxBottom][$j])) break;
                $this->res[$maxBottom][$j] = $this->start++;
            }
            for($j=$maxBottom-1;$j>$i;$j--)
            {
                if(isset($this->res[$j][$i])) break;
                $this->res[$j][$i] = $this->start++;
            }
        }
    }

    /**
     * @return string
     * 输出回旋形状
     */
    public function print_table()
    {
        $str = '<table cellspacing="0" cellpadding="5" border=1>';
        for ($i = 0; $i < $this->row; $i++) {
            $str .='<tr>';
            for ($j = 0; $j < $this->col; $j++) {
                $str .='<td>'.$this->res[$i][$j] . "</td>";
            }
            $str .="</tr>";
        }
        $str .='</table>';
        return $str;
    }
}

$obj = new RotationSort(7, 8);
echo $obj->print_table();