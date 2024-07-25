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
          self::$construct[$name] = new Construct([
            'distribute'=> $name,
            'execute'=> $callback,
          ]);
          // self::$construct[$name] = [
          //   'distribution'=> $name,
          //   'execution'=> $callback,
          // ];
        }
      }
      if (str_contains($call, 'get')) {
        if (self::hasConstruct($name)) {
          return self::$construct[$name];
        }
      }
      if (str_contains($call, 'run')) {
        if (self::hasConstruct($name)) {
          self::$construct[$name]->run();

          $compiler = Compiler::bundling(self::load($name), Source::load(), Setup::load(), microtime(true));

          self::setState(
            __CLASS__.':'.$call, 
            "Success bundling '$name' in " . $compiler->time . "s with " . Helper::formatFileSize($compiler->size),
            "SUCCESS"
          );
          
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
          self::$command[$args] = new Command([
            'argument'=> 'php ' . $_SERVER['PHP_SELF'] . ' ' . $args,
            'execute'=> $callback,
          ]);
          // self::$command[$args] = [
          //   'argument'=> 'php ' . $_SERVER['PHP_SELF'] . ' ' . $args,
          //   'execution'=> $callback,
          // ];
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
              "The concept is to wrap all HTML, CSS, JS, PHP into 1 PHP file only, \n very useful for the construction of simple 1 file tools without conflict.",
              "",
              "# Command Registered",
              implode("\n", array_map(function($item) { return $item->argument; }, self::$command)),
              "",
              "# Command Helper",
              "php ".$_SERVER['PHP_SELF']." example",
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
          if (Helper::verifyCli('example')) {
            $user = getcwd();
            $example = __DIR__ . '\\example';
            copy($example.'\\nexus.php', $user.'\\nexus.php');
            if (!file_exists($user.'\\src\\')) {
              mkdir($user.'\\src\\', 777);
            }
            copy($example.'\\src\\index.php', $user.'\\src\\index.php');
            copy($example.'\\src\\index.html', $user.'\\src\\index.html');
            copy($example.'\\src\\index.css', $user.'\\src\\index.css');
            copy($example.'\\src\\index.js', $user.'\\src\\index.js');
            copy($example.'\\src\\index.head.html', $user.'\\src\\index.head.html');
            return true;
          }
          if (Helper::verifyCli($args)) {
            if (self::hasCommand($args)) {
              self::getCommand($args)->run();
            }else {
              Helper::textCli([
                "\033[01;31mNo command found with this arguments\033[0m",
                "\033[01;36mTry another command has been registered on your nexus\033[0m",
                implode("\n", array_map(function($item) { return $item->argument; }, self::$command)),
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
  }

  public static function env( $name, $callback=false )
  {
    if ($callback!==false) {
      self::setConstruct( $name, $callback );
      return true;
    }else {
      return self::runConstruct( $name );
    }
  }

  public static function cli( $args, $callback=false )
  {
    if ($callback!==false) {
      self::setCommand( $args, $callback );
      return true;
    }else {
      return self::getCommand( $args );
    }
  }

  public static function serve()
  {
    self::runCommand();
  }

  public static function window( $engine ) {
    shell_exec(implode(" & ", array_map(function($item) {
      return "start cmd /k " . $item;
    }, $engine)));
  }

  public static function localhost($port, $location='') {
    if (!empty($location)) {
      return shell_exec("php -S localhost:" . $port . " " . $location);
    }else {
      return shell_exec("php -S localhost:" . $port);
    }
  }

  public static function observer($target, $arguments=[])
  {
    $targetPath = Helper::cleanPath(Setup::getBase('DIR') . $target);
    $lastModifiedTime = Helper::isModified($targetPath);

    $state = true;

    Helper::watchCli();
    $loading = 1;

    // Interval untuk pemeriksaan dalam detik
    $interval = 3;

    while ($state) {
        $currentModifiedTime = Helper::isModified($targetPath);
        if ($currentModifiedTime != $lastModifiedTime) {
            $lastModifiedTime = $currentModifiedTime;

            echo shell_exec(implode(" & ", array_map(function($item) {
                return $item;
            }, $arguments)));

            // Helper::watchCli();
        }

        // if ($loading == 5) {
        //     Helper::watchCli();
        //     $loading = 0;
        // } else {
        //     $loading++;
        //     echo " \033[01;36m.\033[0m ";
        // }

        sleep($interval);
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