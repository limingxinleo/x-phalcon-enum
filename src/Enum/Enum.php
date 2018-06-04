<?php
// +----------------------------------------------------------------------
// | Enum.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Xin\Phalcon\Enum;

use limx\Support\Str;
use Xin\Phalcon\Enum\Adapter\AdapterInterface;
use Xin\Phalcon\Enum\Adapter\PhalconAdapter;
use Xin\Phalcon\Enum\Adapter\ReflectionAdapter;
use Xin\Phalcon\Enum\Exception\EnumException;
use ReflectionClass;
use Xin\Traits\Common\InstanceTrait;

abstract class Enum
{
    use InstanceTrait;

    public static $_instance;

    /** @var AdapterInterface */
    public $_adapter;

    protected $phalconExtEnable = true;

    private function __construct()
    {
        if ($this->phalconExtEnable && extension_loaded('phalcon')) {
            $this->_adapter = new PhalconAdapter(static::class);
        } else {
            $this->_adapter = new ReflectionAdapter(static::class);
        }
    }

    public function __call($name, $arguments)
    {
        if (!Str::startsWith($name, 'get')) {
            throw new EnumException('The function is not defined!');
        }
        if (!isset($arguments) || count($arguments) === 0) {
            throw new EnumException('The Code is required');
        }

        $code = $arguments[0];
        $name = strtolower(substr($name, 3));

        if (isset($this->$name)) {
            return isset($this->$name[$code]) ? $this->$name[$code] : '';
        }

        // 获取变量
        $ref = new ReflectionClass(static::class);
        $properties = $ref->getDefaultProperties();

        $arr = $this->_adapter->getAnnotationsByName($name, $properties);

        if (version_compare(PHP_VERSION, 7, '<')) {
            // 版本小于7
            return isset($arr[$code]) ? $arr[$code] : '';
        }

        $this->$name = $arr;
        return isset($this->$name[$code]) ? $this->$name[$code] : '';
    }

    public static function __callStatic($method, $arguments)
    {
        return static::getInstance()->$method(...$arguments);
    }
}
