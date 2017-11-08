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
}