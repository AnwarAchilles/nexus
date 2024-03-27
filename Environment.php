<?php

namespace Nexus;

class Environment {

  public static $all = [];

  public static function set( $nexus ) {
   self::$all[] = $nexus; 
  }

  public static function run( $dist ) {
    foreach (self::$all as $nexus) {
      Source::$all = [];
      Engine::$main = [];
      Engine::$dist = [];
      Bundler::$all = [
        'php' => '',
        'html'=> '',
        'html-body'=> '',
        'html-head'=> '',
        'css'=> '',
        'js'=> '',
        'asset'=> '',
      ];

      $nexus();
    }

    Engine::$dist['url'] = Engine::$BASEURL.$dist.'.php';
    Engine::$dist['dir'] = Engine::$BASEDIR.$dist.'.php';
    Engine::$dist['src'] = $dist.'.php';
  }



}