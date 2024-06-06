<?php


namespace Nexus;

class Setup
{

  public static $base = [
    'DIR'=> '',
    'URL'=> '',
  ];

  public static $construct = [
    'TYPE'=> 'plain',
    'LANGUAGE'=> ['html','css','js','php'],
    'ENCRYPTION'=> 'base64',
    'JAVASCRIPT'=> 'text/javascript',
    'AUTORUN'=> true,
    'HTML'=> 'en',
  ];


  public static function __callStatic( $call, $param )
  {
    // BASE
    if (str_contains($call, 'Base')) {
      $base = strtoupper(Helper::indexData($param, 0, ''));
      $data = Helper::indexData($param, 1, '');

      if (str_contains($call, 'has')) {
        if (isset(self::$base[$base])) {
          return true;
        }else {
          return false;
        }
      }
      if (str_contains($call, 'set')) {
        if (self::hasBase($base)) {
          self::$base[$base] = $data;
        }
      }
      if (str_contains($call, 'get')) {
        if (self::hasBase($base)) {
          return self::$base[$base];
        }
      }
    }

    // CONSTRUCT
    if (str_contains($call, 'Construct')) {
      $name = strtoupper(Helper::indexData($param, 0, ''));
      $data = Helper::indexData($param, 1, '');

      if (str_contains($call, 'has')) {
        if (isset(self::$construct[$name])) {
          return true;
        }else {
          return false;
        }
      }
      if (str_contains($call, 'set')) {
        if (self::hasConstruct($name)) {
          self::$construct[$name] = $data;
        }
      }
      if (str_contains($call, 'get')) {
        if (self::hasConstruct($name)) {
          return self::$construct[$name];
        }
      }
    }

    // BASE SHORTHAND
    if (str_contains($call, 'base')) {
      if (!is_array($param[0])) {
        $name = strtoupper(Helper::indexData($param, 0, ''));
        $data = Helper::indexData($param, 1, '');
        self::setBase($name, $data);
      }else {
        foreach ($param[0] as $key=>$row) {
          $name = strtoupper($key);
          $data = $row;
          self::setBase($name, $data);
        }
      }
    }

    // ENV SHORTHAND
    if (str_contains($call, 'env')) {
      if (!is_array($param[0])) {
        $name = strtoupper(Helper::indexData($param, 0, ''));
        $data = Helper::indexData($param, 1, '');
        self::setConstruct($name, $data);
      }else {
        foreach ($param[0] as $key=>$row) {
          $name = strtoupper($key);
          $data = $row;
          self::setConstruct($name, $data);
        }
      }
    }
  }

  public static function load()
  {
    return (object) [
      'base'=> (object) self::$base,
      'construct'=> (object) self::$construct,
    ];
  }

  public static function reset()
  {
    self::$construct = [
      'TYPE'=> 'plain',
      'LANGUAGE'=> ['html','css','js','php'],
      'ENCRYPTION'=> 'base64',
      'JAVASCRIPT'=> 'text/javascript',
      'AUTORUN'=> true,
      'HTML'=> 'en',
    ];
  }

}