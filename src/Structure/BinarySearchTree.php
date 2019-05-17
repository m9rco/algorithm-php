<?php
/**
 * 二叉搜索树
 * 
 * 二叉搜索树或者是一棵空树，或者是具有下列性质的二叉树：
 * 1.每个结点都有一个作为搜索依据的关键码(value)，所有结点的关键码互不相同。
 * 2.左子树（如果非空）上所有结点的关键码都小于根结点的关键码。
 * 3.右子树（如果非空）上所有结点的关键码都大于根结点的关键码。
 * 4.左子树和右子树也是二叉搜索树。
 * 
 * class Node {
 *  public $value;
 *  public $left = null;
 *  public $right = null;
 * }
 */
class BinarySearchTree
{
    /**
     * @var $root 根节点
     */
    public $root = null;

    /**
     * 创建新节点
     * @param $data  关键码
     */
    protected function createNode($data)
    {
        $node = new stdClass();
        $node->value = $data;
        $node->left = null;
        $node->right = null;
        return $node;
    }


    /**
     * 插入节点
     * @param $node  根节点
     * @param $value 关键值
     */
    public function insert(&$node, $value)
    {
        if(empty($value) && $value !== 0) {
            return ;
        }

        if ($node == null) {
            $node = $this->createNode($value);
        } else if ($value < $node->value) {
            $this->insert($node->left, $value);
        } else {
            $this->insert($node->right, $value);
        }
    }

    /**
     * 先序遍历
     * @param $node 根节点
     */
    public function preOrder(&$node)
    {
       if ($node != null) {
            echo $node->value . PHP_EOL ;
            $this->preOrder($node->left);
            $this->preOrder($node->right);
        }

    }
    /**
     * 中序遍历
     * @param $node 根节点
     */
    public function middleOrder(&$node)
    {
       if ($node != null) {
           $this->middleOrder($node->left);
            echo $node->value . PHP_EOL ;
            $this->middleOrder($node->right);
        }

    }

    /**
     * 后序遍历
     * @param $node 根节点
     */
    public function afterOrder(&$node)
    {
       if ($node != null) {
            $this->afterOrder($node->left);
            $this->afterOrder($node->right);
            echo $node->value . PHP_EOL;
        }
    }

    /**
     * 获取最大值
     * @param $node 根节点
     */
    public function findMax(&$node) 
    {
        while($node->right != null) {
            $node = $node->right;
        }
        return $node->value;
    }
   
}

$tree = new BinarySearchTree();
$tree->insert($tree->root, 3);
$tree->insert($tree->root, 9);
$tree->insert($tree->root, 2);
$tree->insert($tree->root, 20);

echo "先序遍历".PHP_EOL;
$tree->preOrder($tree->root); //324
echo "中序遍历" . PHP_EOL;

$tree->middleOrder($tree->root); //324
echo "后序遍历" . PHP_EOL;

$tree->afterOrder($tree->root); //234

$max = $tree->findMax($tree->root); 

var_dump($max);