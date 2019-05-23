<?php

/**
 * ChineseTextNumberSortModelTest
 *
 * @author    Pu ShaoWei <pushaowei@360.cn>
 * @date      2019-05-23
 * @version   1.0
 */
class ChineseTextNumberExtractTest extends PHPUnit\Framework\TestCase
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
     * testValidationModelA
     *
     * @test
     * @throws \Exception
     */
    public function testValidationModelA()
    {
        $this->assertEquals(
            $this->chineseObj->extractModel(
                ChineseTextNumberSort::MODEL_REGULAR_A,
                '第二章 我是Marco小哥哥'
            ),
            '二'
        );

        $this->assertEquals(
            $this->chineseObj->extractModel(
                ChineseTextNumberSort::MODEL_REGULAR_A,
                '第一节 我是Marco小哥哥'
            ),
            '一'
        );

        $this->assertEquals(
            $this->chineseObj->extractModel(
                ChineseTextNumberSort::MODEL_REGULAR_A,
                '第二单元 我是Marco小哥哥'
            ),
            '二'
        );

        $this->assertNotEquals(
            $this->chineseObj->extractModel(
                ChineseTextNumberSort::MODEL_REGULAR_A,
                '第一章 我是Marco小哥哥'
            ),
            '1'
        );
    }

    /**
     * testValidationModelB
     *
     * @throws \Exception
     * @test
     */
    public function testValidationModelB()
    {
        $this->assertEquals(
            $this->chineseObj->extractModel(
                ChineseTextNumberSort::MODEL_REGULAR_B,
                '01我是Marco小哥哥'
            ),
            '01'
        );

        $this->assertEquals(
            $this->chineseObj->extractModel(
                ChineseTextNumberSort::MODEL_REGULAR_B,
                '12我是Marco小哥哥'
            ),
            '12'
        );

        $this->assertNotEquals(
            $this->chineseObj->extractModel(
                ChineseTextNumberSort::MODEL_REGULAR_B,
                '10章我是Marco小哥哥'
            ),
            '1'
        );
    }

    /**
     * testValidationModelC
     *
     * @throws \Exception
     * @test
     */
    public function testValidationModelC()
    {
        $this->assertEquals(
            $this->chineseObj->extractModel(
                ChineseTextNumberSort::MODEL_REGULAR_C,
                '1 我是Marco小哥哥'
            ),
            1
        );

        $this->assertEquals(
            $this->chineseObj->extractModel(
                ChineseTextNumberSort::MODEL_REGULAR_C,
                '22 我是Marco小哥哥'
            ),
            22
        );

        $this->assertNotEquals(
            $this->chineseObj->extractModel(
                ChineseTextNumberSort::MODEL_REGULAR_C,
                '22 我是Marco小哥哥'
            ),
            21
        );
    }

    /**
     * testValidationModelD
     *
     * @throws \Exception
     * @test
     */
    public function testValidationModelD()
    {
        $this->assertEquals(
            $this->chineseObj->extractModel(
                ChineseTextNumberSort::MODEL_REGULAR_D,
                '1页-我是Marco小哥哥'
            ),
            1
        );

        $this->assertEquals(
            $this->chineseObj->extractModel(
                ChineseTextNumberSort::MODEL_REGULAR_D,
                '22页-+我是Marco小哥哥'
            ),
            22
        );

        $this->assertNotEquals(
            $this->chineseObj->extractModel(
                ChineseTextNumberSort::MODEL_REGULAR_D,
                '2页-+我是Marco小哥哥'
            ),
            22
        );
    }

    /**
     * testValidationModelE
     *
     * @throws \Exception
     * @test
     */
    public function testValidationModelE()
    {
        $this->assertEquals(
            $this->chineseObj->extractModel(
                ChineseTextNumberSort::MODEL_REGULAR_E,
                '1-'
            ),
            1
        );

        $this->assertEquals(
            $this->chineseObj->extractModel(
                ChineseTextNumberSort::MODEL_REGULAR_E,
                '2-+我是Marco小哥哥'
            ),
            2
        );

        $this->assertNotEquals(
            $this->chineseObj->extractModel(
                ChineseTextNumberSort::MODEL_REGULAR_E,
                '23-我是Marco小哥哥'
            ),
            24
        );
    }

    /**
     * testValidationModelF
     *
     * @throws \Exception
     * @test
     */
    public function testValidationModelF()
    {
        $this->assertEquals(
            $this->chineseObj->extractModel(
                ChineseTextNumberSort::MODEL_REGULAR_F,
                '1  但是'
            ),
            1
        );

        $this->assertEquals(
            $this->chineseObj->extractModel(
                ChineseTextNumberSort::MODEL_REGULAR_F,
                '1  2对对对'
            ),
            1
        );

        $this->assertNotEquals(
            $this->chineseObj->extractModel(
                ChineseTextNumberSort::MODEL_REGULAR_F,
                '22 我是Marco小哥哥'
            ),
            2
        );
    }

    /**
     * testValidationModelG
     *
     * @throws \Exception
     * @test
     */
    public function testValidationModelG()
    {
        $this->assertEquals(
            $this->chineseObj->extractModel(
                ChineseTextNumberSort::MODEL_REGULAR_G,
                '1、、'
            ),
            1
        );

        $this->assertEquals(
            $this->chineseObj->extractModel(
                ChineseTextNumberSort::MODEL_REGULAR_G,
                '01、2对对对'
            ),
            01
        );

        $this->assertNotEquals(
            $this->chineseObj->extractModel(
                ChineseTextNumberSort::MODEL_REGULAR_G,
                '23、我是Marco小哥哥'
            ),
            24
        );
    }

    /**
     * testValidationModelH
     *
     * @throws \Exception
     * @test
     */
    public function testValidationModelH()
    {
        $this->assertEquals(
            $this->chineseObj->extractModel(
                ChineseTextNumberSort::MODEL_REGULAR_H,
                '我爱Marco老师小册10 :'
            ),
            10
        );

        $this->assertEquals(
            $this->chineseObj->extractModel(
                ChineseTextNumberSort::MODEL_REGULAR_H,
                '我爱Marco老师小册1 ： 阳光鱼'
            ),
            1
        );

        $this->assertNotEquals(
            $this->chineseObj->extractModel(
                ChineseTextNumberSort::MODEL_REGULAR_H,
                '我爱Marco老师小册1 ： 阳光鱼'
            ),
            122
        );
    }

    /**
     * testValidationModelI
     *
     * @throws \Exception
     */
    public function testValidationModelI()
    {
        $this->assertEquals(
            $this->chineseObj->extractModel(
                ChineseTextNumberSort::MODEL_REGULAR_I,
                '识字一 01 十'
            ),
            '01'
        );

        $this->assertEquals(
            $this->chineseObj->extractModel(
                ChineseTextNumberSort::MODEL_REGULAR_I,
                '狮子 03卧槽'
            ),
            '03'
        );

        $this->assertNotEquals(
            $this->chineseObj->extractModel(
                ChineseTextNumberSort::MODEL_REGULAR_I,
                '狮子 03卧槽'
            ),
            '04'
        );
    }
}