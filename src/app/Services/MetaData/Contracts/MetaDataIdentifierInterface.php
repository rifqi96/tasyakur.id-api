<?php
namespace App\Services\MetaData\Contracts;

interface MetaDataIdentifierInterface
{

  /**
   * Return the component
   *
   * @return MetaDataInterface
   * @throws \Exception
   */
  public function getMetaData() : MetaDataInterface;

  /**
   * Flush previous meta data and set with the new meta data class
   *
   * @param string $key
   * @param mixed $val
   * @return void
   */
  public function setMetaData(string $key, $val);
}