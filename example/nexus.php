<?php

// load nexus
require_once __DIR__ . '/nexus/autoload.php';

// set base working directory.
Nexus\Setup::base('DIR', __DIR__);

// set environment partially.
Nexus\Engine::env('/index.php', function() {
  // Re:Setup environment.
  Nexus\Setup::env('TYPE', 'class'); // @string class | plain
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


/* Nexus\Setup::env(?, ?)
 *
 * @string 
 * class | plain
 * env('TYPE', 'class');
 * 
 * @string 
 * language
 * env('HTML', 'id'); 
 * 
 * @boolean 
 * true | false
 * env('AUTORUN', true);
 * 
 * @string
 * base64 | gzip 
 * env('ENCRYPTION', 'base64');
 * 
 * @string
 * text/javascript | module
 * env('JAVASCRIPT', 'text/javascript');
 * 
 * @array
 * languages
 * env('LANGUAGE', ['html', 'css', 'js', 'php']);
 * 
 * @array 
 * languages
 * env('MINIFIED', ['css', 'js', 'css', 'php']);
 */

// run nexus.
Nexus\Engine::serve();