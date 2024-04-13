<?php

namespace Nexus;


/**
 * Class Engine
 *
 * A class that provides functionality for building and watching files.
 */
class Engine {

  public static $BASEURL = "";
  
  public static $BASEDIR = "";

  public static $PROTECT = "";

  public static $setup = [
    "minify"=> true,
    "autorun"=> true,
    "htaccess"=> true,
  ];

  public static $main = [];

  public static $dist = [];

  // (UNDER DEVELOPMENT)
  public static $PHPPATH = [
    'php',  // Dalam PATH
    '/usr/bin/php',  // Lokasi standar di Linux
    'C:/xampp/php/php.exe',  // Lokasi standar di XAMPP (Windows)
    'C:/laragon/bin/php/php-8.1.10-Win32-vs16-x64/php.exe',  // Lokasi standar di Laragon (Windows)
  ];

  // (UNDER DEVELOPMENT)
  public static function setup( $array ) {
    self::$setup = array_merge(self::$setup, $array);
  }

  /**
   * Build all bundles into one file.
   *
   * @param string $file The name of the output file.
   * @param string $type The type of classification (default is 'plate').
   * @param string $watch The path to watch for changes (optional).
   * @return void
   */
  public static function build( $file, $type='plate', $minify=false ) {
    self::setBaseurl();

    self::$dist['url'] = self::$BASEURL.$file.'.php';
    self::$dist['dir'] = self::$BASEDIR.$file.'.php';
    self::$dist['src'] = $file.'.php';

    self::$main['url'] = self::$BASEURL.'/'.basename($_SERVER['PHP_SELF']);
    self::$main['dir'] = self::$BASEDIR.'/'.basename($_SERVER['PHP_SELF']);
    self::$main['src'] = basename($_SERVER['PHP_SELF']);

    // Handle cli execution...
    if (self::isCli()) {
      $cli = $_SERVER['argv'];

      if ($cli[1] == 'build') {
        Bundler::classification($type, $minify);
        $delay = microtime(true);
        $size = 0;
        if (file_exists(self::$dist['dir'])) {
          $size = filesize(self::$dist['dir']);
        }
        if (file_put_contents(self::$dist['dir'], Bundler::render($type) )) {
          $done = round((microtime(true) - $delay) * 1000, 2);
          echo "✔️ build $file.php : done in $done/ms | $size/kb\n";
        }else {
          echo "❌ build : Failed due to some error on code";
        }
      }
    // Handle non-cli execution...
    } else {
      Bundler::classification($type, $minify);
      file_put_contents(self::$dist['dir'], Bundler::render($type) );
    }
  }

  /**
   * Watch for file modifications and rebuild when changes are detected.
   *
   * @param string $path The path to watch for changes.
   * @return void
   */
  public static function watch( $path ) {
    $path = self::$BASEDIR.$path;

    // Handle cli execution...
    if (self::isCli()) {
      // Get command line arguments
      $cli = $_SERVER['argv'];
      // Check if the command is 'watch'
      if ($cli[1] == 'watch') {
        // Get the last modified time of the specified path
        $lastModifiedTime = self::isModified($path);
        // Notify that the system is now watching
        echo "
███╗   ██╗███████╗██╗  ██╗██╗   ██╗███████╗ - @anwarachilles
████╗  ██║██╔════╝╚██╗██╔╝██║   ██║██╔════╝ - Project | DEVNEET ID
██╔██╗ ██║█████╗   ╚███╔╝ ██║   ██║███████╗
██║╚██╗██║██╔══╝   ██╔██╗ ██║   ██║╚════██║
██║ ╚████║███████╗██╔╝ ██╗╚██████╔╝███████║
╚═╝  ╚═══╝╚══════╝╚═╝  ╚═╝ ╚═════╝ ╚══════╝ - Exit? CTRL + C  
        ";
        echo "Start Watching..\n";
        // Continuous loop for monitoring changes
        while (true) {
          // Get the current modified time of the specified path
          $currentModifiedTime = self::isModified($path);
          // Check if the file has been modified since the last check
          if ($currentModifiedTime != $lastModifiedTime) {
            echo "Rebuild ..\n";
            // Execute the build command
            $resp = shell_exec("php " . $cli[0] . " build");
            // Notify that the system has been rebuilt
            echo $resp."\n";
            // Update the last modified time
            $lastModifiedTime = $currentModifiedTime;
          }
          // Pause for a second before the next check
          sleep(1);
        }
      }
    // Handle non-cli execution...
    } else { 
      // Check if the request is for watch mode
      if (isset($_GET['NEXUS_WATCH'])) {
        // Set headers for Server-Sent Events
        header("X-Accel-Buffering: no");
        header("Cache-Control: no-store");
        header("Content-Type: text/event-stream");
        // Get the last modified time of the specified path
        $lastModifiedTime = self::isModified($path);
        // Continuous loop for monitoring file modifications
        while (true) {
          // Clear file status cache
          clearstatcache();
          // Get the current modified time of the specified path
          $currentModifiedTime = self::isModified($path);
          // Check if the file has been modified
          if ($currentModifiedTime != $lastModifiedTime) {
            // Send a Server-Sent Event to notify file rebuild
            echo "data: rebuilt..\n\n"; 
            // Update the last modified time
            $lastModifiedTime = $currentModifiedTime;
          }
          // Flush output buffers and send data to the client
          ob_flush();
          flush();
          // Check if the connection is aborted by the client
          if (connection_aborted()) {
              break;
          }
          // Wait for 1 second before checking again
          sleep(1);
        }
      } else {
        // If not in watch mode, include and execute serve.php
        $serve = file_get_contents(__DIR__ . '/core/serve.php');
        @eval("?> " . $serve . " <?php");
      }
    }
  }

