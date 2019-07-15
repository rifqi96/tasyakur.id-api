<?php
namespace App\Services\MetaData\ContentBlocks;

use App\Services\MetaData\Contracts\MetaDataInterface;
use App\Services\MetaData\MetaDataValidator as ContentTypeValidator;
use App\Services\MetaData\ContentTypes\BlockWidth;
use App\Services\MetaData\ContentTypes\Gallery;
use App\Services\MetaData\ContentTypes\Text;
use Illuminate\Support\Collection;

class Carousel implements MetaDataInterface
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
   * {@inheritdoc}
   */
  public function get(): Collection
  {
    return collect([
      'images' => $this->images->get(),
      'caption' => $this->caption->get(),
      'block_width' => $this->block_width->get()
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function validate(): bool
  {
    $image_validator = new ContentTypeValidator($this->images);
    $caption_validator = new ContentTypeValidator($this->caption);
    $block_width_validator = new ContentTypeValidator($this->block_width);

    return $image_validator->validate() && $caption_validator->validate() && $block_width_validator->validate();
  }
}
