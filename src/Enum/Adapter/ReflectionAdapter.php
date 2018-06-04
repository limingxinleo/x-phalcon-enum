<?php
// +----------------------------------------------------------------------
// | Phalcon.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Xin\Phalcon\Enum\Adapter;

use limx\Support\Str;
use ReflectionClass;
use ReflectionProperty;

class ReflectionAdapter implements AdapterInterface
{
    protected $class;

    public function __construct($class)
    {
        $this->class = $class;
    }

    public function getAnnotationsByName($name, $properties)
    {
        $result = [];
        foreach ($properties as $key => $val) {
            if (Str::startsWith($key, 'ENUM_')) {
                // 获取对应注释
                $ret = new ReflectionProperty($this->class, $key);
                $result[$val] = $this->getCommentByName($ret->getDocComment(), $name);
            }
        }

        return $result;
    }

    /**
     * @desc   根据name解析doc获取对应注释
     * @author limx
     * @param $doc  注释
     * @param $name 字段名
     */
    protected function getCommentByName($doc, $name)
    {
        $name = Str::studly($name);
        $pattern = "/\@{$name}\(\'(.*)\'\)/U";
        if (preg_match($pattern, $doc, $result)) {
            if (isset($result[1])) {
                return $result[1];
            }
        }
        return null;
    }
}
