<?php

/**
 * ChineseTextNumberSort
 *
 * @author    Pu ShaoWei
 * @date      2019-05-17
 * @version   1.0
 */
class ChineseTextNumberSort
{
    const CHINESE_DIGITAL_MATCHING = '/零|一|二|三|四|五|六|七|八|九|十/';

    /**
     * 解析文本到十位
     *
     * @param $text
     * @return false|float|int|string
     */
    public function parsingText($text)
    {
        $structure = '';
        $mapping   = array ('零', '一', '二', '三', '四', '五', '六', '七', '八', '九', '十');
        preg_match_all('/一|二|三|四|五|六|七|八|九|十/', $text, $structure, PREG_PATTERN_ORDER);
        if (empty($structure[0])) {
            return 0;
        }
        $currentNum = 0;
        foreach ($structure[0] as $plane => $matchNum) {
            if ($matchNum === '十') {
                if ($plane === 0) {
                    $currentNum += 10;
                    continue;
                }
                if ($plane === 1) {
                    $index      = array_search($structure[0][0], $mapping);
                    $currentNum -= $index;
                    $currentNum += $index * 10;
                    continue;
                }
            }
            $index      = array_search($matchNum, $mapping);
            $currentNum += $index;
        }
        return $currentNum;
    }

    /**
     * isChinese
     *
     * @param $text
     * @return bool
     */
    public function isCompletelyChinese($text)
    {
        return boolval(preg_match('/^[\x7f-\xff]+$/', $text));
    }

}