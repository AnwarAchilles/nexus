<?php

namespace Nexus;

/**
 * Class Engine
 *
 * A class that provides functionality for building and watching files.
 */
class Engine {

  public static $serve = "PD9waHAgJHF1ZXJ5ID0gKCFlbXB0eSgkX0dFVCkpID8gIj8iLiRfU0VSVkVSWyJRVUVSWV9TVFJJTkciXSA6ICIiOyA/Pgo8IURPQ1RZUEUgaHRtbD4KPGh0bWwgbGFuZz0iZW4iPgo8aGVhZD4KICA8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCI+CiAgCiAgPHN0eWxlPgogICAgKiB7IGJveC1zaXppbmc6IGJvcmRlci1ib3g7IH0KICAgIGJvZHkgewogICAgICBtYXJnaW46IDA7CiAgICAgIHBhZGRpbmc6IDA7CiAgICB9CiAgICAjaWZyYW1lIHsKICAgICAgei1pbmRleDogNTAwOwogICAgICBwb3NpdGlvbjogZml4ZWQ7CiAgICAgIHRvcDogMDsKICAgICAgcGFkZGluZzogMDsKICAgICAgd2lkdGg6IDEwMCU7CiAgICAgIGhlaWdodDogMTAwJTsKICAgICAgZGlzcGxheTogZmxleDsKICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7CiAgICB9CiAgICAjaWZyYW1lPmlmcmFtZSB7CiAgICAgIG9wYWNpdHk6IDA7CiAgICAgIHRyYW5zaXRpb246IG9wYWNpdHkgMC4zcyBlYXNlLW91dDsKICAgICAgd2lkdGg6IDEwMCU7CiAgICAgIGhlaWdodDogMTAwJTsKICAgIH0KICAgIEBrZXlmcmFtZXMgbG9hZGVyIHsKICAgICAgMCUgeyB3aWR0aDozMHB4OyBoZWlnaHQ6MzBweDsgfQogICAgICA1MCUgeyB3aWR0aDo3MHB4OyBoZWlnaHQ6NzBweDsgb3BhY2l0eTowOyB9CiAgICB9CiAgICAjbG9hZGVyIHsKICAgICAgb3BhY2l0eTogMC41OwogICAgICBhbmltYXRpb246IGxvYWRlciAxcyBlYXNlLW91dCBpbmZpbml0ZTsKICAgICAgYWxpZ24tc2VsZjpjZW50ZXI7CiAgICAgIHdpZHRoOiAzMHB4OwogICAgICBoZWlnaHQ6IDMwcHg7CiAgICAgIGJhY2tncm91bmQtY29sb3I6IHJlZDsKICAgICAgYm9yZGVyLXJhZGl1czogMTAwJTsKICAgICAgZGlzcGxheTogaW5saW5lLWJsb2NrOwogICAgICBwb3NpdGlvbjogZml4ZWQ7CiAgICB9CiAgICAjbW9uaXRvciB7CiAgICAgIHotaW5kZXg6IDkwMDsKICAgICAgcG9zaXRpb246IGZpeGVkOwogICAgICB0b3A6IDA7CiAgICAgIGZvbnQtZmFtaWx5OiAnQXJpYWwnOwogICAgICBmb250LXNpemU6IDAuOHJlbTsKICAgICAgYmFja2dyb3VuZC1jb2xvcjogcmdiYSgyMDAsMjAwLDIwMCwwLjIpOwogICAgICB3aWR0aDogMTAwJTsKICAgICAgcGFkZGluZzogMnB4IDEwcHg7CiAgICAgIGRpc3BsYXk6IGZsZXg7CiAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7CiAgICAgIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjsKICAgIH0KICAgICNtb25pdG9yICN0aXRsZSB7CiAgICAgIG1hcmdpbjogMDsKICAgIH0KICAgICNtb25pdG9yICNwbGF5LAogICAgI21vbml0b3IgI3N0b3AgewogICAgICBib3JkZXI6IDA7CiAgICAgIHBhZGRpbmc6IDVweCAxMHB4OwogICAgICBiYWNrZ3JvdW5kOiB0cmFuc3BhcmVudDsKICAgICAgY3Vyc29yOiBwb2ludGVyOwogICAgfQogICAgI21vbml0b3IgI3N0b3AgeyBjb2xvcjpyZWQ7IH0KICAgICNtb25pdG9yICNwbGF5IHsKICAgICAgY29sb3I6IGdyZWVuOwogICAgICBkaXNwbGF5OiBub25lOwogICAgfQogIDwvc3R5bGU+Cgo8L2hlYWQ+Cjxib2R5PgoKICA8ZGl2IGlkPSJpZnJhbWUiPgogICAgPGRpdiBpZD0ibG9hZGVyIj48L2Rpdj4KICAgIDxkaXYgaWQ9Im1vbml0b3IiPgogICAgICA8c3BhbiBpZD0idGl0bGUiPvCfk6YgTmV4dXMgMS4wIC0gVmlld2VyPC9zcGFuPgogICAgICA8ZGl2PgogICAgICAgIDxidXR0b24gaWQ9InBsYXkiPuKWtjwvYnV0dG9uPgogICAgICAgIDxidXR0b24gaWQ9InN0b3AiPuKXvDwvYnV0dG9uPgogICAgICA8L2Rpdj4KICAgIDwvZGl2PgogICAgPGlmcmFtZSBmcmFtZWJvcmRlcj0iMCI+PC9pZnJhbWU+CiAgPC9kaXY+CgogIDxzY3JpcHQ+CiAgICBkb2N1bWVudC5hZGRFdmVudExpc3RlbmVyKCJET01Db250ZW50TG9hZGVkIiwgZnVuY3Rpb24oKSB7CiAgICAgIGNvbnN0IE1BSU4gPSAiPD89c2VsZjo6JG1haW5bJ3VybCddPz4/TkVYVVNfV0FUQ0giOwogICAgICBjb25zdCBESVNUID0gIjw/PXNlbGY6OiRkaXN0Wyd1cmwnXT8+IjsKICAgICAgY29uc3QgTU9OSVRPUiA9IHsKICAgICAgICBwbGF5OiBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCIjcGxheSIpLAogICAgICAgIHN0b3A6IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoIiNzdG9wIiksCiAgICAgIH07CiAgICAgIGNvbnN0IElGUkFNRSA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoIiNpZnJhbWU+aWZyYW1lIik7CiAgICAgIAogICAgICBJRlJBTUUuc2V0QXR0cmlidXRlKCJzcmMiLCBESVNUKTsKICAgICAgSUZSQU1FLmFkZEV2ZW50TGlzdGVuZXIoJ2xvYWQnLCBmdW5jdGlvbigpIHsKICAgICAgICBjb25zdCBTU0UgPSBuZXcgRXZlbnRTb3VyY2UoTUFJTik7CgogICAgICAgIFNTRS5vbm1lc3NhZ2UgPSAoZXZlbnQpID0+IHsKICAgICAgICAgIHdpbmRvdy5sb2NhdGlvbi5yZWxvYWQodHJ1ZSk7CiAgICAgICAgfTsKCiAgICAgICAgTU9OSVRPUi5wbGF5LmFkZEV2ZW50TGlzdGVuZXIoImNsaWNrIiwgKCk9PiB7CiAgICAgICAgICB3aW5kb3cubG9jYXRpb24ucmVsb2FkKHRydWUpOwogICAgICAgIH0pOwoKICAgICAgICBNT05JVE9SLnN0b3AuYWRkRXZlbnRMaXN0ZW5lcigiY2xpY2siLCAoKT0+IHsKICAgICAgICAgIE1PTklUT1IucGxheS5zdHlsZS5kaXNwbGF5ID0gImlubGluZS1ibG9jayI7CiAgICAgICAgICBNT05JVE9SLnN0b3Auc3R5bGUuZGlzcGxheSA9ICJub25lIjsKICAgICAgICAgIFNTRS5jbG9zZSgpOwogICAgICAgIH0pOwoKICAgICAgICBJRlJBTUUuc3R5bGUub3BhY2l0eSA9IDE7CgogICAgICAgIGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoIiNsb2FkZXIiKS5zdHlsZS5kaXNwbGF5ID0gIm5vbmUiOwogICAgICB9KTsKICAgIH0pOwogIDwvc2NyaXB0Pgo8L2JvZHk+CjwvaHRtbD4=";
  
