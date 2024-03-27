<?php
namespace Nexus;

/**
 * Class Environment
 *
 * A class that provides functionality for managing and running Nexus environments.
 */
class Environment {

  /** @var array $all An array to store all Nexus environments. */
  public static $all = [];

  /**
   * Set a Nexus environment.
   *
   * @param callable $nexus The Nexus environment function to set.
   * @return void
   */
  public static function set( $nexus ) {
    self::$all[] = $nexus; 
  }

  /**
   * Run all Nexus environments.
   *
   * @param string $dist The distribution file name.
   * @return void
   */
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