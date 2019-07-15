<?php

namespace App\Services\MetaData\ContentTypes\URL;

use App\Services\MetaData\Contracts\MetaDataInterface;

class URL implements MetaDataInterface
{
    /**
     * @var string $url;
     */
    private $url;

    /**
     * @param mixed $param || @param null || @param array
     * 
     */
    public function __construct($param = null) {
        $this->url = is_string($param) ? 'https://' . $param : '';
    }

    /**
     * Get method for the instance
     * 
     * @return string
     */
    public function get() : string {
        return $this->url;
    }

    /**
     * Method to check whether the instance is well constructed
     * 
     * @return bool
     */
    public function validate() : bool {
        $url_validator = new URLValidator($this);

        return $url_validator->validate();
    }
}
