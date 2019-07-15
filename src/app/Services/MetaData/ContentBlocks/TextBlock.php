<?php
namespace App\Services\MetaData\ContentBlocks;

use App\Services\MetaData\Contracts\ {
  MetaDataInterface,
  MetaDataValidator as ContentTypeValidator
};
use App\Services\MetaData\ContentTypes\Text;
use Illuminate\Support\Collection;

class TextBlock implements MetaDataInterface
{

  /**
   *
   * @var string $content
   */
  private $content;

  /**
   *
   * @param mixed $param
   *          || @param null || @param array
   */
  public function __construct($param = null)
  {
    $this->content = new Text($param['content'] ?? null);
  }

  /**
   * {@inheritdoc}
   */
  public function get(): Collection
  {
    return collect([
      'content' => $this->content->get()
    ]);
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
