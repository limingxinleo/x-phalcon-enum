# x-phalcon-enum

[![Build Status](https://travis-ci.org/limingxinleo/x-phalcon-enum.svg?branch=master)](https://travis-ci.org/limingxinleo/x-phalcon-enum)

## 安装
~~~
composer require limingxinleo/x-phalcon-enum
~~~

## 使用
定义枚举类
~~~
use Xin\Phalcon\Enum\Enum;

class ErrorCode extends Enum
{
    /**
     * @Message('非法的TOKEN')
     */
    public static $ENUM_INVALID_TOKEN = 700;
}
~~~

使用
~~~
$code = ErrorCode::$ENUM_INVALID_TOKEN;
$message = ErrorCode::getMessage($code);
~~~