<?php
namespace StefanoDbProfiler\Options\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use StefanoDbProfiler\Options\ModuleOptions;

class ModuleOptionsFactory
    implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $config = $serviceLocator->get('Config');
        return new ModuleOptions($config['stefano_db_profiler']);
    }
}