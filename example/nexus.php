<?php

function dd($data) {
  echo '<pre>'; print_r($data); die;
}

require_once '../autoload.php';

Nexus\Engine::$BASEURL = '';
Nexus\Engine::$BASEDIR = __DIR__;


// Nexus\Source::php("/src/server");
// Nexus\Source::css("/src/style");
// Nexus\Source::html("/src/template");
// Nexus\Source::js("/src/script");

Nexus\Source::asset("/src/asset.png");


Nexus\Engine::build('/index', 'class', true);
Nexus\Engine::watch('/src/');