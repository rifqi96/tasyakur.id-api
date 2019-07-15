<?php
namespace App\Services\MetaData\ContentBlocks;

use App\Services\MetaData\Contracts\ {
  MetaDataInterface,
  MetaDataValidator as ContentTypeValidator
};
use App\Services\MetaData\ContentTypes\URL\URL;
use Illuminate\Support\Collection;
use App\Services\MetaData\ContentTypes\ {
  Flourish as FlourishType,
  Text,
  Numeric,
  BlockWidth
};

class Flourish implements MetaDataInterface
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

  public function __construct()
  {
    $this->content = new FlourishType($param['content'] ?? null);
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