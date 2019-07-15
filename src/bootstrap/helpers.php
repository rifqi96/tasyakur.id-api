<?php
/**
 * Custom Helper Functions
 * 
 */
if (! function_exists('slugify')) {

  /**
   * To sanitize any string to match with url slug format.
   *
   * @param string $text
   *
   * @return string
   */
  function slugify(String $text): String
  {
    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, '-');

    // remove duplicate -
    $text = preg_replace('~-+~', '-', $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
      return 'n-a';
    }

    return $text;
  }
}

if (! function_exists('formatBytes')) {

  /**
   * Convert from bytes to certain unit in string
   *
   * @param integer $bytes
   * @param integer $precision
   *
   * @return string
   */
  function formatBytes(int $bytes, int $precision = 2): string
  {
    $units = array(
      'B',
      'KB',
      'MB',
      'GB',
      'TB'
    );

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);

    // Convert the bytes!
    $bytes /= pow(1024, $pow);

    return round($bytes, $precision) . ' ' . $units[$pow];
  }
}

if (! function_exists('objectToArray')) {

  /**
   * Convert an object to an array
   *
   * @param \stdClass $d
   * @return array
   */
  function objectToArray(\stdClass $d): array
  {
    if (is_object($d)) {
      // Gets the properties of the given object
      // with get_object_vars function
      $d = get_object_vars($d);
    }

    if (! is_array($d)) {
      // Return an empty array
      return [];
    }

    return $d;
  }
}

if (! function_exists('arrayToObject')) {

  /**
   * Convert an array to an object
   *
   * @param array $d
   * @return \stdClass
   */
  function arrayToObject(array $d): \stdClass
  {
    if (! is_array($d)) {
      // Return an empty object
      return new stdClass();
    }

    return (object) $d;
  }
}

if (! function_exists('isMultiDimArray')) {

  /**
   * Check if the array is multi-dimensional
   *
   * @param array $arr
   * @return bool
   */
  function isMultiDimArray(array $arr): bool
  {
    $rv = array_filter($arr, 'is_array');
    if (count($rv) > 0)
      return true;

    return false;
  }
}

if (! function_exists('isAssociativeArray')) {

  /**
   * Check if the given array is associative or sequential
   *
   * @param array $arr
   * @return bool
   */
  function isAssociativeArray(array $arr): bool
  {
    if (array() === $arr)
      return false;
    return array_keys($arr) !== range(0, count($arr) - 1);
  }
}

if (! function_exists('explodeAndFilterEmpty')) {

  /**
   * It's the same as explode() but it also filters out empty string
   *
   * @param string $delimiter The boundary string
   * @param string $string The input string
   * @return array
   */
  function explodeAndFilterEmpty(string $delimiter, string $string): array
  {
    return preg_split("/$delimiter/", $string, - 1, PREG_SPLIT_NO_EMPTY);
  }
}