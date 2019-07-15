<?php
namespace App\Services\MetaData\ContentBlocks;

use App\Services\MetaData\Contracts\ {
  MetaDataInterface,
  MetaDataValidator as ContentTypeValidator
};
use App\Services\MetaData\ContentTypes\ {
  URL\URL,
  Text,
  Numeric,
  BlockWidth
};
use Illuminate\Support\Collection;

class EmbedBlock implements MetaDataInterface
{

  /**
   *
   * @var URL $content
   */
  private $content;

  /**
   *
   * @var Text $caption
   *
   */
  private $caption;

  /**
   *
   * @var Numeric $height
   *
   */
  private $height;

  /**
   *
   * @var BlockWidth $block_width
   */
  private $block_width;

  /**
   *
   * @param mixed $param
   *          || @param null || @param array
   *          
   */
  public function __construct($param = null)
  {
    $this->content = new URL($param['content'] ?? null);
    $this->caption = new Text($param['caption'] ?? null);
    $this->height = new Numeric($param['height'] ?? null);
    $this->block_width = new BlockWidth($param['block_width'] ?? null);
  }

  /**
   * {@inheritdoc}
   */
  public function get(): Collection
  {
    return collect([
      'content' => $this->content->get(),
      'caption' => $this->caption->get(),
      'height' => $this->height->get(),
      'block_width' => $this->block_width->get()
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
