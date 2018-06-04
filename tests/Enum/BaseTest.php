<?php
// +----------------------------------------------------------------------
// | BaseTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Middleware;

use Tests\App\ErrorCode;
use Tests\App\ErrorCode2;
use Tests\TestCase;

class BaseTest extends TestCase
{
    public function testCode()
    {
        $this->assertEquals(700, ErrorCode::$ENUM_INVALID_TOKEN);
    }

    public function testMessage()
    {
        $this->assertEquals('非法的TOKEN', ErrorCode::getMessage(ErrorCode::$ENUM_INVALID_TOKEN));
    }

    public function testDesc()
    {
        $this->assertEquals('需要重新登录', ErrorCode::getDesc(ErrorCode::$ENUM_INVALID_TOKEN));
    }

    public function testTwoEnum()
    {
        $code = ErrorCode::$ENUM_INVALID_TOKEN;
        $msg1 = ErrorCode2::getMessage($code);
        $msg2 = ErrorCode::getMessage($code);

        $this->assertEquals('非法的TOKEN', $msg2);
        $this->assertEquals('非法的TOKEN 2', $msg1);
    }
}
