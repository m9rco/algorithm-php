<?php

/**
 * ChineseTextNumberSortModelTest
 *
 * @author    Pu ShaoWei <pushaowei@360.cn>
 * @date      2019-05-23
 * @version   1.0
 */
class ChineseTextNumberSortModelTest extends PHPUnit\Framework\TestCase
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
     */
    public function testValidationModelA()
    {
        $this->assertTrue(
            $this->chineseObj->regularModel(
                ChineseTextNumberSort::MODEL_REGULAR_A,
                '第二章 我是Marco小哥哥'
            )
        );

        $this->assertTrue(
            $this->chineseObj->regularModel(
                ChineseTextNumberSort::MODEL_REGULAR_A,
                '第一节 我是Marco小哥哥'
            )
        );

        $this->assertTrue(
            $this->chineseObj->regularModel(
                ChineseTextNumberSort::MODEL_REGULAR_A,
                '第二单元 我是Marco小哥哥'
            )
        );

        $this->assertNotTrue(
            $this->chineseObj->regularModel(
                ChineseTextNumberSort::MODEL_REGULAR_A,
                '第一章我是Marco小哥哥'
            )
        );
    }

    /**
     * testValidationModelB
     *
     * @test
     */
    public function testValidationModelB()
    {
        $this->assertTrue(
            $this->chineseObj->regularModel(
                ChineseTextNumberSort::MODEL_REGULAR_B,
                '01我是Marco小哥哥'
            )
        );

        $this->assertTrue(
            $this->chineseObj->regularModel(
                ChineseTextNumberSort::MODEL_REGULAR_B,
                '12我是Marco小哥哥'
            )
        );

        $this->assertNotTrue(
            $this->chineseObj->regularModel(
                ChineseTextNumberSort::MODEL_REGULAR_B,
                '第一章我是Marco小哥哥'
            )
        );
    }

    /**
     * testValidationModelC
     *
     * @test
     */
    public function testValidationModelC()
    {
        $this->assertTrue(
            $this->chineseObj->regularModel(
                ChineseTextNumberSort::MODEL_REGULAR_C,
                '1 我是Marco小哥哥'
            )
        );

        $this->assertTrue(
            $this->chineseObj->regularModel(
                ChineseTextNumberSort::MODEL_REGULAR_C,
                '22 我是Marco小哥哥'
            )
        );

        $this->assertNotTrue(
            $this->chineseObj->regularModel(
                ChineseTextNumberSort::MODEL_REGULAR_C,
                '22我是Marco小哥哥'
            )
        );
    }

    /**
     * testValidationModelD
     *
     * @test
     */
    public function testValidationModelD()
    {
        $this->assertTrue(
            $this->chineseObj->regularModel(
                ChineseTextNumberSort::MODEL_REGULAR_D,
                '1页-我是Marco小哥哥'
            )
        );

        $this->assertTrue(
            $this->chineseObj->regularModel(
                ChineseTextNumberSort::MODEL_REGULAR_D,
                '1页-+我是Marco小哥哥'
            )
        );

        $this->assertNotTrue(
            $this->chineseObj->regularModel(
                ChineseTextNumberSort::MODEL_REGULAR_D,
                '22我是Marco小哥哥'
            )
        );
    }

    /**
     * testValidationModelD
     *
     * @test
     */
    public function testValidationModelE()
    {
        $this->assertTrue(
            $this->chineseObj->regularModel(
                ChineseTextNumberSort::MODEL_REGULAR_E,
                '1-'
            )
        );

        $this->assertTrue(
            $this->chineseObj->regularModel(
                ChineseTextNumberSort::MODEL_REGULAR_E,
                '1-+我是Marco小哥哥'
            )
        );

        $this->assertNotTrue(
            $this->chineseObj->regularModel(
                ChineseTextNumberSort::MODEL_REGULAR_E,
                '22我是Marco小哥哥'
            )
        );
    }


    /**
     * MODEL_REGULAR_F
     *
     * @test
     */
    public function testValidationModelF()
    {
        $this->assertTrue(
            $this->chineseObj->regularModel(
                ChineseTextNumberSort::MODEL_REGULAR_F,
                '1  但是'
            )
        );

        $this->assertTrue(
            $this->chineseObj->regularModel(
                ChineseTextNumberSort::MODEL_REGULAR_F,
                '1  2对对对'
            )
        );

        $this->assertNotTrue(
            $this->chineseObj->regularModel(
                ChineseTextNumberSort::MODEL_REGULAR_F,
                '22我是Marco小哥哥'
            )
        );
    }

    /**
     * testValidationModelG
     *
     * @test
     */
    public function testValidationModelG()
    {
        $this->assertTrue(
            $this->chineseObj->regularModel(
                ChineseTextNumberSort::MODEL_REGULAR_G,
                '1、、'
            )
        );

        $this->assertTrue(
            $this->chineseObj->regularModel(
                ChineseTextNumberSort::MODEL_REGULAR_G,
                '01、2对对对'
            )
        );

        $this->assertNotTrue(
            $this->chineseObj->regularModel(
                ChineseTextNumberSort::MODEL_REGULAR_G,
                '22我是Marco小哥哥'
            )
        );
    }

    /**
     * testValidationModelG
     *
     * @test
     */
    public function testValidationModelH()
    {
        $this->assertTrue(
            $this->chineseObj->regularModel(
                ChineseTextNumberSort::MODEL_REGULAR_H,
                '我爱Marco老师小册10 :'
            )
        );

        $this->assertTrue(
            $this->chineseObj->regularModel(
                ChineseTextNumberSort::MODEL_REGULAR_H,
                '我爱Marco老师小册1 ： 阳光鱼'
            )
        );

        $this->assertNotTrue(
            $this->chineseObj->regularModel(
                ChineseTextNumberSort::MODEL_REGULAR_H,
                '22我是Marco小哥哥'
            )
        );
    }

    /**
     * testValidationModelG
     *
     * @test
     */
    public function testValidationModelI()
    {
        $this->assertTrue(
            $this->chineseObj->regularModel(
                ChineseTextNumberSort::MODEL_REGULAR_I,
                '识字一 01 十'
            )
        );

        $this->assertTrue(
            $this->chineseObj->regularModel(
                ChineseTextNumberSort::MODEL_REGULAR_I,
                '狮子 03卧槽'
            )
        );

        $this->assertNotTrue(
            $this->chineseObj->regularModel(
                ChineseTextNumberSort::MODEL_REGULAR_I,
                '22我是Marco小哥哥'
            )
        );
    }
}