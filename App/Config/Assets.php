<?php
namespace App\Config;

class Assets
{
  protected function asset($asset)
  {
      $asset = str_replace('../','', $asset);

      return defined::HOST_PUBLIC.'assets/'.$asset;
  }
}
