<?php
namespace App\Services\MetaData\ContentBlocks;

use App\Services\MetaData\Contracts\ {
  MetaDataInterface,
  MetaDataValidator as ContentTypeValidator
};
use App\Services\MetaData\ContentTypes\Text;

class HighlightBlock implements MetaDataInterface
{

  /**
   *
   * @var string $content
   */
  private $content;

  /**
   *
   * @param mixed $param
   *          || @param null
   */
  public function __construct($param = null)
  {
    $this->content = new Text($param);
  }

  /**
   * {@inheritdoc}
   */
  public function get(): string
  {
    return $this->content->get();
  }

  /**
   * {@inheritdoc}
   */
  public function validate(): bool
  {
    $content_validator = new ContentTypeValidator($this->content);

    return $content_validator->validate();
  }
}
