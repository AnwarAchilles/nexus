<?php

namespace Nexus;

class Helper 
{
  public static function isCli() {
    return (PHP_SAPI === 'cli' OR defined('STDIN'));
  }

  public static function verifyCli( $withArgs ) {
    $args = $_SERVER['argv'];
    if ($args[0] == $_SERVER['PHP_SELF']) {
      unset($args[0]);
    }
    if (implode(' ', $args) == $withArgs) {
      return true;
    }else {}
  }

  public static function argCli() {
    $args = $_SERVER['argv'];
    if ($args[0] == $_SERVER['PHP_SELF']) {
      unset($args[0]);
    }
    return implode(' ', $args);
  }

  public static function textCli( $arrayText ) {
    foreach ($arrayText as $text) {
      echo $text . "\n";
    }
  }

  public static function cleanPath( $path ) {
    return realpath($path);
  }

  public static function encryptData( $data, $type='base64' )
  {
    if ($type=='base64') {
      if (!empty($data)) {
        return base64_encode($data);
      }else {
        return $data;
      }
    }
    if ($type=='gzip') {
      return gzencode($data);
    }
  }
  
  public static function decryptData($data, $type='base64')
  {
    if ($type=='base64') {
      return base64_decode($data);
    }
    if ($type=='gzip') {
      return gzdecode($data);
    }
  }