  // Function to clear the console
  private static function clearConsole() {
    // Menentukan sistem operasi
    $os = strtolower(PHP_OS);
    // Membersihkan konsol berdasarkan sistem operasi
    if (strpos($os, 'win') !== false) {
      // Sistem Windows
      shell_exec('cls');
    } else {
      // Sistem Unix/Linux
      shell_exec('clear');
    }
  }

  /**
   * Checks for the presence of a valid PHP executable in a list of possible paths.
   * (UNDER DEVELOPMENT)
   * @return string|false If a valid PHP executable is found, returns the full path to it. Otherwise, returns false.
   */
  public static function isPhpExecutable() {
    $phpExecutable = null;
    foreach (self::$PHPPATH as $path) {
      // Check if the PHP file exists at this location and is executable
      if (file_exists($path) && is_executable($path)) {
        $phpExecutable = $path;
        break;
      }
    }
    // Return the path to the PHP executable if found, otherwise return false
    return $phpExecutable !== null ? $phpExecutable : false;
  }


  /**
   * Encodes the given data using base64 encoding.
   *
   * @param string $data The data to be encoded.
   * @return string The base64-encoded data.
   */
  public static function encode($data) {
    return base64_encode($data);
  }

  /**
   * Decodes the given base64-encoded data.
   *
   * @param string $data The base64-encoded data to be decoded.
   * @return string The decoded data.
   */
  public static function decode($data) {
    return base64_decode($data);
  }

  /**
   * Generates a hash using the SHA-256 algorithm based on the current timestamp.
   *
   * @return string The SHA-256 hash.
   */
  public static function hash() {
    return hash('sha256', time());
  }

  /**
   * Check if the script is running in the command-line interface (CLI).
   *
   * @return bool True if running in CLI, false otherwise.
   */
  private static function isCli() {
    return (PHP_SAPI === 'cli' OR defined('STDIN'));
  }

  /**
   * Check if any file in the specified path has been modified.
   *
   * @param string $path The path to check for modifications.
   * @return int The timestamp of the last modification.
   */
  private static function isModified($path) {
    $lastModifiedTime = 0;

    $iterator = new \RecursiveIteratorIterator(
        new \RecursiveDirectoryIterator($path, \RecursiveDirectoryIterator::SKIP_DOTS),
        \RecursiveIteratorIterator::SELF_FIRST
    );

    foreach ($iterator as $fileInfo) {
        $fileTime = $fileInfo->getMTime();
        if ($fileTime > $lastModifiedTime) {
            $lastModifiedTime = $fileTime;
        }
    }

    return $lastModifiedTime;
  }


  private static function setBaseurl() {
    if (empty(self::$BASEURL)) {
      $scheme = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
      $host = $_SERVER['HTTP_HOST'];
      self::$BASEURL = $scheme . "://" . $host;
      $documentRoot = $_SERVER['DOCUMENT_ROOT'];
      $folderPath = dirname($_SERVER['PHP_SELF']);
      $folderPath = $folderPath == '/' ? '' : $folderPath . '/';
      if (!empty($folderPath)) {
        $folderPath = str_ireplace('//', '/', $folderPath);
        self::$BASEURL .= $folderPath;
      }
    }
  }
}