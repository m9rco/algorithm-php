<?php

/**
 * 迪克斯特拉算法
 *
 * @author   Pu ShaoWei <pushaowei0727@gmail.com>
 * @date     2017/8/23
 * @license  MIT
 * -------------------------------------------------------------
 * 思路分析：单源最短路径问题
 * -------------------------------------------------------------
 *  Dijkstra 算法一般的表述通常有两种方式，一种用永久和临时标号方式，一种是用OPEN, CLOSE表的方式，
 *  这里均采用永久和临时标号的方式。注意该算法要求图中不存在负权边。
 *  因此，在包含负边全的图中要找出最短路径，可以使用另一种算法 -- 贝克曼-福德算法
 */

// +--------------------------------------------------------------------------
// | 解题方式
// +--------------------------------------------------------------------------

/**
 * DijkstraQuery
 *
 * @uses     PHPStorm
 * @version  1.0
 * @author   Pu ShaoWei <pushaowei0727@gmail.com>
 */
class DijkstraQuery
{
    /**
     * @var array
     */
    protected $graph;
    /**
     * @var array
     */
    protected $processed;
    /**
     * @var int
     */
    protected $infinity;
    /**
     * @var string
     */
    protected $start;
    /**
     * @var string
     */
    protected $end;

    /**
     * DijkstraQuery constructor.
     *
     * @param array $graph
     * @param       $start
     * @param       $end
     */
    public function __construct(array $graph, $start, $end)
    {
        $this->graph     = $graph;
        $this->start     = $start;
        $this->end       = $end;
        $this->processed = array ();
        $this->infinity  = mt_getrandmax();
    }

    /**
     * 最短路径
     *
     * @return string
     */
    public function calculate()
    {
        $costs             = $this->graph[$this->start];
        $costs[$this->end] = $this->infinity;
        $node              = $this->findLowestCostNode($costs);

        while (null !== $node) {
            $cost      = $costs[$node];
            $neighbors = $this->graph[$node]  ?? array ();
            foreach ($neighbors as $neighbor => $distance) {
                $newCost = $cost + $distance;
                if ($costs[$neighbor] > $newCost) {
                    $costs[$neighbor] = $newCost;
                }
            }
            array_push($this->processed, $node);
            $node = $this->findLowestCostNode($costs);
        }

        return 'The shortest distance for：' . $costs[$this->end];
    }

    /**
     * findLowestCostNode
     *
     * @param $costs
     * @return null
     */
    protected function findLowestCostNode($costs)
    {
        $lowestCost     = $this->infinity;
        $lowestCostNode = null;
        foreach ($costs as $node => $cost) {
            if ($cost < $lowestCost && !in_array($node, $this->processed)) {
                $lowestCost     = $cost;
                $lowestCostNode = $node;
            }
        }
        return $lowestCostNode;
    }
}

// +--------------------------------------------------------------------------
// | 验证 me --> claire
// +--------------------------------------------------------------------------
//  ∞
$graph = array (
    'me'     => array (
        'alice' => 6,
        'bob'   => 2,
    ),
    'alice'  => array (
        'claire' => 1,
    ),
    'bob'    => array (
        'alice'  => 3,
        'claire' => 5,
    ),
    'claire' => array (// 没有任何邻居

    ),
);
echo (new DijkstraQuery($graph, 'me', 'claire'))->calculate();