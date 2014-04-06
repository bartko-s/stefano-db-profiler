<?php
namespace StefanoDbProfiler\Collector;

use Zend\Mvc\MvcEvent;
use Zend\Db\Adapter\Profiler\Profiler;
use ZendDeveloperTools\Collector\CollectorInterface;

class DbCollector
    implements CollectorInterface
{
    /**
     * @var Profiler
     */
    protected $profiler;

    public function getName() {
        return 'StefanoDbProfiler';
    }

    public function getPriority() {
        return 10;
    }

    public function collect(MvcEvent $mvcEvent) {
    }

    public function getQueryCount($queryType = null) {
        $profiles = $this->getProfiler()
                         ->getProfiles();

        $count = 0;

        if(null == $queryType) {
            $count = count($profiles);
        } elseif('other' == strtolower($queryType)) {
            foreach ($profiles as $profile) {
                if(!preg_match('@(^SELECT|^UPDATE|^DELETE|^INSERT)@i', trim($profile['sql']))) {
                    $count++;
                }
            }
        } else {
            foreach ($profiles as $profile) {
                if(preg_match('|^' . $queryType . '|i', trim($profile['sql']))) {
                    $count++;
                }
            }
        }


        return $count;
    }

    public function getQueryTime($queryType = null) {
        $profiles = $this->getProfiler()
                         ->getProfiles();

        $time = 0;

        if(null == $queryType) {
            foreach($profiles as $profile) {
                $time = $time + $profile['elapse'];
            }
        } elseif('other' == strtolower($queryType)) {
            foreach ($profiles as $profile) {
                if(!preg_match('@(^SELECT|^UPDATE|^DELETE|^INSERT)@i', trim($profile['sql']))) {
                    $time = $time + $profile['elapse'];
                }
            }
        } else {
            foreach ($profiles as $profile) {
                if(preg_match('|^' . $queryType . '|i', trim($profile['sql']))) {
                    $time = $time + $profile['elapse'];
                }
            }
        }

        return $time;
    }

    /**
     * @param Profiler $profiler
     */
    public function setProfiler(Profiler $profiler) {
        $this->profiler = $profiler;
    }

    /**
     * @return Profiler
     */
    public function getProfiler() {
        return $this->profiler;
    }

    /**
     * @return bolean
     */
    public function hasProfiler() {
        return ($this->profiler) ? true : false;
    }
}