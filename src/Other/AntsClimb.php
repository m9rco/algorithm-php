<?php
/**
 * 蚂蚁爬杆算法
 *
 * @author   Neroxiezi  <lampxiezi@163.com>
 * @date     2018/1/11
 * @license  MIT
 * -------------------------------------------------------------
 *  有一根27厘米的细木杆，在第3厘米、7厘米、11厘米、17厘米、23厘米这五个位置上各有一只蚂蚁。
 *  木杆很细，不能同时通过一只蚂蚁。开始 时，蚂蚁的头朝左还是朝右是任意的，它们只会朝前走或调头，
 *  但不会后退。当任意两只蚂蚁碰头时，两只蚂蚁会同时调头朝反方向走。假设蚂蚁们每秒钟可以走一厘米的距离。
 * -------------------------------------------------------------
 *   编写程序，求所有蚂蚁都离开木杆的最小时间和最大时间
 */

// +--------------------------------------------------------------------------
// | 解题方式
// +--------------------------------------------------------------------------

class AntsClimb
{
    /**
     * @var array 蚂蚁位置集合
     */
    protected $position;

    /**
     * AntsClimb constructor.
     *
     * @param array $position
     */
    public function __construct(array $position)
    {
        $this->position = $position;
    }

    /**
     * run
     *
     * @return void
     */
    public function run()
    {
        $pathCalculate = $this->path($this->position);
        echo '<pre>计算-';
        print_r($pathCalculate);
        echo '排序-';
        asort($pathCalculate);
        print_r($pathCalculate);
    }

    /**
     * add2
     *
     * @param $directionArr
     * @param $count
     * @param $i
     * @return mixed
     */
    protected function add2($directionArr, $count, $i)
    {
        if (0 > $i) {
            return $directionArr;
        }
        if (0 === $directionArr[$i]) {
            $directionArr[$i] = 1;
            return $directionArr;
        }
        $directionArr[$i] = 0;
        return $this->add2($directionArr, $count, $i - 1);
    }

    /**
     * path
     *
     * @param $positionArr
     * @return array
     */
    protected function path($positionArr)
    {
        // 生成测试路径
        $pathCalculate = array ();
        $count         = count($positionArr);
        $directionArr  = array_fill(0, $count, 0);

        // 朝向
        $end = str_repeat('1', $count);
        while (true) {
            $path                         = implode('', $directionArr);
            $total                        = $this->calculate($positionArr, $directionArr);
            $pathCalculate['路径:' . $path] = $total;
            if ($end == $path) { // 遍历完成
                break;
            }
            $directionArr = $this->add2($directionArr, $count, $count - 1);
        }
        return $pathCalculate;
    }

    /**
     * calculate
     *
     * @param $positionArr
     * @param $directionArr
     * @return int
     */
    protected function calculate($positionArr, $directionArr)
    {
        $total = 0;
        // 总用时
        $length = 27;
        // 木杆长度
        while ($positionArr) {
            $total++; // 步增耗时
            $nextArr = array (); // 下一步位置
            foreach ($positionArr as $key => $value) {
                if (0 == $directionArr[$key]) {
                    $next = $value - 1; // 向0方向走一步
                } else {
                    $next = $value + 1; // 向1方向走一步
                }
                if (0 == $next) { // 在0方向走出
                    continue;
                }
                if ($length == $next) { // 在1方向走出
                    continue;
                }
                $nextArr[$key] = $next;
            }
            $positionArr = $nextArr;// 将$positionArr置为临时被查找数组

            foreach ($nextArr as $key => $value) {
                $findArr = array_keys($positionArr, $value);
                if (count($findArr) < 2) {
                    // 没有重合的位置
                    continue;
                }
                foreach ($findArr as $findIndex) {
                    $directionArr[$findIndex] = $directionArr[$findIndex] ? 0 : 1;
                    // 反向处理
                    unset($positionArr[$findIndex]);
                    // 防止重复查找计算
                }
            }
            $positionArr = $nextArr;
            // 将$positionArr置为下一步结果数组
        }
        return $total;
    }
}

// +--------------------------------------------------------------------------
// | 方案测试    | php `this.php` || PHPStorm -> 右键 -> Run `this.php`
// +--------------------------------------------------------------------------

// 蚂蚁位置
$position = array (3, 7, 11, 17, 23);
// 测试用例
(new AntsClimb($position))->run();