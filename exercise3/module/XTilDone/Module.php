<?php
namespace XTilDone;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'ZF\Apigility\Autoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ . '\\' => __DIR__ . '/src/',
                ),
            ),
        );
    }
}
