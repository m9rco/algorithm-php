<?php

/**
 * 扑克牌游戏
 *
 * @author   Pu ShaoWei <marco0727@gamil.com>
 * @date     2017/9/18
 * @license  MIT
 */

$card_num = 54;//牌数
function washCard($card_num)
{
    $cards = range(1, $card_num);
    for ($i = $card_num - 1; $i > 0; $i--) {
        $rnd = rand(0,$i - 1);
        list($cards[$rnd],$cards[$i]) = array($cards[$i],$cards[$rnd]);
    }
    return $cards;
}

// 测试：
//var_dump(washCard($card_num));die;

/**
 * PokerGames   纯属娱乐，有空再优化, 这样够随机吧
 *
 * @uses     description
 * @version  1.0
 * @author   Pu ShaoWei <marco0727@gamil.com>
 */
class PokerGames
{
    const RANDOM = "https://www.random.org/integers/?num=%d&min=1&max=%d&col=1&base=10&format=plain&rnd=new";
    const LIMIT  = 10;

    protected $resources;
    protected $tally;
    protected $i;
    protected $count;
    protected $clear;
    protected $container = array ();
    protected $poker     = array ();

    /**
     * PokerGames constructor.
     */
    public function __construct()
    {
        $this->container = $this->makePoker();
        $count           = count($this->container);
        $this->i         = $this->tally = round(100 / $count, 2);
        $this->clear     = in_array(PHP_OS, array ('Darwin', 'Linux'));
        $this->taskJob($this->generator($count, round($count / 2)));
    }

    /**
     * 弄着玩，不推进实际生产里玩 | 无脑方法2
     *
     * @param \Generator $task
     */
    public function taskJob(Generator $task)
    {
        foreach ($task as $value) {
            if (empty($value)) {
                break;
            }
            foreach ($value as $_value) {
                if (isset($this->container[$_value])) {
                    array_push($this->poker, $this->container[$_value]);
                    unset($this->container[$_value]);
                    $this->clear && system("clear");
                    echo "正在洗牌中.. " . intval($this->tally) . "% \n";
                    $this->tally += $this->i;
                }
                continue;
            }
        }
    }

    /**
     * __destruct,
     */
    public function __destruct()
    {
        curl_close($this->resources); // 2. 关闭资源在这个时候关闭是否合适 有待考究
        $this->poker = array_merge($this->poker, array_diff_assoc($this->container, $this->poker));
        var_dump($this->poker);
    }

    /**
     * generator 好像没别的用  就为了装
     *
     * @param     $limit
     * @param     $max
     * @return \Generator
     */
    public function generator($max, $limit = 1)
    {
        while ($limit--) {
            yield $this->makeRand($max);
        }
    }

    /**
     * 创建一副扑克牌
     *
     * @return array
     */
    public function makePoker()
    {
        $porker = array ('大王', '小王');
        foreach (array ('红桃', '方块', '梅花', '黑桃') as $pValue) {
            $limit = 13;
            while ($limit--) {
                switch ($limit) {
                    case 0:
                        $temp = "J";
                        break;
                    case 1:
                        $temp = "A";
                        break;
                    case 11:
                        $temp = "Q";
                        break;
                    case 12:
                        $temp = "K";
                        break;
                    default:
                        $temp = $limit;
                        break;
                }
                array_push($porker, $pValue . $temp);
            }
        }
        return $porker;
    }

    /**
     * 去大气噪音那里拿随机数
     *
     * @param $max
     * @return mixed
     */
    public function makeRand($max)
    {
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => sprintf(self::RANDOM, $max, $max),
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => array ('Expect:'),
            CURLOPT_HEADER         => false,
            CURLOPT_CONNECTTIMEOUT => self::LIMIT,
            CURLOPT_TIMEOUT        => self::LIMIT,
        ]);
        $result          = curl_exec($ch);
        $code            = curl_getinfo($ch)['http_code'];
        $this->resources = $ch;
        if ($code == 200) {
            return explode(PHP_EOL, $result);
        }
        return false;
    }
}

new PokerGames();
