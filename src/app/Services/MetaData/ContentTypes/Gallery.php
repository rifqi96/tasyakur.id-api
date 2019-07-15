<?php

namespace App\Services\MetaData\ContentTypes;

use App\Services\MetaData\Contracts\MetaDataInterface;
use App\Models\Media;
use Illuminate\Support\Collection;

class Gallery implements MetaDataInterface
{
    /**
     * @var Collection $images
     * 
     */
    private $images;

    /**
     * @param mixed $param || @param null || @param array
     * 
     */
    public function __construct($param = null) {
        $this->images = is_array($param) ? Media::whereIn('id', $param)->get() : collect();
    }

    /**
     * Get method for the instance
     * 
     * @return Collection
     */
    public function get() : Collection {
        return $this->images;
    }

    /**
     * Method to check whether the instance is well constructed
     * 
     * @return bool
     */
    public function validate() : bool {
        if (!($this->images instanceof Collection))
            return false;
        return true;
    }
}
