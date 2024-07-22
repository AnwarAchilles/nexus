<?php

namespace Nexus;

class Compiler
{
  
  public static $source = [];
  
  public static $setup = [];
  
  public static $core = [];

  public static $entries = [];

  public static $cleaner = [
    'php'=> [
      '<?php', '<?=', '?>',
    ],
    'css'=> [
      '<style>', '</style>',
    ],
    'js'=> [
      '<script>', '</script>',
    ],
    'html-head'=> [
      '<!DOCTYPE>', '<!DOCTYPE html>',
      '<html>', '<html lang="en">', '</html>',
      '<head>', '</head>',
      '<body>', '</body>',
      '<style>', '</style>',
    ],
    'html-body'=> [
      '<!DOCTYPE>', '<!DOCTYPE html>',
      '<html>', '<html lang="en">', '</html>',
      '<head>', '</head>',
      '<body>', '</body>',
      '<style>', '</style>',
    ],
  ];

  public static $classificate = [
    'code'=> [
      '.html'=> 'html-body',
      '.head.html'=> 'html-head',
      '.css'=> 'css',
      '.js'=> 'js',
      '.php'=> 'php'
    ]
  ];

  public static $cluster = [
    'code'=> [],
  ];

  public static $distribute = [
    'file'=> '',
    'data'=> '@{INITIALIZE}',
  ];




  public static function bundling( $engine, $source, $setup, $microtime='' )
  {
    self::$source = $source;
    self::$setup = $setup;


    self::loadCore();
    self::matchCore();

    self::classificate();
    self::$core = str_ireplace('<html>', '<html lang="'.$setup->construct->HTML.'">', self::$core);
    
    self::$entries["initialize"] = self::$core;
    self::$entries["copyright"] = self::getCore("copyright.txt");
    self::$entries['copyright-version'] = Setup::$version;
    if ($setup->construct->TYPE=='class') {
      self::$entries['hash-app'] = Helper::hashRandom();
      self::$entries['construct'] = Helper::encryptData(str_ireplace('<html>', '<html lang="'.$setup->construct->HTML.'">', self::getCore('class.txt')), $setup->construct->ENCRYPTION);
      self::$entries['manifest'] = Helper::encryptData(json_encode($setup), $setup->construct->ENCRYPTION);
      self::$entries['encryption'] = $setup->construct->ENCRYPTION;
    }
    foreach (self::$cluster['code'] as $variable=>$entry) {
      if ($setup->construct->TYPE == 'plain') {
        $data = implode("\n", $entry);
        self::$entries[$variable] = self::cleanup($variable, $data) . "\n";
      }
      if ($setup->construct->TYPE == 'class') {
        $data = "";
        foreach ($entry as $row) {
          if (!empty($row)) {
            $data = $data . "\t\t\t'" . Helper::encryptData(self::cleanup($variable, $row), $setup->construct->ENCRYPTION) . "',\n";
          }
        }
        self::$entries[$variable] = $data;
      }
    }
    
    self::distribute( $setup, $engine );

    $result = [];

    if ($microtime) {
      $endTime = microtime(true);
      $executeTime = round($endTime - $microtime, 3);
      $result['time'] = $executeTime;
    }

    $result['size'] = filesize(self::$distribute['file']);

    self::$core = [];
    self::$entries = [];
    self::$cluster['code'] = [];
    self::$distribute['data'] = '@{INITIALIZE}';

    return (object) $result;
  }




