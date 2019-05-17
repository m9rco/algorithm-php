<?php

/**
 * KMP算法
 *
 * @author   Neroxiezi  <lampxiezi@163.com>
 * @date     2018/1/11
 * @license  MIT
 * -------------------------------------------------------------
 * KMP算法是一种改进的字符串匹配算法
 * KMP精要：KMP在进行朴素匹配时，如果发现不匹配字符时，通过对已经匹配的那部分字符串的最大前缀来快速找到下一个模式串需要匹配的位置。
 * KMP对模式进行预处理时间复杂度O(m)，匹配时间复杂度O(n)，总的KMP时间复杂度为O(m+n)。
 * 参考 字符串匹配的KMP算法 — 阮一峰
 */


// +--------------------------------------------------------------------------
// | 解题方式    | 这儿，可能有用的解决方案
// +--------------------------------------------------------------------------

class KMP
{
    public  $haystack;
    public  $needle;
    private $_haystackLen;
    private $_needleLen;
    private $_matchTable;
    private $_isMatch;

    //构造函数
    function __construct($haystack, $needle)
    {
        $this->haystack = $haystack;
        $this->needle   = $needle;
        //初始化一些参数
        $this->_haystackLen = $this->getLen($this->haystack);
        $this->_needleLen   = $this->getLen($this->needle);
        $this->_matchTable  = $this->getMatchTable();
        $this->_isMatch     = false;
    }


    //类似strpos函数功能
    public function strpos()
    {
        //haystack
        $haystackIdx = $matchNum = 0;
        while ($haystackIdx <= $this->_haystackLen - $this->_needleLen) {
            //needle
            $needIdx = 0;
            for (; $needIdx < $this->_needleLen; $needIdx++) {
                if (strcmp($this->haystack[$haystackIdx], $this->needle[$needIdx]) <> 0) {
                    if ($matchNum > 0) {
                        $lastMatchValue = $this->getLastMatchValue($needIdx - 1);
                        $haystackIdx    += $this->getStep($matchNum, $lastMatchValue);
                        $matchNum       = 0;
                    } else {
                        $haystackIdx++;
                    }
                    break;
                } else {
                    $haystackIdx++;
                    $matchNum++;
                    if ($matchNum == $this->_needleLen) {
                        $this->_isMatch = true;
                        break;
                    }
                }
            }
            if ($this->_isMatch == true) {
                break;
            }
        }
        return $this->_isMatch ? $haystackIdx - $this->_needleLen : false;
    }

    //获取字符长度
    private function getLen($str)
    {
        return mb_strlen($str, 'utf-8');
    }

    //获取部分匹配表
    private function getMatchTable()
    {
        $matchTable = [];
        for ($i = 0; $i < $this->_needleLen; $i++) {
            $intersectLen = 0;
            $nowStr       = mb_substr($this->needle, 0, $i + 1, 'utf-8');
            $preFixArr    = $this->getPreFix($nowStr);
            $sufFixArr    = $this->getSufFix($nowStr);
            if ($preFixArr && $sufFixArr) {
                $intersectArr = array_intersect($preFixArr, $sufFixArr);
                if (!empty($intersectArr)) {
                    $intersect    = array_pop($intersectArr);
                    $intersectLen = mb_strlen($intersect, 'utf-8');
                }
            }
            $matchTable[$i] = $intersectLen;
        }
        return $matchTable;
    }

    //获取前缀数组
    private function getPreFix($str)
    {
        $outArr = [];
        $strLen = $this->getLen($str);
        if ($strLen > 1) {
            for ($i = 1; $i < $strLen; $i++) {
                $outArr[] = mb_substr($str, 0, $i, 'utf-8');
            }
        }
        return $outArr;
    }

    //获取后缀数组
    private function getSufFix($str)
    {
        $outArr = [];
        $strLen = $this->getLen($str);
        if ($strLen > 1) {
            for ($i = 1; $i < $strLen; $i++) {
                $outArr[] = mb_substr($str, $i, null, 'utf-8');
            }
        }
        return $outArr;
    }

    //计算步长
    private function getStep($matchNum, $lastMatchValue)
    {
        return $matchNum - $lastMatchValue;
    }

    //获取最后匹配值
    private function getLastMatchValue($index)
    {
        return isset($this->_matchTable[$index]) ? $this->_matchTable[$index] : 0;
    }

}

// +--------------------------------------------------------------------------
// | 方案测试    | php `this.php` || PHPStorm -> 右键 -> Run `this.php`
// +--------------------------------------------------------------------------

$str    = 'a b a c a a b a c a b a c a b a a b b';
$subStr = 'a b a c a b';
$kmp    = new KMP($str, $subStr);
var_dump($kmp->strpos());
$kmp->haystack = 'pull requests';
$kmp->needle   = 'sts';
var_dump($kmp->strpos());
$kmp->haystack = 'i love you';
$kmp->needle   = 'hate';
var_dump($kmp->strpos());