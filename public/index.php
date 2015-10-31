<?php
chdir('..');
include('config.php');
include('vendor/autoload.php');

use \Michelf\Markdown;

$templates = new League\Plates\Engine(dirname(__FILE__).'/../views');

if(preg_match('|\/(.*)|', $_SERVER['REQUEST_URI'], $match)) {

  $page = $match[1];
  if($page == '')
    $page = 'Home';

  $filename = Config::$sourceDir . $page . '.md';

  if(!file_exists($filename)) {
    not_found();
    die();
  }

  $source = file_get_contents($filename);

  // Pre-process source file
  $source = Parser::preProcess($source);

  // Parse markdown
  $html = Markdown::defaultTransform($source);

  // If there is a sidebar, parse the links from it
  $sidebarFilename = Config::$sourceDir . '_Sidebar.md';
  if(file_exists($sidebarFilename)) {
    $sidebar = file_get_contents($sidebarFilename);
    $sidebar = Parser::preProcess($sidebar);
    $sidebar = Markdown::defaultTransform($sidebar);
  } else {
    $sidebar = false;
  }

  echo $templates->render('page', [
    'title' => $page,
    'html' => $html,
    'sidebar' => $sidebar
  ]);

} else {
  not_found();
}

function not_found() {
  header('HTTP/1.1 404 Not Found');
  echo '404 Not Found';
}
