<?php
namespace App\Services\MetaData;

use App\Services\MetaData\ContentBlocks\ {
  TextBlock,
  ImageBlock,
  EmbedBlock,
  HighlightBlock,
  Juxtapose,
  Carousel,
  Flourish
};
use App\Services\MetaData\Contracts\MetaDataIdentifierInterface;
use App\Services\MetaData\Contracts\MetaDataInterface;

class MetaDataIdentifier implements MetaDataIdentifierInterface
{

  /**
   * post_details[$i]['meta_key']
   *
   * @var string
   */
  private $key;

  /**
   * post_details[$i]['meta_value']
   *
   * @var array
   */
  private $val;

  /**
   * MetaData class
   *
   * @var string|null
   */
  private $metaClass;

  /**
   * MetaData object
   *
   * @var MetaDataInterface
   */
  private $metaData = null;

  /**
   * MetaDataIdentifier constructor
   *
   * @param string $key
   *          - Must be one of these: 'text_block', 'image_block', 'embed_block', 'highlight_block', 'juxtapose', 'carousel', 'flourish'
   * @param mixed $val
   *          - Typically either a string or an array
   */
  public function __construct(string $key, $val)
  {
    $this->setMetaData($key, $val);
  }

  /**
   * {@inheritDoc}
   * @see \App\Services\MetaData\Contracts\MetaDataIdentifierInterface::getMetaData()
   */
  public function getMetaData() : MetaDataInterface
  {
    if ( !$this->metaClass )
      throw new \Exception('Meta class is not defined', 400);

    if ( $this->metaData )
      return $this->metaData;

    $metaData = app()->make($this->metaClass, [ $this->val ]);

    return $metaData;
  }

  /**
   * {@inheritDoc}
   * @see \App\Services\MetaData\Contracts\MetaDataIdentifierInterface::setMetaData()
   */
  public function setMetaData(string $key, $val)
  {
    $metaClass = null;

    switch ($key) {
      case 'text_block':
        $metaClass = TextBlock::class;
        break;

      case 'image_block':
        $metaClass = ImageBlock::class;
        break;

      case 'embed_block':
        $metaClass = EmbedBlock::class;
        break;

      case 'highlight_block':
        $metaClass = HighlightBlock::class;
        break;

      case 'juxtapose':
        $metaClass = Juxtapose::class;
        break;

      case 'carousel':
        $metaClass = Carousel::class;
        break;

      case 'flourish':
        $metaClass = Flourish::class;
        break;
    }

    $this->key = $key;
    $this->val = $val;
    $this->metaClass = $metaClass;
    $this->metaData = null;
  }
}