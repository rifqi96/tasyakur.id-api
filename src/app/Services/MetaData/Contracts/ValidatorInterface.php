<?php
namespace App\Services\MetaData\Contracts;

interface ValidatorInterface
{

  /**
   * Method to check whether the instance is well constructed
   *
   * @return bool
   */
  public function validate(): bool;
}