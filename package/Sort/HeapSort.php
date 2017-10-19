<?php

/**
 * @example  堆排序 (大根堆)
 * @author   ShaoWei Pu <pushaowei0727@gmail.com>
 * @date     2017/10/9
 * @license  MIT
 * -------------------------------------------------------------
 * 思路分析：堆排序利用了大根堆堆顶记录的关键字最大（或最小）这一特征
 * -------------------------------------------------------------
 *  堆排序(HeapSort)是指利用堆积树（堆）这种数据结构所设计的一种排序算法，它是选择排序的一种。
 *  可以利用数组的特点快速定位指定索引的元素。堆分为大根堆和小根堆，是完全二叉树。
 *  大根堆的要求是每个节点的值都不大于其父节点的值，即A[PARENT[i]] >= A[i]。在数组的非降序排序中，需要使用的就是大根堆，
 *  因为根据大根堆的要求可知，最大的值一定在堆顶。
 */
class HeapSort
{
    /**
     * @var int
     */
    protected $count;

    /**
     * @var array
     */
    protected $data;

    /**
     * HeapSort constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->count = count($data);
        $this->data  = $data;
    }

    /**
     * Action
     *
     * @return array
     */
    public function run()
    {
        $this->createHeap();
        while ($this->count > 0) {
            /* 这是一个大顶堆 , 所以堆顶的节点必须是最大的
               根据此特点 , 每次都将堆顶数据移到最后一位
               然后对剩余数据节点再次建造堆就可以 */
            $this->swap($this->data[0], $this->data[--$this->count]);
            $this->buildHeap($this->data, 0, $this->count);
        }
        return $this->data;
    }

    /**
     * 创建一个堆
     */
    public function createHeap()
    {
        $i = ceil($this->count / 2) + 1;
        while ($i--) {
            $this->buildHeap($this->data, $i, $this->count);
        }
    }

    /**
     * 从 数组 的第 $i 个节点开始至 数组长度为0 结束 , 递归的将其 ( 包括其子节点 ) 转化为一个小顶堆
     *
     * @param $data
     * @param $i
     * @param $count
     */
    public function buildHeap(array &$data, $i, $count)
    {
        if (false === $i < $count) {
            return;
        }
        // 获取左 / 右节点
        $right = ($left = 2 * $i + 1) + 1;
        $max   = $i;
        // 如果左子节点大于当前节点 , 那么记录左节点键名
        if ($left < $count && $data[$i] < $data[$left]) {
            $max = $left;
        }
        // 如果右节点大于刚刚记录的 $max , 那么再次交换
        if ($right < $count && $data[$max] < $data[$right]) {
            $max = $right;
        }
        if ($max !== $i && $max < $count) {
            $this->swap($data[$i], $data[$max]);
            $this->buildHeap($data, $max, $count);
        }
    }

    /**
     * 交换空间
     *
     * @param $left
     * @param $right
     */
    public function swap(&$left, &$right)
    {
        list($left, $right) = array ($right, $left);
    }
}

$array  = array (4, 21, 41, 2, 53, 1, 213, 31, 21, 423, 56);
$result = (new HeapSort($array))->run();
var_dump($result);
