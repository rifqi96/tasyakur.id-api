<?php

namespace App\Services\MetaData\ContentTypes;

use App\Services\MetaData\Contracts\MetaDataInterface;

class Text implements MetaDataInterface
{
    /**
     * @var string $text;
     */
    private $text;

    /**
     * @param mixed $param || @param null || @param array
     * 
     */
    public function __construct($param = null) {
        $this->text = $param;
    }

    /**
     * Get method for the instance
     * 
     * @return string
     */
    public function get() : string {
        return is_string($this->text) ? $this->text : '';
    }

    /**
     * Method to check whether the instance is well constructed
     * 
     * @return bool
     */
    public function validate() : bool {
        return is_string($this->text);
    }
}
