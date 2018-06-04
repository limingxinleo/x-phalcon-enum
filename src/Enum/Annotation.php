<?php
// +----------------------------------------------------------------------
// | Annotation.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Xin\Phalcon\Enum;

class Annotation implements AnnotationInterface
{
    protected $phalconEnable;

    /**
     * Annotation constructor.
     * @param $phalconExtEnable Phalcon扩展是否可用
     */
    public function __construct($phalconExtEnable)
    {

    }

    public function getAnnotationByName($name)
    {
    }
}