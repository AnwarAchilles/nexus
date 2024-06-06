<?php


namespace Nexus;


class Source 
{

  private static $code = [];

  public static function __callStatic( $call, $param )
  {
    // CODE SECTION
    if (str_contains($call, 'Code')) {
      $name = Helper::indexData($param, 0, '/');
      $code = Helper::cleanPath(Setup::getBase("DIR") . $name);

      if (str_contains($call, 'has')) {
        if (isset(self::$code[$name])) {
          return true;
        }else {
          if ($code) {
            return false;
          }else {
            Engine::setState(__CLASS__.':'.$call, "Code not found " . $name, "ERROR");
            return true;
          }
          return false;
        }
      }
      if (str_contains($call, 'set')) {
        if (!self::hasCode($name)) {
          $code_data = Helper::encryptData(file_get_contents($code), 'base64');
          $code_info = pathinfo($code);
          self::$code[$name] = (object) array_merge($code_info, [
            'fullpath'=> $code,
            'filedata'=> $code_data,
            'datalength'=> Strlen($code_data),
            "filesize"=> filesize($code)
          ]);
          return true;
        }
      }
      if (str_contains($call, 'get')) {
        if (self::hasCode($name)) {
          return self::$code[$name];
        }
      }
    }


    // CODE SHORTHAND
    if (str_contains($call, 'code')) {
      if (is_array($param[0])) {
        foreach ($param[0] as $row) {
          $name = $row;
          $code = Helper::cleanPath(Setup::getBase("DIR") . $name);
          self::setCode($name, $code);
        }
      }else {
        foreach ($param as $row) {
          $name = $row;
          $code = Helper::cleanPath(Setup::getBase("DIR") . $name);
          self::setCode($name, $code);
        }
      }
    }
  }

  public static function load()
  {
    return (object) [
      'code'=> (array) self::$code,
    ];
  }

  public static function reset()
  {
    self::$code = [];
  }


}