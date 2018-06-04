<?php
// +----------------------------------------------------------------------
// | TestCase.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests;

use Phalcon\Di\FactoryDefault;
use PHPUnit\Framework\TestCase as UnitTestCase;
use Phalcon\Config;
use Xin\Phalcon\Middleware\Manager;
use Xin\Phalcon\Middleware\Mvc\Dispatcher;

class TestCase extends UnitTestCase
{
    public $di;

    /** @var Dispatcher $dispatcher */
    public $dispatcher;

    public function setUp()
    {
    }
}