  public static function __callStatic( $call, $param )
  {

    // DISTRIBUTE
    if (str_contains($call, 'distribute')) {
      $setup = Helper::indexData($param, 0, '');
      $engine = Helper::indexData($param, 1, '');

      $directory = pathinfo($setup->base->DIR . '/' . $engine['construct']->distribute, PATHINFO_DIRNAME);
      if (!file_exists($directory)) {
        mkdir($directory, 777);
      }
      if (!file_exists($setup->base->DIR . '/' . $engine['construct']->distribute)) {
        touch($setup->base->DIR . '/' . $engine['construct']->distribute);
      }
      
      self::$distribute['file'] = Helper::cleanPath($setup->base->DIR . '/' . $engine['construct']->distribute);

      foreach (self::$entries as $variable=>$data) {
        self::$distribute['data'] = str_ireplace(
          "@{" . strtoupper($variable) . "}", 
          $data, 
          self::$distribute['data']
        );
      }
      
      self::$distribute['data'] = preg_replace('/\n\s*\n/', "\n", self::$distribute['data']);
  
      if (file_put_contents(self::$distribute['file'], self::$distribute['data'])) {
        return true;
      }
    }

    // CLEANUP
    if (str_contains($call, 'cleanup')) {
      $language = Helper::indexData($param, 0, '');
      $data = Helper::indexData($param, 1, '');

      if (isset(self::$cleaner[$language])) {
        $clean = $data;
        foreach (self::$cleaner[$language] as $row) {
          $clean = str_ireplace($row, '', $clean);
        }
        return $clean;
      }else {
        return $data;
      }
    }

    // CLASSIFICATE
    if (str_contains($call, 'classificate')) {
      foreach (self::$classificate['code'] as $key => $variable) {
        self::$cluster['code'][$variable] = [];
      }
      foreach (self::$source->code as $code) {
        $parse_key = "";
        foreach (self::$classificate['code'] as $key => $variable) {
          if (str_contains($code->basename, $key)) {
            $parse_key = $variable;
          }
        }
        if ($code->filesize) {
          if ($parse_key=='css') {
            if (in_array('css', self::$setup->construct->MINIFIED)) {
              self::$cluster['code'][$parse_key][] = Helper::minifiedCss(Helper::decryptData($code->filedata), 'base64');
            }else {
              self::$cluster['code'][$parse_key][] = Helper::decryptData($code->filedata, 'base64');
            }
          }else if ($parse_key=='js') {
            if (in_array('js', self::$setup->construct->MINIFIED)) {
              self::$cluster['code'][$parse_key][] = Helper::minifiedJs(Helper::decryptData($code->filedata), 'base64');
            }else {
              self::$cluster['code'][$parse_key][] = Helper::decryptData($code->filedata, 'base64');
            }
          }else if ($parse_key=='php') {
            if (in_array('php', self::$setup->construct->MINIFIED)) {
              self::$cluster['code'][$parse_key][] = Helper::minifiedPhp(Helper::decryptData($code->filedata), 'base64');
            }else {
              self::$cluster['code'][$parse_key][] = Helper::decryptData($code->filedata, 'base64');
            }
          }else if (($parse_key=='html-body') || ($parse_key=='html-head')) {
            if (in_array('html', self::$setup->construct->MINIFIED)) {
              self::$cluster['code'][$parse_key][] = Helper::minifiedHtml(Helper::decryptData($code->filedata), 'base64');
            }else {
              self::$cluster['code'][$parse_key][] = Helper::decryptData($code->filedata, 'base64');
            }
          }else {
            self::$cluster['code'][$parse_key][] = Helper::decryptData($code->filedata, 'base64');
          }
        }
      }
    }

    // CORE SECTION
    if (str_contains($call, 'Core')) {
      $fileTarget = Helper::indexData($param, 0, '');
      
      if (str_contains($call, 'has')) {
        if (file_exists(__DIR__ . '/core/' . $fileTarget)) {
          return true;
        }else {
          Engine::state(__CLASS__.':'.__METHOD__, "Core not exists");
          return false;
        }
      }
      if (str_contains($call, 'get')) {
        if (self::hasCore($fileTarget)) {
          return file_get_contents(__DIR__ . '/core/' . $fileTarget);
        }
      }
      if (str_contains($call, 'match')) {
        $type = self::$setup->construct->TYPE;
        $language = self::$setup->construct->LANGUAGE;
        $match = false;
        foreach (self::$core as $core) {
          if ($core->language == $language) {
            if ($core->type == $type) {
              $match = $core;
            }
          }
        }
        if ($match) {
          self::$core = $match->source;
          return true;
        }else {
          Engine::setState(__CLASS__.':'.__FUNCTION__, "Not have match language");
          return false;
        }
      }
      if (str_contains($call, 'load')) {
        foreach (glob(__DIR__.'/core/*') as $row) {
          if (pathinfo($row, PATHINFO_EXTENSION) == 'construct') {
            $text = file_get_contents($row);

            $matches = [];
            preg_match('/\[\[NEXUS\]\] (.*?) \[\[NEXUS\]\]/', $text, $matches);
            $find_key = isset($matches[1]) ? strtolower($matches[1]) : '';
            $key = json_decode($find_key, true);
      
            $text = preg_replace('/\[\[NEXUS\]\] (.*?) \[\[NEXUS\]\]/', '', $text);
      
            self::$core[] = (object) array_merge($key, [
              'source'=> $text
            ]);
          }
        }
      }
    }

  }





}