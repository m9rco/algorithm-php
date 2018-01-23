<?php

/**
 * 二叉树非递归遍历算法实现
 * @author      Openset <openset.wang@gmail.com>
 * @link        https://github.com/openset
 * @date        2018/01/23
 */
class Node
{
    public $value;
    public $left;
    public $right;
}

//先序遍历 根节点 ---> 左子树 ---> 右子树
function DLROrder($root)
{
    $stack = array();
    array_push($stack, $root);
    while (!empty($stack)) {
        $center_node = array_pop($stack);
        echo $center_node->value . ' ';//先输出根节点
        if ($center_node->right != null) {
            array_push($stack, $center_node->right);//压入左子树
        }
        if ($center_node->left != null) {
            array_push($stack, $center_node->left);
        }
    }
}

//中序遍历，左子树---> 根节点 ---> 右子树
function LDROrder($root)
{
    $stack = array();
    $center_node = $root;
    while (!empty($stack) || $center_node != null) {
        while ($center_node != null) {
            array_push($stack, $center_node);
            $center_node = $center_node->left;
        }

        $center_node = array_pop($stack);
        echo $center_node->value . " ";

        $center_node = $center_node->right;
    }
}

//后序遍历，左子树 ---> 右子树 ---> 根节点
function LRDOrder($root)
{
    $stack = array();
    $outstack = array();
    array_push($stack, $root);
    while (!empty($stack)) {
        $center_node = array_pop($stack);
        array_push($outstack, $center_node);//最先压入根节点，最后输出
        if ($center_node->left != null) {
            array_push($stack, $center_node->left);
        }
        if ($center_node->right != null) {
            array_push($stack, $center_node->right);
        }
    }

    while (!empty($outstack)) {
        $center_node = array_pop($outstack);
        echo $center_node->value . ' ';
    }

}

$a = new Node();
$b = new Node();
$c = new Node();
$d = new Node();
$e = new Node();
$f = new Node();
$a->value = 'A';
$b->value = 'B';
$c->value = 'C';
$d->value = 'D';
$e->value = 'E';
$f->value = 'F';
$a->left = $b;
$a->right = $c;
$b->left = $d;
$c->left = $e;
$c->right = $f;

DLROrder($a);//A B D C E F

LDROrder($a);//D B A E C F

LRDOrder($a);//D B E F C A