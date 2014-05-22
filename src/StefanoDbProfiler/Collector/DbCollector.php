<?php
namespace StefanoDbProfiler\Collector;

use Zend\Mvc\MvcEvent;
use Zend\Db\Adapter\Profiler\Profiler;
use ZendDeveloperTools\Collector\CollectorInterface;

class DbCollector
    implements CollectorInterface
{
    protected $profilers = array();

    public function getName() {
        return 'StefanoDbProfiler';
    }

    public function getPriority() {
        return 10;
    }

    public function collect(MvcEvent $mvcEvent) {
    }

    public function getQueryCount($queryType = null) {
        $profiles = $this->getProfiles();

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
        $profiles = $this->getProfiles();

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
     * @param string $adapterName
     * @param Profiler $profiler
     */
    public function addProfiler($adapterName, Profiler $profiler) {
        $this->profilers[$adapterName] = $profiler;
    }

    /**
     * @return array Profilers
     */
    public function getProfilers() {
        return $this->profilers;
    }

    /**
     * @return bolean
     */
    public function hasProfiler() {
        return (1 <= count($this->profilers)) ? true : false;
    }

    /**
     * @return array
     */
    public function getProfiles() {
        $profiles = array();

        foreach($this->getProfilers() as $adapterServiceKey => $profiler) {
            foreach($profiler->getProfiles() as $query) {
                $query['adapterServiceKey'] = $adapterServiceKey;
                $profiles[] = $query;
            }
        }

        usort($profiles, function($a, $b){
            if ($a['start'] == $b['start']) {
                return 0;
            }
                return ($a['start'] < $b['start']) ? -1 : 1;
        });

        return $profiles;
    }
}