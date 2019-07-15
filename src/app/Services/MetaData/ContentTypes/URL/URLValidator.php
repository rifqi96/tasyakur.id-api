<?php
namespace App\Services\MetaData\ContentTypes\URL;

use App\Services\MetaData\Contracts\ValidatorInterface;

class URLValidator implements ValidatorInterface
{
  /**
   * URL ContentType Object
   *
   * @var URL
   */
  private $url;

  public function __construct(URL $url) {
    $this->url = $url;
  }

  protected function isUrlValidated() : bool {
    $regex = "((https?|ftp)\:\/\/)?"; // SCHEME 
    $regex .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?"; // User and Pass 
    $regex .= "([a-z0-9-.]*)\.([a-z]{2,3})"; // Host or IP 
    $regex .= "(\:[0-9]{2,5})?"; // Port 
    $regex .= "(\/([a-z0-9+\$_-]\.?)+)*\/?"; // Path 
    $regex .= "(\?[a-z+&\$_.-][a-z0-9;:@&%=+\/\$_.-]*)?"; // GET Query 
    $regex .= "(#[a-z_.-][a-z0-9+\$_.-]*)?"; // Anchor 

    if(preg_match("/^$regex$/i", $this->url->get())) // `i` flag for case-insensitive
      return true;
    return false;
  }

  public function validate() : bool {
    if (!is_string($this->url->get()))
      return false;
    else if (!$this->isUrlValidated())
      return false;
    
    return true;
  }
}