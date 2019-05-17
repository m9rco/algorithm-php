<?php
/**
 * Test
 *
 * @author    Pu ShaoWei
 * @date      2019-05-17
 * @version   1.0
 */


class ChineseTextNumberSortTest extends PHPUnit\Framework\TestCase
{

    /**
     * description
     *
     * @test
     */
    public function testAnalysisText()
    {
        $chineseObj = new ChineseTextNumberSort();
        $this->assertTrue($chineseObj->isCompletelyChinese('我艹'), 'Is not entirely Chinese');
        $this->assertEquals($chineseObj->parsingText('第一十二章四十五'), 12);
        $this->assertEquals($chineseObj->parsingText('十三'), 13);
        $this->assertEquals($chineseObj->parsingText('二十三'), 23);
        $this->assertEquals($chineseObj->parsingText('一十三'), 13);
    }
}
