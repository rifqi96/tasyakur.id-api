<?php
namespace App\Services\MetaData;

use App\Services\MetaData\Contracts\ValidatorInterface;
use App\Services\MetaData\Contracts\MetaDataIdentifierInterface;

class MetaDataValidator implements ValidatorInterface
{

  /**
   * MetaData Object
   *
   * @var MetaDataIdentifierInterface
   */
  private $meta;

  public function __construct(MetaDataIdentifierInterface $meta)
  {
    $this->meta = $meta;
  }

  /**
   * Method to check whether the instance is well constructed
   *
   * @return bool
   */
  public function validate(): bool
  {
    return $this->meta->getMetaData()
      ->validate();
  }
}