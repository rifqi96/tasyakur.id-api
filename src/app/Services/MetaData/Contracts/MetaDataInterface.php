<?php
namespace App\Services\MetaData\Contracts;

interface MetaDataInterface extends ValidatorInterface
{

  /**
   * Get method for the instance
   *
   * @return mixed
   */
  public function get();
}