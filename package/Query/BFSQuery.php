<?php

/**
 * 广度优先搜索
 *
 * @author   ShaoWei Pu <pushaowei0727@gmail.com>
 * @date     2017/6/17
 * @license  MIT
 * -------------------------------------------------------------
 * 思路分析： BFS并不使用经验法则算法。从算法的观点，所有因为展开节点而得到的子节点都会被加进一个先进先出的队列中
 * 时间复杂度：O(n)
 * -------------------------------------------------------------
 * 宽度优先搜索算法（又称广度优先搜索）是最简便的图的搜索算法之一，这一算法也是很多重要的图的算法的原型。
 * Dijkstra单源最短路径算法和Prim最小生成树算法都采用了和宽度优先搜索类似的思想。
 * 其别名又叫BFS，属于一种盲目搜寻法，目的是系统地展开并检查图中的所有节点，以找寻结果。
 * 换句话说，它并不考虑结果的可能位置，彻底地搜索整张图，直到找到结果为止。
 */
class BFSQuery
{
    /**
     * @var array 关系网络
     */
    protected $relationship;
    /**
     * @var \SplQueue 处理队列
     */
    protected $queue;

    /**
     * @var string 搜索结果
     */
    protected $target;

    /**
     * BFSQuery constructor.
     *
     * @param array  $relationship
     * @param string $target
     */
    public function __construct(array $relationship, $target)
    {

        $this->relationship = $relationship;
        $this->queue        = new SplQueue();
        $this->target       = $target;
        $this->generator($this->relationship);
    }

    /**
     * 开始入列
     *
     * @param array $relation
     * @return \Generator
     */
    public function generator($relation)
    {
        foreach ($relation as $value) {
            $this->schedule($value);
        }
    }


    /**
     * 队列入队
     *
     * @param  $item
     * @return int
     */
    public function schedule($item)
    {
        $this->queue->enqueue($item);
    }

    /**
     * 队列中查找符合条件
     *
     * @return string
     */
    public function run()
    {
        $result = $this->target . '没有人有~!';
        while (!$this->queue->isEmpty()) {
            // 出队列
            $item = $this->queue->dequeue();
            if (!isset($item['friend'])) {
                continue;
            }
            if (!isset($item['fruit'])) {
                continue;
            }
            $totalFruit = count($item['fruit']);
            $mark       = 0;
            while ($totalFruit > $mark) {
                if ($item['fruit'][$mark] === $this->target) {
                    $result = '找到了～！';
                    break 2;
                }
                $mark++;
            }
            $this->generator($item['friend']);
        }
        return $result;
    }
}


// +--------------------------------------------------------------------------
// | 方案测试
// +--------------------------------------------------------------------------
// 你现在需要一个 `mango` ,所以你需要在你的朋友圈里搜刮，你可以先从Jack 与 tom 身上找，
// 然后再从他们的朋友身上找，然后再从他们朋友的朋友哪里找

$me = array (
    'jack' => array (
        'fruit'  => array ('apple', 'banana', 'dragon'),
        'friend' => array (
            'lucy' => array (
                'fruit'  => array ('bear', 'watermelon'),
                'friend' => array (
                    'marco' => array (
                        'fruit'  => array ('mango', 'cherry'), // Mango 在这儿
                        'friend' => array (
                            '...',
                        )
                    ),
                ),
            ),
            'bob'  => array (
                'fruit'  => array ('orange', 'mangosteen', 'peach'),
                'friend' => array (
                    '',
                ),
            ),

        ),
    ),
    'tom'  => array (
        'fruit'  => array (
            'apple',
            'banana',
        ),
        'friend' => array (
            'lucy' => array (
                'fruit'  => array (),
                'friend' => array (
                    'lucy' => array (
                        'fruit'  => array ('bear', 'watermelon'),
                        'friend' => array (
                            'marco' => array (
                                'fruit'  => array ('mango', 'cherry'), // Mango 在这儿也有
                                'friend' => array (
                                    '...',
                                )
                            ),
                        ),
                    ),
                ),
            ),
            'bob'  => array (
                'fruit'  => array ('apple', 'peach'),
                'friend' => array (
                    'marco' => array (
                        'fruit'  => array ('mango', 'cherry'), // Mango 在这儿也有
                        'friend' => array (
                            'Marco 有无数多的盆友...',
                        )
                    ),
                )
            ),
        ),
    )
);

echo (new BFSQuery($me, 'mango'))->run();