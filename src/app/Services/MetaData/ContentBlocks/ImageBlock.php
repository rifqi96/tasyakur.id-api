<?php
namespace App\Services\MetaData\ContentBlocks;

use App\Services\MetaData\Contracts\ {
  MetaDataInterface,
  MetaDataValidator as ContentTypeValidator
};
use App\Services\MetaData\ContentTypes\ {
  Image,
  BlockWidth
};
use Illuminate\Support\Collection;

class ImageBlock implements MetaDataInterface
{

  /**
   *
   * @var Image $content
   */
  private $content;

  /**
   *
   * @var BlockWidth $block_width
   */
  private $block_width;

  /**
   *
   * @param mixed $param
   *          || @param null is an array
   */
  public function __construct($param = null)
  {
    $this->content = new Image($param['content'] ?? null);
    $this->block_width = new BlockWidth($param['block_width'] ?? null);
  }

  /**
   * {@inheritdoc}
   */
  public function get(): Collection
  {
    return collect([
      'content' => $this->content->validate() ? $this->content->get() : null,
      'block_width' => $this->block_width->validate() ? $this->block_width->get() : null
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function validate(): bool
  {
    $content_validator = new ContentTypeValidator($this->content);
    $block_width_validator = new ContentTypeValidator($this->block_width);

    return $content_validator->validate() && $block_width_validator->validate();
  }
}
