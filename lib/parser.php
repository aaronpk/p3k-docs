<?php
class Parser {

  public static function preProcess($source) {

    $source = preg_replace('|\[\[([^\]]+)\]\]|', '[$1](/$1)', $source);

    return $source;
  }

}
