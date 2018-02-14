<?php

/**
 * KitchenQueue
 * -------------------------------------------------------------
 * [游戏说明]
 * 假设你要为饭店创建一个接受顾客点菜单点应用程序，这个应用程序存储一系列点菜服务，服务员添加菜单，
 * 而厨师取出菜单并制作菜肴
 * -------------------------------------------------------------
 *
 * @author    Pu ShaoWei <pushaowei@360.cn>
 * @date      2017/12/3
 * @version   1.0
 * @license   MIT
 */

class KitchenQueue
{
    /**
     * @var \stdClass $cooking
     */
    protected $cooking;

    /**
     * 服务员
     *
     * @param $dishes
     */
    public function waiter($dishes)
    {
        $node          = new \stdClass();
        $node->element = $dishes;
        $node->next    = $this->cooking;
        $this->cooking = $node;
    }

    /**
     * 厨师
     *
     * @return \stdClass
     */
    public function kitchen()
    {
        return $this->cooking;
    }
}

$kitchen = new KitchenQueue();
$kitchen->waiter("Qin Jiao Rou Si");
$kitchen->waiter("Ma Po Dou Fu");
$kitchen->waiter("Fu Qi Fei Pian");
$kitchen->waiter("Kou Shui Ji");
var_dump($kitchen->kichen());
