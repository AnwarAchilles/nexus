<?php

require_once '../autoload.php';

function dd($data) {
  echo '<pre>';
  print_r($data);
  echo '</pre>';
  die;
}

Nexus\Engine::$BASEURL = 'http://__project.test/Nexus/example/';
Nexus\Engine::$BASEDIR = __DIR__;
Nexus\Engine::$PROTECT = "123";


Nexus\Environment::set( function() {
  /* 
   * EXAMPLE 1 file create 
   * basic HTML, CSS, JS, PHP, ASSET
   * */
  Nexus\Source::php("/src/server");
  Nexus\Source::css("/src/style");
  Nexus\Source::html("/src/template");
  Nexus\Source::js("/src/script");
  Nexus\Source::asset("/src/asset.png");
  
  Nexus\Engine::build('/index', 'class.static', true);
});


Nexus\Environment::run('/index.php');
Nexus\Engine::watch('/src/');