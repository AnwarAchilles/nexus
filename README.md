
# Nexus - Toolkit PHP to bundling All Source to SPA

The concept is to wrap all HTML, CSS, JS, PHP into 1 PHP file only, very useful for the construction of simple 1 file tools without conflict.

version 2 - Beta

## How To Use

#### Step - 1
Load this file to your local by using
```bash
cd {YOUR_PROJECT_DIRECTORY}
git clone https://github.com/AnwarAchilles/nexus.git
```


#### Step - 2
First create a nexus.php for the development environment.
optional after you clear editing you can remove .php extension
our goal is to set all of the src/ to single file index.php

```markup
┣━ nexus/
┃   ┣━ <all nexus file should be here>
┣━ src/
┃   ┣━ index.php
┃   ┣━ index.head.html
┃   ┣━ index.html
┃   ┣━ index.css
┃   ┣━ index.js
┣━ nexus.php

```

#### Step - 3

nexus.php file, and then enter the following code.

the basic to test nexus is ready, use this code.
```php
<?php
// load nexus
require_once __DIR__ . '/nexus/autoload.php';
// run nexus
Nexus\Engine::serve();
```

then run this command.
```bash
php nexus.php example
```


or you can use this, for continue step 2
```php
<?php

// load nexus
require_once __DIR__ . '/nexus/autoload.php';

// set base working directory.
Nexus\Setup::base('DIR', __DIR__);

// set environment partially.
Nexus\Engine::env('/index.php', function() {
  // Re:Setup environment.
  Nexus\Setup::env('TYPE', 'class');
  // set source code.
  Nexus\Source::code('/src/index.head.html'); // specialy for head html
  Nexus\Source::code('/src/index.html');
  Nexus\Source::code('/src/index.css');
  Nexus\Source::code('/src/index.js');
  Nexus\Source::code('/src/index.php');
});

// set build cli triggering.
Nexus\Engine::cli('build', function() {
  Nexus\Engine::env('/dist/index.php');
});

// set server localhost
Nexus\Engine::cli('serve', function() {
  Nexus\Engine::localhost(8000);
});

// set watch build in nexus observer.
Nexus\Engine::cli('watch', function() {
  Nexus\Engine::observer('/src/', [
    Nexus\Engine::cli('build')->argument
  ]);
});

// shorthand cli start
Nexus\Engine::cli('start', function() {
  Nexus\Engine::window([
    Nexus\Engine::cli('serve')->argument,
    Nexus\Engine::cli('watch')->argument
  ]);
});

// run nexus.
Nexus\Engine::serve();
```
you will have 2 command 'build' and 'watch'


#### Step - 4

There is already a watch mode for browsers by simply opening {YOUR_PROJECT}/nexus.php,
to use is open a browser and open your local development to enter watch mode, open the nexus.php

You can also do it like this with the command line.
```bash
cd {YOUR_PROJECT_DIRECTORY}
php nexus.php
```

#
[![portfolio](https://ik.imagekit.io/anwarachilles/devneet-powered.svg?updatedAt=1704715329026)]('#')