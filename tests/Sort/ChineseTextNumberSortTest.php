<?php

/**
 * ChineseTextNumberSortTest
 *
 * @author    Pu ShaoWei
 * @date      2019-05-17
 * @version   1.0
 */
class ChineseTextNumberSortTest extends PHPUnit\Framework\TestCase
{
    /**
     * @var
     */
    protected $chineseObj;

    /**
     * ChineseTextNumberSortTest constructor.
     *
     * @param string|null $name
     * @param array       $data
     * @param string      $dataName
     */
    public function __construct(
        ?string $name = null,
        array $data = [],
        string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->chineseObj = new ChineseTextNumberSort();
    }

    /**
     * testChineseTextListSorter
     */
    public function testChineseTextListSorter()
    {
        $this->assertArraySubset(
            $this->chineseObj->chineseTextListSorter(
                array (
                    '第五章 我是Marco小哥哥',
                    '第一章 我是Marco小哥哥',
                    '第三章 我是Marco小哥哥',
                    '第三章 我是Marco小哥哥',
                    '第二章 我是Marco小哥哥',
                )),
            array (
                '第一章 我是Marco小哥哥',
                '第二章 我是Marco小哥哥',
                '第三章 我是Marco小哥哥',
                '第三章 我是Marco小哥哥',
                '第五章 我是Marco小哥哥',
            )
        );

        $this->assertArraySubset(
            $this->chineseObj->chineseTextListSorter(
                array (
                    '05我是Marco小哥哥',
                    '03我是Marco小哥哥',
                    '02我是Marco小哥哥',
                    '04我是Marco小哥哥',
                    '01我是Marco小哥哥',
                )),
            array (
                '01我是Marco小哥哥',
                '02我是Marco小哥哥',
                '03我是Marco小哥哥',
                '04我是Marco小哥哥',
                '05我是Marco小哥哥',
            )
        );

        $this->assertArraySubset(
            $this->chineseObj->chineseTextListSorter(
                array (
                    '6页-我是Marco小哥哥',
                    '2页-我是Marco小哥哥',
                    '3页-我是Marco小哥哥',
                    '4页-我是Marco小哥哥',
                    '5页-我是Marco小哥哥',
                    '1页-我是Marco小哥哥',
                )),
            array (
                '1页-我是Marco小哥哥',
                '2页-我是Marco小哥哥',
                '3页-我是Marco小哥哥',
                '4页-我是Marco小哥哥',
                '5页-我是Marco小哥哥',
                '6页-我是Marco小哥哥',
            )
        );

        $this->assertArraySubset(
            $this->chineseObj->chineseTextListSorter(
                array (
                    '我爱Marco老师小册6 :',
                    '我爱Marco老师小册2 :',
                    '我爱Marco老师小册3 :',
                    '我爱Marco老师小册4 :',
                    '我爱Marco老师小册5 :',
                    '我爱Marco老师小册1 :',
                    '我爱Marco老师小册7 :',
                )),
            array (
                '我爱Marco老师小册1 :',
                '我爱Marco老师小册2 :',
                '我爱Marco老师小册3 :',
                '我爱Marco老师小册4 :',
                '我爱Marco老师小册5 :',
                '我爱Marco老师小册6 :',
                '我爱Marco老师小册7 :',
            )
        );

        $this->assertArraySubset(
            $this->chineseObj->chineseTextListSorter(
                array (
                    '6、2对对对',
                    '2、2对对对',
                    '4、2对对对',
                    '3、2对对对',
                    '5、2对对对',
                    '1、2对对对',
                )),
            array (
                '1、2对对对',
                '2、2对对对',
                '3、2对对对',
                '4、2对对对',
                '5、2对对对',
                '6、2对对对',
            )
        );
    }


    /**
     * testTextAnalysis
     */
    public function testTextAnalysis()
    {
        $this->assertEquals(
            $this->chineseObj->textAnalysis('第二章 我是Marco小哥哥'),
            2
        );
        $this->assertEquals(
            $this->chineseObj->textAnalysis('01我是Marco小哥哥'),
            1
        );
        $this->assertEquals(
            $this->chineseObj->textAnalysis('1 我是Marco小哥哥'),
            1
        );
        $this->assertEquals(
            $this->chineseObj->textAnalysis('1页-我是Marco小哥哥'),
            1
        );
        $this->assertEquals(
            $this->chineseObj->textAnalysis('2-+我是Marco小哥哥'),
            2
        );
        $this->assertEquals(
            $this->chineseObj->textAnalysis('1  2对对对'),
            1
        );
        $this->assertEquals(
            $this->chineseObj->textAnalysis('1、2对对对'),
            1
        );
        $this->assertEquals(
            $this->chineseObj->textAnalysis('我爱Marco老师小册10 :'),
            10
        );
        $this->assertNotEquals(
            $this->chineseObj->textAnalysis('我爱Marco老师小册10 :'),
            12
        );
    }


    /**
     * testModelAnalysis
     *
     * @throws \ReflectionException
     */
    public function testModelAnalysis()
    {
        $this->assertEquals(
            $this->chineseObj->modelAnalysis('第二章 我是Marco小哥哥'),
            ChineseTextNumberSort::MODEL_REGULAR_A
        );
        $this->assertEquals(
            $this->chineseObj->modelAnalysis('01我是Marco小哥哥'),
            ChineseTextNumberSort::MODEL_REGULAR_B
        );

        $this->assertEquals(
            $this->chineseObj->modelAnalysis('1 我是Marco小哥哥'),
            ChineseTextNumberSort::MODEL_REGULAR_F
        );

        $this->assertEquals(
            $this->chineseObj->modelAnalysis('1页-我是Marco小哥哥'),
            ChineseTextNumberSort::MODEL_REGULAR_D
        );
        $this->assertEquals(
            $this->chineseObj->modelAnalysis('2-+我是Marco小哥哥'),
            ChineseTextNumberSort::MODEL_REGULAR_E
        );
        $this->assertEquals(
            $this->chineseObj->modelAnalysis('1  2对对对'),
            ChineseTextNumberSort::MODEL_REGULAR_F
        );
        $this->assertEquals(
            $this->chineseObj->modelAnalysis('1、2对对对'),
            ChineseTextNumberSort::MODEL_REGULAR_G
        );
        $this->assertEquals(
            $this->chineseObj->modelAnalysis('我爱Marco老师小册10 :'),
            ChineseTextNumberSort::MODEL_REGULAR_H
        );
        $this->assertNotEquals(
            $this->chineseObj->modelAnalysis('我爱Marco老师小册10 :'),
            ChineseTextNumberSort::MODEL_REGULAR_G
        );
    }

    /**
     * description
     *
     * @test
     */
    /**
     * description
     *
     * @throws \ReflectionException
     * @test
     */
    public function testAnalysisText()
    {
        var_dump($this->chineseObj->getAllModelRegular());
        die;
    }

}
