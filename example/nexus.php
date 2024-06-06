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
  Nexus\Engine::env('/index.php');
});

// set watch build in nexus observer.
Nexus\Engine::cli('watch', function() {
  // listing all cli on observer.
  Nexus\Engine::observer('/src/', [
    Nexus\Engine::cli('build') ['argument']
  ]);
});

// run nexus
Nexus\Engine::serve();