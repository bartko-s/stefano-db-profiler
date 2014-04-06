<?php
namespace StefanoDbProfiler\Options;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions
    extends AbstractOptions
{
    private $dbAdapterServiceManagerKey;

    /**
     * @param string $keyName
     */
    public function setDbAdapterServiceManagerKey($keyName) {
        $this->dbAdapterServiceManagerKey = $keyName;
    }

    /**
     * @return string
     */
    public function getDbAdapterServiceManagerKey() {
        return $this->dbAdapterServiceManagerKey;
    }
}
