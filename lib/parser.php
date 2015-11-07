<?php
class Parser {

  public static function preProcess($source) {

    if(preg_match_all('/@include\((.+\.md)\)/', $source, $matches)) {
      foreach($matches[0] as $i=>$replace) {
        $include = trim(file_get_contents(Config::$sourceDir.$matches[1][$i]));
        $source = str_replace($replace, $include, $source);
      }
    }

    // Mediawiki-style external links [http://example.com example]
    $source = preg_replace('/(?<!\\\)\[(http[^\] ]+) ([^\]]+)\]/', '[$2]($1)', $source);

    // Wiki page links with alternate display value [[page|pages]]
    $source = preg_replace('|\[\[([^\]\|]*)\|([^\]]+)\]\]|', '[$2](/$1)', $source);

    // Wiki page links like [[page]]
    $source = preg_replace('|\[\[([^\]]+)\]\]|', '[$1](/$1)', $source);

    return $source;
  }

}
