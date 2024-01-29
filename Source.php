<?php

namespace Nexus;


/**
 * Class Source
 *
 * A class for managing and retrieving source code files with their metadata.
 */
class Source {

  /**
   * An associative array to store source code data categorized by file extension.
   *
   * @var array
   */
  public static $all = [];

  /**
   * Magic method to handle static method calls for adding source code entries.
   *
   * @param string $extension The file extension for the source code entry.
   * @param array|string $entry The source code entry or an array of entries.
   */
  public static function __callStatic($extension, $entry) {
    if (is_array($entry)) {
      if (!isset(self::$all[$extension])) {
        self::$all[$extension] = [];
      }
      foreach ($entry as $row) {
        $file = Engine::$BASEDIR.$row . '.' . $extension;
        $all = [];
        $all['path'] = $file;
        $all['name'] = basename($file);
        if (file_exists($file)) {
          $all['data'] = Engine::encode(file_get_contents($file));
        }
        self::$all[$extension][] = $all;
      }
    } else {
      $file = Engine::$BASEDIR.$entry . '.' . $extension;
      self::$all[$extension][]['path'] = $file;
      self::$all[$extension][]['name'] = basename($file);
      if (file_exists($file)) {
        self::$all[$extension][]['data'] = Engine::encode(file_get_contents($file));
      }
    }
  }

}