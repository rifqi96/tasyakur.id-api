<?php
namespace App\Services\MetaData\ContentTypes;

use App\Services\MetaData\Contracts\MetaDataInterface;

class Flourish implements MetaDataInterface
{
  /**
   * Flourish Embed ID
   *
   * @var string id
   */
  private $id;

  public function __construct($param) {
    $this->id = $param;
  }

  /**
   * Get method for the instance
   * 
   * @return string
   */
  public function get() : string {
    return $this->validate() ? $this->id : '';
  }

  /**
   * Method to check whether the instance is well constructed
   * 
   * @return bool
   */
  public function validate() : bool {
    if (!is_string($this->id))
      return false;
    else if (preg_match("/\b(visualisation|story)\b\/(\d+)$/", $this->id))
      return false;
      
    return true;
  }
}