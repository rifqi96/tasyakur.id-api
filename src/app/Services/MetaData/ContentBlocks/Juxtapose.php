<?php
namespace App\Services\MetaData\ContentBlocks;

use App\Services\MetaData\Contracts\ {
  MetaDataInterface,
  MetaDataValidator as ContentTypeValidator
};
use App\Services\MetaData\ContentTypes\ {
  Gallery,
  BlockWidth,
  Text
};
use Illuminate\Support\Collection;

class Juxtapose implements MetaDataInterface
{

  /**
   *
   * @var Gallery $images
   *
   */
  private $images;

  /**
   *
   * @var BlockWidth $block_width
   *
   */
  private $block_width;

  /**
   *
   * @var Text $caption
   *
   */
  private $caption;

  /**
   *
   * @param mixed $param
   *          || @param null || @param array
   *          
   */
  public function __construct($param = null)
  {
    $this->images = new Gallery($param['images'] ?? null);
    $this->caption = new Text($param['caption'] ?? null);
    $this->block_width = new BlockWidth($param['block_width'] ?? null);
  }

  /**
   * Get method for the instance
   *
   * @return Collection
   */
  public function get(): Collection
  {
    return collect([
      'images' => $this->getImages(),
      'caption' => $this->caption->get(),
      'block_width' => $this->block_width->get()
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function getImages(): Collection
  {
    if ($this->images->get()->count() > 2)
      return $this->images->get()->take(2);
    return $this->images->get();
  }

  /**
   * {@inheritdoc}
   */
  public function validate(): bool
  {
    $images_validator = new ContentTypeValidator($this->images);
    $block_width_validator = new ContentTypeValidator($this->block_width);

    return $images_validator->validate() && $block_width_validator->validate();
  }
}
