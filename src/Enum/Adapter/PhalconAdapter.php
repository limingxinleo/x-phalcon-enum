<?php
// +----------------------------------------------------------------------
// | Phalcon.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Xin\Phalcon\Enum\Adapter;

use Phalcon\Text;
use Phalcon\Annotations\Adapter\Memory as MemoryAdapter;

class PhalconAdapter implements AdapterInterface
{
    protected $class;

    public function __construct($class)
    {
        $this->class = $class;
    }

    public function getAnnotationsByName($name, $properties)
    {
        $adapter = new MemoryAdapter();
        $reflection = $adapter->get($this->class);
        $annotations = $reflection->getPropertiesAnnotations();

        $result = [];
        foreach ($properties as $key => $val) {
            if (Text::startsWith($key, 'ENUM_') && isset($annotations[$key])) {
                // 获取对应注释
                $ret = $annotations[$key]->get(Text::camelize($name));
                $result[$val] = $ret->getArgument(0);
            }
        }

        return $result;
    }
}