  public static function minifiedCss( $input ) {
    if(trim($input) === "") return $input;
    return preg_replace(
      array(
        // Remove comment(s)
        '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')|\/\*(?!\!)(?>.*?\*\/)|^\s*|\s*$#s',
        // Remove unused white-space(s)
        '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/))|\s*+;\s*+(})\s*+|\s*+([*$~^|]?+=|[{};,>~]|\s(?![0-9\.])|!important\b)\s*+|([[(:])\s++|\s++([])])|\s++(:)\s*+(?!(?>[^{}"\']++|"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')*+{)|^\s++|\s++\z|(\s)\s+#si',
        // Replace `0(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)` with `0`
        '#(?<=[\s:])(0)(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)#si',
        // Replace `:0 0 0 0` with `:0`
        '#:(0\s+0|0\s+0\s+0\s+0)(?=[;\}]|\!important)#i',
        // Replace `background-position:0` with `background-position:0 0`
        '#(background-position):0(?=[;\}])#si',
        // Replace `0.6` with `.6`, but only when preceded by `:`, `,`, `-` or a white-space
        '#(?<=[\s:,\-])0+\.(\d+)#s',
        // Minify string value
        '#(\/\*(?>.*?\*\/))|(?<!content\:)([\'"])([a-z_][a-z0-9\-_]*?)\2(?=[\s\{\}\];,])#si',
        '#(\/\*(?>.*?\*\/))|(\burl\()([\'"])([^\s]+?)\3(\))#si',
        // Minify HEX color code
        '#(?<=[\s:,\-]\#)([a-f0-6]+)\1([a-f0-6]+)\2([a-f0-6]+)\3#i',
        // Replace `(border|outline):none` with `(border|outline):0`
        '#(?<=[\{;])(border|outline):none(?=[;\}\!])#',
        // Remove empty selector(s)
        '#(\/\*(?>.*?\*\/))|(^|[\{\}])(?:[^\s\{\}]+)\{\}#s'
      ),
      array(
        '$1',
        '$1$2$3$4$5$6$7',
        '$1',
        ':0',
        '$1:0 0',
        '.$1',
        '$1$3',
        '$1$2$4$5',
        '$1$2$3',
        '$1:0',
        '$1$2'
      ),
    $input);
  }

  public static function minifiedJs( $input ) {
    if(trim($input) === "") return $input;

    // Ekspresi reguler untuk menghapus komentar, termasuk dalam string dan regex
    $removeComments = '#\s*("(?:[^"\\\\]++|\\\\.)*+"|\'(?:[^\'\\\\]++|\\\\.)*+\')\s*|\s*\/\*(?!\!|@cc_on)(?>[\s\S]*?\*\/)\s*|\s*(?<![\:\\=])\/\/.*(?=[\n\r]|$)|^\s*|\s*$#';

    // Ekspresi reguler untuk menghapus spasi putih di luar string dan regex
    $removeWhiteSpace = '#("(?:[^"\\\\]++|\\\\.)*+"|\'(?:[^\'\\\\]++|\\\\.)*+\'|\/\*(?>.*?\*\/)|\/(?!\/)[^\n\r]*?\/(?=[\s.,;]|[gimuy]|$))|\s*([!%&*()\\-=+\\[\\]{}|;:,.<>?\/])\s*#s';

    // Ekspresi reguler untuk menghapus tanda kurung kurawal terakhir
    $removeLastSemicolon = '#;+\}#';

    // Ekspresi reguler untuk meminify atribut objek kecuali atribut JSON
    $minifyObjectAttributes = '#([\{,])([\'])(\d+|[a-z_][a-z0-9_]*)\2(?=:)#i';

    // Ekspresi reguler untuk mengganti akses objek seperti foo['bar'] menjadi foo.bar
    $replaceObjectAccess = '#([a-z0-9_)\]])\[([\'"])([a-z_][a-z0-9_]*)\2\]#i';

    // Array ekspresi reguler
    $patterns = array(
      $removeComments,
      $removeWhiteSpace,
      $removeLastSemicolon,
      $minifyObjectAttributes,
      $replaceObjectAccess
    );

    // Array penggantian untuk setiap ekspresi reguler
    $replacements = array(
      '$1',
      '$1$2',
      '}',
      '$1$3',
      '$1.$3'
    );

    // Terapkan semua ekspresi reguler pada input
    $minifiedCode = preg_replace($patterns, $replacements, $input);

    return $minifiedCode;
  }

  public static function hashRandom() {
    return hash('sha256', time());
  }

  public static function indexData( $data, $index, $falseReturn=false )
  {
    if (isset($data[$index])) {
      return $data[$index];
    }else {
      return $falseReturn;
    }
  }

  public static function formatFileSize($size, $precision = 2) {
    $units = array('BYTE', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
    $i = 0;
    while ($size >= 1024) {
        $size /= 1024;
        $i++;
    }
    return round($size, $precision) . ' ' . $units[min($i, count($units) - 1)];
  }

  public static function isModified($path) {
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


  public static function baseCli()
  {
    echo shell_exec('clear');
    echo shell_exec('cls');
    Helper::textCli(["
  ███╗   ██╗███████╗██╗  ██╗██╗   ██╗███████╗ - @anwarachilles
  ████╗  ██║██╔════╝╚██╗██╔╝██║   ██║██╔════╝ - Project | DEVNEET ID
  ██╔██╗ ██║█████╗   ╚███╔╝ ██║   ██║███████╗
  ██║╚██╗██║██╔══╝   ██╔██╗ ██║   ██║╚════██║
  ██║ ╚████║███████╗██╔╝ ██╗╚██████╔╝███████║
  ╚═╝  ╚═══╝╚══════╝╚═╝  ╚═╝ ╚═════╝ ╚══════╝ - Version ".Setup::$version." Beta
    "]);
  }

  public static function watchCli()
  {
    echo shell_exec('clear');
    Helper::textCli([
      " ",
      " \033[01;34mNEXUS\033[0m - Observer Directories",
      " exit ? CTRL+C"
    ]);
  }

  public static function basicUsage()
  {
    Helper::textCli([
      "\x1b[38;5;244m........................................................\033[0m",
      "
\x1b[38;5;244m// Set base working directory.\033[0m
Nexus\Setup::base('DIR', __DIR__);
Nexus\Setup::base('URL', '');

\x1b[38;5;244m// Set environment partially.\033[0m
Nexus\Engine::env('/index.php', function() {
  // do something here
});

\x1b[38;5;244m// Set build cli triggering.\033[0m
Nexus\Engine::cli('build', function() {
  Nexus\Engine::env('/index.php');
});

\x1b[38;5;244m// Set watch build in nexus observer.\033[0m
Nexus\Engine::cli('watch', function() {
  Nexus\Engine::observer('/src/', [
    Nexus\Engine::cli('build')->argument
  ]);
});

\x1b[38;5;244m// Run nexus.\033[0m
Nexus\Engine::start();
    "]);
  }


  public static function documentationCli()
  {
    Helper::textCli([
      "# SETUP AVALIABLES",
      " # BASE",
      "  DIR : (STRING) current_file_directory example:__DIR__",
      "  URL : (STRING) current_file_url ",
      "",
      " # ENV",
      "  LANGUAGE \t: (ARRAY) [ html, css, js, php ]",
      "  ENCRYPTION \t: (STRING) base64 | gzip",
      "  AUTORUN \t: (BOOLEAN) true | false",
      "  TYPE \t\t: (STRING) plain | class | function",
      "  HTML \t\t: (COUNTRY_CODE) example:en",
      "  JAVASCRIPT \t: (STRING) default | module",
      "",
      "",
      "# METHODS AND PARAMETER",
      " # Engine",
      "  Nexus\Engine::env( distributed_file, callback_function|void )",
      "  Nexus\Engine::cli( distributed_file, callback_function|void )",
      "  Nexus\Engine::observer( watch_directory, array_cli )",
      "",
      " # Setup",
      "  Nexus\Setup::base( array_multidimentional )",
      "  Nexus\Setup::base( key_name, string|array )",
      "  Nexus\Setup::env( array_multidimentional )",
      "  Nexus\Setup::env( key_name, string|array )",
      "",
      " # Source",
      "  Nexus\Source::code( file_target|array_of_file_target )",
      "",
      "",
      "# EXAMPLE USAGE",
      "
\x1b[38;5;244m// set base working directory.\033[0m
Nexus\Setup::base('DIR', __DIR__);

\x1b[38;5;244m// set environment partially.\033[0m
Nexus\Engine::env('/index.php', function() {
  \x1b[38;5;244m// Re:Setup environment.\033[0m
  Nexus\Setup::env('LANGUAGE', ['html', 'css', 'js', 'php']);
  Nexus\Setup::env('TYPE', 'class');

  \x1b[38;5;244m// set source code.\033[0m
  Nexus\Source::code('/src/index.php');
});

\x1b[38;5;244m// set build cli triggering.\033[0m
Nexus\Engine::cli('build', function() {
  Nexus\Engine::env('/index.php');
});

\x1b[38;5;244m// set watch build in nexus observer.\033[0m
Nexus\Engine::cli('watch', function() {
  \x1b[38;5;244m// listing all cli on observer.\033[0m
  Nexus\Engine::observer('/src/', [
    Nexus\Engine::cli('build')->argument
  ]);
});

\x1b[38;5;244m// run nexus.\033[0m
Nexus\Engine::serve();
    "
    ]);
  }

}