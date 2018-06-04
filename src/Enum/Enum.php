<?php
// +----------------------------------------------------------------------
// | Enum.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Xin\Phalcon\Enum;

use Phalcon\Text;
use Xin\Phalcon\Enum\Exception\EnumException;
use Phalcon\Annotations\Adapter\Memory as MemoryAdapter;
use ReflectionClass;
use Xin\Traits\Common\InstanceTrait;

abstract class Enum
{
    use InstanceTrait;
    
    public static $_instance;

    public $_adapter = 'memory';

    public $_expire = 3600;

    protected $_annotation;

    protected $phalconExtEnable = true;

    private function __construct()
    {
        $this->_annotation = new Annotation($this->phalconExtEnable);
    }

    public function __call($name, $arguments)
    {
        if (!Text::startsWith($name, 'get')) {
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

        // 获取注释
        $adapter = new MemoryAdapter();
        $reflection = $adapter->get(static::class);
        $annotations = $reflection->getPropertiesAnnotations();

        $arr = [];
        foreach ($properties as $key => $val) {
            if (Text::startsWith($key, 'ENUM_') && isset($annotations[$key])) {
                // 获取对应注释
                $ret = $annotations[$key]->get(Text::camelize($name));
                $arr[$val] = $ret->getArgument(0);
            }
        }

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