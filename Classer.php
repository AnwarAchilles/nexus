<?php

namespace Nexus;

class Construct {
  public $distribute = '';
  public $execute = '';

  public function __construct( $setup ) {
    $this->distribute = $setup['distribute'];
    $this->execute = $setup['execute'];
  }

  public function run() {
    $funct = $this->execute;
    $funct();
  }

}


class Command {
  public $argument = '';
  public $execute = '';
  
  public function __construct( $setup ) {
    $this->argument = $setup['argument'];
    $this->execute = $setup['execute'];
  }

  public function run() {
    $funct = $this->execute;
    $funct();
  }
}