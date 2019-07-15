<?php

namespace App\Services\MetaData\ContentTypes;

use App\Services\MetaData\Contracts\MetaDataInterface;

class Numeric implements MetaDataInterface
{
    /**
     * @var string $num;
     */
    private $num;

    /**
     * @param mixed $param || @param null || @param array
     * 
     */
    public function __construct($param = null) {
        $this->num = $param;
    }

    /**
     * Get method for the instance
     * 
     * @return mixed
     */
    public function get() {
        return $this->validate() ? $this->num : null;
    }

    /**
     * Method to check whether the instance is well constructed
     * 
     * @return bool
     */
    public function validate() : bool {
        return is_numeric($this->num);
    }
}
