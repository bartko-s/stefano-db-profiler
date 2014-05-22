<?php
namespace StefanoDbProfiler\Options;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions
    extends AbstractOptions
{
    private $dbAdapterServiceManagerKey = array();

    /**
     * @param array|string $keyName
     */
    public function setDbAdapterServiceManagerKey($keyName) {
        $this->dbAdapterServiceManagerKey = (array) $keyName;
    }

    /**
     * @return array
     */
    public function getDbAdapterServiceManagerKey() {
        return $this->dbAdapterServiceManagerKey;
    }
}
