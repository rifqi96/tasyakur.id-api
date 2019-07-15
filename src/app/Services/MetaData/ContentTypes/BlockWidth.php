<?php

namespace App\Services\MetaData\ContentTypes;

use App\Services\MetaData\Contracts\MetaDataInterface;

class BlockWidth implements MetaDataInterface
{
    /**
     * @var string $block_width it has to be either 'fluid' || 'outer' || 'inner'
     * 
     */
    private $block_width;

    /**
     * @param mixed $param || @param null || @param array
     * 
     */
    public function __construct($param = null) {
        $this->block_width = $param;
    }

    /**
     * Get method for the instance
     * 
     * @return string
     */
    public function get() : string {
        return is_string($this->block_width) ? $this->block_width : '';
    }

    /**
     * Method to check whether the instance is well constructed
     * 
     * @return bool
     */
    public function validate() : bool {
        if (!is_string($this->block_width))
            return false;
        else if ($this->block_width !== 'fluid' && $this->block_width !== 'outer' && $this->block_width !== 'inner')
            return false;
        return true;
    }
}
