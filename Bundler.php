<?php

namespace Nexus;

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
      '<!DOCTYPE>',
      '<!DOCTYPE html>',
      '<html>',
      '<html lang="en">',
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
    self::$plate = Engine::encode(file_get_contents(__DIR__.'/core/plate.php'));
    self::$class = Engine::encode(file_get_contents(__DIR__.'/core/class.php'));
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