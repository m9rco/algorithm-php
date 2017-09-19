<?php

/**
 * 扑克牌游戏
 *
 * @author   Pu ShaoWei <marco0727@gamil.com>
 * @date     2017/9/18
 * @license  MIT
 */

$card_num = 54;//牌数
function wash_card($card_num)
{
    $cards = $tmp = array ();
    $tmp = range(0,$card_num);

    for ($i = 0; $i < $card_num; $i++) {
        $index     = rand(0, $card_num - $i - 1);
        $cards[$i] = $tmp[$index];
        unset($tmp[$index]);
        $tmp = array_values($tmp);
    }
    return $cards;
}

// 测试：
//var_dump(wash_card($card_num));

/**
 * description
 *
 * @uses     description
 * @version  1.0
 * @author   Pu ShaoWei <marco0727@gamil.com>
 */
class PokerGames extends SplQueue
{
    /**
     * PokerGames constructor.
     *
     * @param $num
     */
    public function __construct($num)
    {
        $this->setIteratorMode(SplQueue::IT_MODE_DELETE);
        while ($num--) {
            $this->enqueue($num);
        }

        $generator = $this->generator(22);
        $generator->send("s");

        while (!$generator->valid()){
            $generator->rewind();
            $generator->current();
        }

    }

    /**
     * __destruct,
     */
    public function __destruct(){
    }

    /**
     * generator
     *
     * @param     $limit
     * @return \Generator
     */
    public function generator($limit)
    {
        for ($i = 0; $i <= $limit; $i++) {
            yield $i;
        }
    }

    public function makePoker()
    {

    }
}

/**
 *  红桃 2 3 4 5 6 7 8 9 10 J Q K A
    黑桃 2 3 4 5 6 7 8 9 10 J Q K A
    梅花 2 3 4 5 6 7 8 9 10 J Q K A
    方块 2 3 4 5 6 7 8 9 10 J Q K A
    Joker joker
 */

$porker = new PokerGames();
var_dump($porker);
