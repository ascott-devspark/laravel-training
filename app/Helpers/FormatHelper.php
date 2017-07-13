<?php

namespace App\Helpers;

class FormatHelper {
  /**
   * Convert bytes to KB, MB, GB
   *
   * @param $size
   * @return string
   */
  public static function getSize($size, $decimals = 2) {

    if ($size > 0) {
      $filesizename = array(" Bytes", " KB", " MB", " GB", " TB", " PB");
      $exp = floor(log($size, 1024));
      $size = round($size/pow(1024, $exp), $decimals);

      if (floor($size) == $size) {
        $size = floor($size);
      } else {
        $size = number_format($size, $decimals, ",", ".");
      }
      return 	$size . $filesizename[$exp];
    }
    return '0 Bytes';
  }
}