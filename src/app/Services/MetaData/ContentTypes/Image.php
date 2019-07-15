<?php

namespace App\Services\MetaData\ContentTypes;

use App\Services\MetaData\Contracts\MetaDataInterface;
use App\Models\Media;

class Image implements MetaDataInterface
{
    /**
     * @var Media $image;
     */
    private $image;

    /**
     * @param mixed $param || @param null || @param array
     * 
     */
    public function __construct($param = null) {
        $this->image = Media::find($param);
    }

    /**
     * Get method for the instance
     * 
     * @return Media
     */
    public function get() : Media {
        return $this->image;
    }

    /**
     * Method to check whether the instance is well constructed
     * 
     * @return bool
     */
    public function validate() : bool {
        if (!$this->image)
            return false;
        return true;
    }
}
