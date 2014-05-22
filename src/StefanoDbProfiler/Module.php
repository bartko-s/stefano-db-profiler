<?php
namespace StefanoDbProfiler;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\DependencyIndicatorInterface;

class Module
    implements ConfigProviderInterface,
               AutoloaderProviderInterface,
               DependencyIndicatorInterface
{
    public function getConfig() {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }

    public function getModuleDependencies() {
        return array(
            'ZendDeveloperTools'
        );
    }
}