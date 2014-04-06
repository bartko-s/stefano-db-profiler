<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'StefanoDbProfiler\Collector\DbCollector'
                => '\StefanoDbProfiler\Collector\Service\DbCollectorFactory',
            'StefanoDbProfiler\Options\ModuleOptions'
                => 'StefanoDbProfiler\Options\Service\ModuleOptionsFactory',
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'stefano-db-profiler/toolbar/db'
                => __DIR__ . '/../view/stefano-db-profiler/toolbar/db.phtml',
        ),
    ),
    'zenddevelopertools' => array(
        'profiler' => array(
            'collectors' => array(
                'StefanoDbProfiler'
                    => 'StefanoDbProfiler\Collector\DbCollector',
            ),
        ),
        'toolbar' => array(
            'entries' => array(
                'StefanoDbProfiler'
                    => 'stefano-db-profiler/toolbar/db',
            ),
        ),
    ),
    'stefano_db_profiler' => array(
        'dbAdapterServiceManagerKey' => 'Zend\Db\Adapter\Adapter',
    ),
);