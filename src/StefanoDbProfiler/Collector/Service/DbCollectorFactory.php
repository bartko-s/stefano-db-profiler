<?php
namespace StefanoDbProfiler\Collector\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use StefanoDbProfiler\Collector\DbCollector;
use StefanoDbProfiler\Options\ModuleOptions;

class DbCollectorFactory
    implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $moduleOptions = $this->getModuleOptions($serviceLocator);

        $dbCollector = new DbCollector();

        if($serviceLocator->has($moduleOptions->getDbAdapterServiceManagerKey())) {
            $profiler = $serviceLocator->get($moduleOptions->getDbAdapterServiceManagerKey())
                                       ->getProfiler();

            if(null != $profiler) {
                $dbCollector->setProfiler($profiler);
            }
        }

        return $dbCollector;
    }

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return ModuleOptions
     */
    private function getModuleOptions(ServiceLocatorInterface $serviceLocator) {
        return $serviceLocator->get('StefanoDbProfiler\Options\ModuleOptions');
    }
}
