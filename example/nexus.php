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


/* 
 * EXAMPLE 1 file create 
 * */
Nexus\Source::php("/src/server");
Nexus\Source::css("/src/style");
Nexus\Source::html("/src/template");
Nexus\Source::js("/src/script");
Nexus\Source::asset("/src/asset.png");

Nexus\Engine::build('/index', 'plate', true);
Nexus\Engine::watch('/src/');



/* 
 * EXAMPLE multiple file at 1 time 
 * */
// Nexus\Environment::set( function() {
//   Nexus\Source::php("/src/dev1/server");
//   Nexus\Engine::build('/index', 'plate', true);
// });


// Nexus\Environment::set( function() {
//   Nexus\Source::php("/src/dev2/server");
//   Nexus\Engine::build('/index2', 'plate', true);
// });

// Nexus\Environment::run('/index2');
// Nexus\Engine::watch('/src/');