<?php

// load nexus
require_once __DIR__ . '/nexus/autoload.php';

// set base working directory.
Nexus\Setup::base('DIR', __DIR__);

// set environment partially.
Nexus\Engine::env('/index.php', function() {
  // Re:Setup environment.
  Nexus\Setup::env('TYPE', 'class');
  // set source code.
  Nexus\Source::code('/src/index.head.html'); // specialy for head html
  Nexus\Source::code('/src/index.html');
  Nexus\Source::code('/src/index.css');
  Nexus\Source::code('/src/index.js');
  Nexus\Source::code('/src/index.php');
});

// set build cli triggering.
Nexus\Engine::cli('build', function() {
  Nexus\Engine::env('/dist/index.php');
});

// set server localhost
Nexus\Engine::cli('serve', function() {
  Nexus\Engine::localhost(8000);
});

// set watch build in nexus observer.
Nexus\Engine::cli('watch', function() {
  Nexus\Engine::observer('/src/', [
    Nexus\Engine::cli('build')->argument
  ]);
});

// shorthand cli start
Nexus\Engine::cli('start', function() {
  Nexus\Engine::window([
    Nexus\Engine::cli('serve')->argument,
    Nexus\Engine::cli('watch')->argument
  ]);
});

// run nexus.
Nexus\Engine::serve();