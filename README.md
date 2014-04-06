Db Profiler
=====

| Dependencies |
| :---: |
| [![Dependency Status](https://www.versioneye.com/user/projects/534186d3e97a46bbf90000dc/badge.png)](https://www.versioneye.com/user/projects/534186d3e97a46bbf90000dc) |

A ZF2 module to profile db queries using ```\Zend\Db\Adapter\Profiler\Profiler``` and write them to ZendDeveloperTools toolbar

- - -

Features
----

- profiling db queries

Instalation
---

- Add following line to your composer.json file ``` "stefano/stefano-db-profiler": "*" ```

- run ```composer update```

- Add ``` StefanoDbProfiler ``` to your application.config.php

- Enable profiler for your Db Adapter

```
'db' => array(
    'driver' => 'Pdo_Mysql',
    'database' => 'db',
    'username' => 'username',
    'password' => 'pass',
    'profiler' => true, //this line enable db profiler
)
```

- Library uses ``` Zend\Db\Adapter\Adapter ``` service key. If you are uses different key for your Db Adapter you must set it by configuration options.

Options
---

Configuration options are available in ```config/stefano.db.profiler.global.php.dist``` file. If you want to change the default ones, copy it in your ```config/autoload directory```, remove the ```.dist``` extension and edit it.

Options available :

- ```dbAdapterServiceManagerKey``` : Your Db Adapter service key. ``` Zend\Db\Adapter\Adapter ``` is default

Screenshot
---

![Db Profiler](./doc/images/snapshot.png)
