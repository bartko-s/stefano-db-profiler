<?php
namespace StefanoDbProfiler\Collector\Service;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use StefanoDbProfiler\Collector\DbCollector;
use StefanoDbProfiler\Options\ModuleOptions;

class DbCollectorFactory
    implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        return $this->createService($container);
    }

    public function createService(ServiceLocatorInterface $serviceLocator) {
        $moduleOptions = $this->getModuleOptions($serviceLocator);

        $dbCollector = new DbCollector();

        foreach($moduleOptions->getDbAdapterServiceManagerKey() as $adapterServiceKey) {
            if($serviceLocator->has($adapterServiceKey)) {
                $profiler = $serviceLocator->get($adapterServiceKey)
                                           ->getProfiler();
                if(null != $profiler) {
                    $dbCollector->addProfiler($adapterServiceKey, $profiler);
                }
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
