
# Nexus - Toolkit PHP to bundling All Source to SPA

The concept is to wrap all HTML, CSS, JS, PHP into 1 PHP file only, very useful for the construction of simple 1 file tools without conflict.

version - Beta

## How To Use

#### Step - 1
Load this file to your local by using
```bash
git clone https://github.com/AnwarAchilles/nexus.git
```

#### Step - 2
First create a src/ folder to hold the source files
After that create a Nexus file.php for the development environment.
optional after you clear editing you can remove .php extension

```markup
┣━ nexus/
┃   ┣━ <all nexus file should be here>
┣━ src/
┃   ┣━ index.php
┃   ┣━ index.html
┃   ┣━ index.css
┃   ┣━ index.js
┣━ nexus.php

```

#### Step - 3

nexus.php file, and then enter the following code.

the basic is like this
```php
<?php
// load nexus
require_once __DIR__ . '/nexus/autoload.php';
// run nexus
Nexus\Engine::serve();
```

or you can use this
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
  Nexus\Source::code('/src/index.html');
  Nexus\Source::code('/src/index.css');
  Nexus\Source::code('/src/index.js');
  Nexus\Source::code('/src/index.php');
});
// set build cli triggering.
Nexus\Engine::cli('build', function() {
  Nexus\Engine::env('/index.php');
});

// set watch build in nexus observer.
Nexus\Engine::cli('watch', function() {
  // listing all cli on observer.
  Nexus\Engine::observer('/src/', [
    Nexus\Engine::cli('build') ['argument']
  ]);
});

// run nexus
Nexus\Engine::serve();
```

#### Step - 4

There is already a watch mode for browsers by simply opening <your project>/nexus.php,
to use is open a browser and open your local development to enter watch mode, open the nexus.php

You can also do it like this with the command line.
```bash
cd <your project folder>

$php nexus.php
```

#
[![portfolio](https://ik.imagekit.io/anwarachilles/devneet-powered.svg?updatedAt=1704715329026)]('#')