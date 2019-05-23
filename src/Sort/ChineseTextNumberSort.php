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
    /**
     * @var string text
     */
    const CHINESE_DIGITAL_MATCHING = '/\x{96f6}|\x{4e00}|\x{4e8c}|\x{4e09}|\x{56db}|\x{4e94}|\x{516d}|\x{4e03}|\x{516b}|\x{4e5d}|\x{5341}/ui';

    /**
     * @var string  regular rules [! order can not arbitrarily change]
     */
    const MODEL_REGULAR_A = <<<REGEXPS
/^\x{7b2c}(\x{4e00}|\x{4e8c}|\x{4e09}|\x{56db}|\x{4e94}|\x{516d}|\x{4e03}|\x{516b}|\x{4e5d}|\x{5341}){1}(\x{7ae0}|\x{8282}|\x{8bfe}|\x{5355}\x{5143})([\f\n\r\t\v]|\x09|\s){1}+/u
REGEXPS;
    const MODEL_REGULAR_D = '/^(\d{1,2})(\x{9875})\-{1}/u';
    const MODEL_REGULAR_E = '/^(\d{1,2})\-/i';
    const MODEL_REGULAR_F = '/^(\d{1,2})([\f\n\r\t\v]|\x09|\s)+/i';
    const MODEL_REGULAR_G = '/^(\d{1,2})(\x{3001}{1})+/u';
    const MODEL_REGULAR_H = '/\x{518c}(\d{1,2})(\s){1}(\x{ff1a}|\:){1}/u';
    const MODEL_REGULAR_I = '/([\f\n\r\t\v]|\x09|\s){1}(\d+)/i';
    const MODEL_REGULAR_B = '/^\d{1,2}+/i';
    const MODEL_REGULAR_C = '/^\d{1,2}([\f\n\r\t\v]|\x09|\s){1}+/i';

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
        preg_match_all(static::CHINESE_DIGITAL_MATCHING, $text, $structure, PREG_PATTERN_ORDER);
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

    /**
     * regularModel
     *
     * @param $regularModel
     * @param $text
     * @return bool
     */
    public function regularModel($regularModel, $text)
    {
        return boolval(preg_match($regularModel, $text));
    }

    /**
     * extractModel
     *
     * @param $regularModel
     * @param $text
     * @return string
     * @throws \Exception
     */
    public function extractModel($regularModel, $text)
    {
        $result = '';
        if (preg_match($regularModel, $text, $result)) {
            return trim($result[$this->modelMappingIndex($regularModel)]);
        }
        throw new Exception('The matching error');
    }

    /**
     * modelMappingIndex
     *
     * @param $regularModel
     * @return int|mixed
     */
    protected function modelMappingIndex($regularModel)
    {
        return array (
                   static::MODEL_REGULAR_A => 1,
                   static::MODEL_REGULAR_B => 0,
                   static::MODEL_REGULAR_C => 0,
                   static::MODEL_REGULAR_D => 1,
                   static::MODEL_REGULAR_E => 1,
                   static::MODEL_REGULAR_F => 1,
                   static::MODEL_REGULAR_G => 1,
                   static::MODEL_REGULAR_H => 1,
                   static::MODEL_REGULAR_I => 2
               )[$regularModel] ?? 1;
    }

    /**
     * chineseConversionNum
     *
     * @param $text
     * @return mixed
     */
    public function chineseConversionNum($text)
    {
        if ($this->regularModel(static::CHINESE_DIGITAL_MATCHING, $text)) {
            $mapping = array ('零', '一', '二', '三', '四', '五', '六', '七', '八', '九', '十');
            return array_search($text, $mapping);
        }
        return ltrim($text, 0);
    }

    /**
     * getAllModelRegular
     *
     * @return array
     * @throws \ReflectionException
     */
    public function getAllModelRegular()
    {
        $constants  = (new \ReflectionClass(__CLASS__))->getConstants();
        $collection = array ();
        foreach ($constants as $key => $value) {
            if (strpos($key, 'MODEL_REGULAR_') !== false) {
                $collection[$key] = $value;
            }
        }
        return $collection;
    }

    /**
     * modelAnalysis
     *
     * @param $text
     * @return int|string
     * @throws \ReflectionException
     */
    public function modelAnalysis($text)
    {
        foreach ($this->getAllModelRegular() as $item) {
            if ($this->regularModel($item, $text)) {
                return $item;
            }
        }
        throw new Exception('Model Analysis of the failure !');
    }

    /**
     * textAnalysis
     *
     * @param $text
     * @return int
     */
    public function textAnalysis($text)
    {
        try {
            return (int)$this->chineseConversionNum($this->extractModel(
                $this->modelAnalysis($text),
                $text
            )
            );
        } catch (Exception $e) {
            return 0;
        }
    }

    /**
     * chineseTextList
     *
     * @param array $list
     * @return array
     */
    public function chineseTextListSorter(array $list)
    {
        $container = $generate = array ();
        foreach ($list as $item) {
            $container[] = $this->textAnalysis($item);
        }
        if (count($container) !== count($list)) {
            return $list;
        }
        uksort($list, function ($left, $right) use ($container) {
            if ($left == $right) {
                return 0;
            }
            return $container[$left] < $container[$right] ? -1 : 1;
        });
        return array_values($list);
    }
}