  public static $BASEURL = "";
  
  public static $BASEDIR = "";

  public static $main = [];

  public static $dist = [];

  // (UNDER DEVELOPMENT)
  public static $PHPPATH = [
    'php',  // Dalam PATH
    '/usr/bin/php',  // Lokasi standar di Linux
    'C:/xampp/php/php.exe',  // Lokasi standar di XAMPP (Windows)
    'C:/laragon/bin/php/php-8.1.10-Win32-vs16-x64/php.exe',  // Lokasi standar di Laragon (Windows)
  ];

  /**
   * Build all bundles into one file.
   *
   * @param string $file The name of the output file.
   * @param string $type The type of classification (default is 'plate').
   * @param string $watch The path to watch for changes (optional).
   * @return void
   */
  public static function build( $file, $type='plate' ) {
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
        Bundler::classification($type);
        file_put_contents(self::$dist['dir'], Bundler::render($type) );
      }
    // Handle non-cli execution...
    } else {
      Bundler::classification($type);
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
        echo "Nexus : watching..\n";
        // Continuous loop for monitoring changes
        while (true) {
          // Get the current modified time of the specified path
          $currentModifiedTime = self::isModified($path);
          // Check if the file has been modified since the last check
          if ($currentModifiedTime != $lastModifiedTime) {
            // Execute the build command
            shell_exec("php " . $cli[0] . " build");
            // Notify that the system has been rebuilt
            echo "Nexus : rebuilt..\n";
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
        // $serve = file_get_contents(__DIR__ . '/core/serve.php');
        $serve = self::decode(self::$serve);
        @eval("?> " . $serve . " <?php");
      }
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
}

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

/**
 * Class Template
 *
 * A class for managing code and rendering code snippets.
 */
class Bundler {

  public static $class = "PD9waHAKIyBQSFAgQnVuZGxlciB2ZXJzaW9uIC0gMC4wLjEKIyBBdXRob3I6IEFud2FyIEFjaGlsbGVzIHwgaHVkb3JpYW53YXIwN0BnbWFpbC5jb20KCm5ldyBBcHBAe3sgSEFTSC1BUFAgfX0oWwogICAgCl0pOwoKY2xhc3MgQXBwQHt7IEhBU0gtQVBQIH19CnsKCiAgICBwcml2YXRlICR0ZW1wbGF0ZSA9ICdAe3sgVEVNUExBVEUgfX0nOwoKICAgIC8qIAogICAgICogTUFJTiBDT05TVFJVQ1RPUgogICAgICogKi8KICAgIHB1YmxpYyBmdW5jdGlvbiBfX2NvbnN0cnVjdCggJEFQUFMgKQogICAgewogICAgICAgICR0aGlzLT5fX2luc3RhbGxAe3sgSEFTSC1DUllQVElPTiB9fSgiUEhQIiwgJHRoaXMtPl9fYnVuZGxlX3BocEB7eyBIQVNILVBIUCB9fSgpICk7CiAgICAgICAgJHRoaXMtPl9faW5zdGFsbEB7eyBIQVNILUNSWVBUSU9OIH19KCJDU1MiLCAkdGhpcy0+X19idW5kbGVfY3NzQHt7IEhBU0gtQ1NTIH19KCkgKTsKICAgICAgICAkdGhpcy0+X19pbnN0YWxsQHt7IEhBU0gtQ1JZUFRJT04gfX0oIkpTIiwgJHRoaXMtPl9fYnVuZGxlX2pzQHt7IEhBU0gtSlMgfX0oKSApOwoKICAgICAgICBmb3JlYWNoICgkdGhpcy0+X19idW5kbGVfaHRtbEB7eyBIQVNILUhUTUwgfX0oKSBhcyAkYmFzZSA9PiAkYnVuZGxlICkgewogICAgICAgICAgICAkdGhpcy0+X19pbnN0YWxsQHt7IEhBU0gtQ1JZUFRJT04gfX0oIkhUTUwtIi4kYmFzZSwgJGJ1bmRsZSApOwogICAgICAgIH0KCiAgICAgICAgZXZhbCgiPz4iLiR0aGlzLT5fX2NyeXB0aW9uQHt7IEhBU0gtQ1JZUFRJT04gfX0oJHRoaXMtPnRlbXBsYXRlLCBGQUxTRSApLiI8P3BocCIpOwogICAgfQoKICAgIC8qIAogICAgICogQlVORExFIENPTlRBSU5FUiBQSFA6IFBST0NFU1NPUgogICAgICogKi8KICAgIHByaXZhdGUgZnVuY3Rpb24gX19idW5kbGVfcGhwQHt7IEhBU0gtUEhQIH19KCkKICAgIHsKICAgICAgICAkYnVuZGxlID0gYXJyYXkoKTsKQHt7IFBIUCB9fQoKICAgICAgICByZXR1cm4gJGJ1bmRsZTsKICAgIH0KCiAgICAvKiAKICAgICAqIEJVTkRMRSBDT05UQUlORVIgSFRNTDogSFlQRVJURVhUCiAgICAgKiAqLwogICAgcHJpdmF0ZSBmdW5jdGlvbiBfX2J1bmRsZV9odG1sQHt7IEhBU0gtSFRNTCB9fSgpCiAgICB7CiAgICAgICAgJGJ1bmRsZSA9IG5ldyBTdGRDbGFzcygpOwogICAgICAgICRidW5kbGUtPmhlYWQgPSBhcnJheSgpOwpAe3sgSFRNTC1IRUFEIH19CgogICAgICAgICRidW5kbGUtPmJvZHkgPSBhcnJheSgpOwpAe3sgSFRNTC1CT0RZIH19CgogICAgICAgIHJldHVybiAkYnVuZGxlOwogICAgfQoKICAgIC8qIAogICAgICogQlVORExFIENPTlRBSU5FUiBDU1M6IFNUWUxFU0hFRVQKICAgICAqICovCiAgICBwcml2YXRlIGZ1bmN0aW9uIF9fYnVuZGxlX2Nzc0B7eyBIQVNILUNTUyB9fSgpCiAgICB7CiAgICAgICAgJGJ1bmRsZSA9IGFycmF5KCk7CkB7eyBDU1MgfX0KCiAgICAgICAgcmV0dXJuICRidW5kbGU7CiAgICB9CgogICAgLyogCiAgICAgKiBCVU5ETEUgQ09OVEFJTkVSIEpTOiBKQVZBU0NSSVBUCiAgICAgKiAqLwogICAgcHJpdmF0ZSBmdW5jdGlvbiBfX2J1bmRsZV9qc0B7eyBIQVNILUpTIH19KCkKICAgIHsKICAgICAgICAkYnVuZGxlID0gYXJyYXkoKTsKQHt7IEpTIH19CiAgICAgICAgCiAgICAgICAgcmV0dXJuICRidW5kbGU7CiAgICB9CgogICAgLyogCiAgICAgKiBNRVRIT0QgQ1JZUFRJT04KICAgICAqICovCiAgICBwcml2YXRlIGZ1bmN0aW9uIF9fY3J5cHRpb25Ae3sgSEFTSC1DUllQVElPTiB9fSggJGRhdGEsICRzdGF0ZSApCiAgICB7CiAgICAgICAgaWYgKCRzdGF0ZT09VFJVRSkgewogICAgICAgICAgICByZXR1cm4gYmFzZTY0X2VuY29kZSgkZGF0YSk7CiAgICAgICAgfWVsc2UgewogICAgICAgICAgICByZXR1cm4gYmFzZTY0X2RlY29kZSgkZGF0YSk7CiAgICAgICAgfQogICAgfQoKICAgIC8qIAogICAgICogTUVUSE9EIElOU1RBTExFUgogICAgICogKi8KICAgIHByaXZhdGUgZnVuY3Rpb24gX19pbnN0YWxsQHt7IEhBU0gtQ1JZUFRJT04gfX0oICRwcmVmaXgsICRidW5kbGUgKQogICAgewogICAgICAgICRwYWNrZXQ9W107CiAgICAgICAgZm9yZWFjaCAoJGJ1bmRsZSBhcyAkcGFja2V0X2VuY29kZSkgewogICAgICAgICAgICAkcGFja2V0W10gPSAkdGhpcy0+X19jcnlwdGlvbkB7eyBIQVNILUNSWVBUSU9OIH19KCRwYWNrZXRfZW5jb2RlLCBGQUxTRSApOwogICAgICAgIH0KICAgICAgICAkc291cmNlID0gaW1wbG9kZSgiXG4iLCAkcGFja2V0KTsKICAgICAgICAkVEVNUExBVEUgPSAkdGhpcy0+X19jcnlwdGlvbkB7eyBIQVNILUNSWVBUSU9OIH19KCR0aGlzLT50ZW1wbGF0ZSwgRkFMU0UgKTsKICAgICAgICAkVEVNUExBVEUgPSBzdHJfcmVwbGFjZSgiQHt7ICIuc3RydG91cHBlcigkcHJlZml4KS4iIH19IiwgJHNvdXJjZSwgJFRFTVBMQVRFKTsKICAgICAgICAkdGhpcy0+dGVtcGxhdGUgPSAkdGhpcy0+X19jcnlwdGlvbkB7eyBIQVNILUNSWVBUSU9OIH19KCRURU1QTEFURSwgVFJVRSApOwogICAgfQp9Cgo/Pg==";

  public static $plate = "PD9waHAKIyBQSFAgQnVuZGxlciB2ZXJzaW9uIC0gMC4wLjEKIyBBdXRob3I6IEFud2FyIEFjaGlsbGVzIHwgaHVkb3JpYW53YXIwN0BnbWFpbC5jb20KQHt7IFBIUCB9fQovLyBBTEwgT0YgU09VUkNFIEFSRSBCVU5ETElORyA/Pgo8IURPQ1RZUEUgaHRtbD4KPGh0bWwgbGFuZz0iZW4iPgo8aGVhZD4KQHt7IEhUTUwtSEVBRCB9fQogICAgPHN0eWxlPgpAe3sgQ1NTIH19CiAgICA8L3N0eWxlPgo8L2hlYWQ+Cjxib2R5PgpAe3sgSFRNTC1CT0RZIH19CiAgICA8c2NyaXB0PgpAe3sgSlMgfX0KICAgIDwvc2NyaXB0Pgo8L2JvZHk+CjwvaHRtbD4=";

  /**
   * An array to store code snippets for different programming languages.
   *
   * @var array
   */
  public static $all = [
    'php' => '',
    'html'=> '',
    'html-body'=> '',
    'html-head'=> '',
    'css'=> '',
    'js'=> '',
  ];

  /**
   * An array containing elements to be cleaned from code snippets.
   *
   * @var array
   */
  public static $clean = [
    'php'=> [
      '<?php',
      '<?=',
      '?>',
    ],
    'css'=> [
      '<style>',
      '</style>',
    ],
    'js'=> [
      '<script>',
      '</script>',
    ],
    'html'=> [
      '<html>',
      '</html>',
      '<head>',
      '</head>',
      '<body>',
      '</body>',
      '<style>',
      '</style>',
    ],
  ];

  /**
   * Replaces placeholders in a string with specified values.
   *
   * @param string $variable The variable name to replace.
   * @param string $from The original string containing placeholders.
   * @param string $to The value to replace the placeholder with.
   * @return string The modified string.
   */
  public static function set( $variable, $from, $to ) {
    return str_replace('@{{ '.strtoupper($variable).' }}', $to, $from);
  }
  
  /**
   * Cleans specified elements from a code snippet.
   *
   * @param string $code The code snippet to clean.
   * @return string The cleaned code snippet.
   */
  public static function clean( $language, $code ) {
    $parse = $code;
    foreach (self::$clean[$language] as $row) {
      $parse = str_replace($row, '', $parse);
    }
    return $parse;
  }

  /**
   * Classifies and organizes code snippets based on the specified type.
   *
   * @param string $type The classification type (default is 'plate').
   * @return void
   */
  public static function classification( $type='plate' ) {    
    if ($type=='plate') {
      foreach (Source::$all as $language=>$source) {
        if (!isset(self::$all[$language])) {
          self::$all[$language] = "";
        }
        foreach ($source as $packet) {
          if (isset($packet['data'])) {
            $data = self::clean($language, Engine::decode($packet['data']));
            if (str_contains($packet['name'], 'html')) {
              if (str_contains($packet['name'], 'head.html')) {
                self::$all['html-head'] = self::$all['html-head'] . $data ."\n";
              }else {
                self::$all['html-body'] = self::$all['html-body'] . $data ."\n";
              }
            }else {
              self::$all[$language] = self::$all[$language] . $data ."\n";
            }
          }
        }
      }
    }
    if ($type=='class') {
      foreach (self::$all as $language=>$none) {
        self::$all['hash-'.$language] = Engine::hash();
        self::$all['hash-app'] = Engine::hash();
        self::$all['hash-cryption'] = Engine::hash();

        if (isset(Source::$all[$language])) {
          foreach (Source::$all[$language] as $packet) {
            $data = Engine::encode(self::clean($language, Engine::decode($packet['data'])));
            if (str_contains($packet['name'], 'html')) {
              if (str_contains($packet['name'], 'head.html')) {
                self::$all['html-head'] = self::$all['html-head'] . "\t\t\$bundle->head[] = '" . $data."';\n";
              }else {
                self::$all['html-body'] = self::$all['html-body'] . "\t\t\$bundle->body[] = '" . $data."';\n";
              }
            }else {
              self::$all[$language] = self::$all[$language] . "\t\t\$bundle[] = '" . $data."';\n";
            }
          }
        }
      }
    }
  }

  /**
   * Renders the template based on the specified type.
   *
   * @param string $type The rendering type (default is 'plate').
   * @return string The rendered template.
   */
  public static function render( $type='plate' ) {
    if ($type=='class') {
      self::$all['template'] = self::$plate;
      $template = Engine::decode(self::$class);
    }else {
      $template = Engine::decode(self::$plate);
    }
    foreach (self::$all as $language=>$data) {
      $template = self::set($language, $template, $data);
    }
    return $template;
  }

}