<?php
// +----------------------------------------------------------------------
// | ErrorCode.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\App;

use Xin\Phalcon\Enum\Enum;

class ErrorCode extends Enum
{
    /**
     * @Message('非法的TOKEN')
     * @Desc('需要重新登录')
     */
    public static $ENUM_INVALID_TOKEN = 700;

    /**
     * @Message('Code不为数字')
     */
    public static $ENUM_NOT_NUMBER = 'OP1000';
}
