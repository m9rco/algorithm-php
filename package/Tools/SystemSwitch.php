<?php

/**
 * SystemSwitch
 *
 * @author   Pu ShaoWei <pushaowei0727@gmail.com>
 * @date     2017/10/16
 * @license  MIT
 * -------------------------------------------------------------
 * 十进制整数转换为二、八、十六进制整数   n = (n div d) * d + n mod d
 * -------------------------------------------------------------
 * @param array
 */
class SystemSwitch
{
    /**
     * @var array
     */
    protected $systemGather;

    /**
     * @var int
     */
    protected $input;

    /**
     * @var mixed
     */
    protected $output;

    /**
     * SystemSwitch constructor.
     *
     * @param $input
     * @param $output
     */
    public function __construct($input, $output)
    {
        $this->systemGather = array (2, 8, 16);
        $this->input        = $input;
        $this->output       = $output;
    }

    public function run()
    {
        $before = $this->input;
        $stack  = new StackExample();
        while ($this->input != 0) {
            $mod = $this->input % $this->output;
            $stack->setPushStack($mod);
            $this->input = (int)($this->input - $mod) / $this->output;
        }
        $output = '';
        if ($this->output == 16) {
            $output .= '0x';
        } else if ($this->output == 8) {
            $output .= '0';
        }

        foreach ($stack->getAllPopStack() as $value) {
            if ($this->output == 16) {
                switch ($value) {
                    case 10:
                        $value = 'A';
                        break;
                    case 11:
                        $value = 'B';
                        break;
                    case 12:
                        $value = 'C';
                        break;
                    case 13:
                        $value = 'D';
                        break;
                    case 14:
                        $value = 'E';
                        break;
                    case 15:
                        $value = 'F';
                        break;
                }
            }
            $output .= $value;
        }
        // 因为输出语句会自动将整型的数转换为10进制输出
        // 也即如果转换后的结果为0xff,直接将0xff输出会得到255，所以返回一数组
        return array (
            'before' => $before,                           // 转换之前
            'after'  => intval($output, $this->output),    // 转换后的整型数（整型）
            'string' => $output                            // 转换后的整型数的字符串表示（字符串型）
        );
    }
}

// load the stack
define("DS", DIRECTORY_SEPARATOR);
require_once dirname(__DIR__) . DS . 'Structure' . DS . 'StackExample.php';
$systemObj = new SystemSwitch(6, 16);
$result    = $systemObj->run();
var_dump($result);