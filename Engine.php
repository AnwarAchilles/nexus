<?php


namespace Nexus;


class Engine
{
  
  public static $construct = [];

  public static $command = [];

  public static $state = [];


  public static function __callStatic( $call, $param )
  {
    
    // BUILDER SECTION
    if (str_contains($call, 'Construct')) {
      $name = Helper::indexData($param, 0, '');
      $callback = Helper::indexData($param, 1, function() {});
      
      if (str_contains($call, 'has')) {
        if (isset(self::$construct[$name])) {
          return true;
        }else {
          return false;
        }
      }
      if (str_contains($call, 'set')) {
        if (!self::hasConstruct($name)) {
          self::$construct[$name] = [
            'distribution'=> $name,
            'execution'=> $callback,
          ];
        }
      }
      if (str_contains($call, 'get')) {
        if (self::hasConstruct($name)) {
          return self::$construct[$name];
        }
      }
      if (str_contains($call, 'run')) {
        if (self::hasConstruct($name)) {
          self::$construct[$name]['execution']();

          $compiler = Compiler::bundling(self::load($name), Source::load(), Setup::load(), microtime(true));

          self::setState(
            __CLASS__.':'.$call, 
            "Success bundling '$name' in " . $compiler->time . " seconds with " . Helper::formatFileSize($compiler->size),
            "SUCCESS"
          );

          // echo $index;
          
          Setup::reset();
          Source::reset();
        }
      }
    }

    // COMMAND SECTION
    if (str_contains($call, 'Command')) {
      $args = Helper::indexData($param, 0, '');
      $callback = Helper::indexData($param, 1, function() {});

      if (str_contains($call, 'has')) {
        if (isset(self::$command[$args])) {
          return true;
        }else {
          return false;
        }
      }
      if (str_contains($call, 'set')) {
        if (!self::hasCommand($args)) {
          self::$command[$args] = [
            'argument'=> 'php ' . $_SERVER['PHP_SELF'] . ' ' . $args,
            'execution'=> $callback,
          ];
        }
      }
      if (str_contains($call, 'get')) {
        if (self::hasCommand($args)) {
          return self::$command[$args];
        }
      }
      if (str_contains($call, 'run')) {
        if (Helper::isCli()) {
          $args = Helper::argCli();
          if (Helper::verifyCli('')) {
            Helper::baseCli();
            Helper::textCli([
              "Build your own command and apps, as simple as we setup",
              "",
              "",
              "# Command Helper",
              "php ".$_SERVER['PHP_SELF']." documentation",
              "php ".$_SERVER['PHP_SELF']." upgrade",
            ]);
            return true;
          }
          if (Helper::verifyCli('upgrade')) {
            echo shell_exec("cls");
            echo shell_exec("clear");
            echo shell_exec("git -C ".__DIR__." pull origin main");
            return true;
          }
          if (Helper::verifyCli('documentation')) {
            Helper::baseCli();
            Helper::documentationCli();
            return true;
          }
          if (Helper::verifyCli($args)) {
            if (self::hasCommand($args)) {
              self::getCommand($args)['execution'] ();
            }else {
              Helper::textCli([
                "\033[01;31mNo command found with this arguments\033[0m",
                "\033[01;36mTry another command has been registered on your nexus\033[0m",
                implode("\n", array_map(function($item) { return $item['argument']; }, self::$command)),
              ]);
            }
            self::cliState();
            return true;
          }
        }
      }
    }

    // STATE SECTION
    if (str_contains($call, 'State')) {
      $type = Helper::indexData($param, 0);
      $message = Helper::indexData($param, 1, '');
      
      if (str_contains($call, 'set')) {
        $color = Helper::indexData($param, 2, 'DEFAULT');
        self::$state[] = [$type, $message, $color];
      }
      if (str_contains($call, 'get')) {
        return self::$state;
      }
      if (str_contains($call, 'color')) {
        if ($type == 'ERROR') {
          return ["\033[01;31m", "\033[0m"];
        }
        if ($type == 'SUCCESS') {
          return ["\033[01;32m", "\033[0m"];
        }
        if ($type == 'WARNING') {
          return ["\033[01;33m", "\033[0m"];
        }
        if ($type == 'INFO') {
          return ["\033[01;36m", "\033[0m"];
        }
        if ($type == 'DEBUG') {
          return ["\033[01;35m", "\033[0m"];
        }
        if ($type == 'DEFAULT') {
          return ["\033[01;34m", "\033[0m"];
        }
      }
      if (str_contains($call, 'cli')) {
        
        echo "\n";
        foreach (self::$state as $state) {
          $color_open = self::colorState($state[2])[0];
          $color_close = self::colorState($state[2])[1];

          echo $color_open . $state[1] . $color_close . "\n";
        }
        // echo "$color_open " . implode("$color_close $color_open", self::getState()) . "$color_close";
      }
    }


    // ENV shorthand
    if (str_contains($call, 'env')) {
      $name = Helper::indexData($param, 0, '');
      $callback = Helper::indexData($param, 1, false);

      if ($callback!==false) {
        self::setConstruct( $name, $callback );
        return true;
      }else {
        return self::runConstruct( $name );
      }
    }

    // CLI shorthand
    if (str_contains($call, 'cli')) {
      $args = Helper::indexData($param, 0, '');
      $callback = Helper::indexData($param, 1, false);
      
      if ($callback!==false) {
        self::setCommand( $args, $callback );
        return true;
      }else {
        return self::getCommand( $args );
      }
    }

    if (str_contains($call, 'serve')) {
      self::runCommand();
    }

    if (str_contains($call, 'observer')) {
      $target = Helper::indexData($param, 0, '');
      $arguments = Helper::indexData($param, 1, ['']);

      $targetPath = Helper::cleanPath(Setup::getBase('DIR') . $target);

      $lastModifiedTime = Helper::isModified( $targetPath );

      $state = true;
      
      Helper::watchCli();
      $loading = 1;
      
      while ($state) {
        
        $currentModifiedTime = Helper::isModified( $targetPath );
        if ($currentModifiedTime != $lastModifiedTime) {
          $lastModifiedTime = $currentModifiedTime;
          foreach ($arguments as $arg) {
            echo shell_exec($arg);
          }
          sleep(1);
          Helper::watchCli();
        }
        
        if ($loading==5) {
          Helper::watchCli();
          $loading = 0;
        }else {
          $loading++;
          echo " \033[01;36m.\033[0m ";
        }

        sleep(1);
      }
    }
  }


  public static function load($name)
  {
    return [
      'construct'=> self::$construct[$name],
    ];
  }

  public static function reset()
  {
    self::$construct = [];
  }

}