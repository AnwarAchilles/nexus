
# Nexus - PHP, HTML, CSS, JS to (SPA)

The concept is to wrap all HTML, CSS, JS, PHP into 1 PHP file only, very useful for the construction of simple 1 file tools without conflict.

version - Beta

## How To Use

#### Step - 1
First move all these git files into the nexus/ folder
Then create a src/ folder to hold the source files
After that create a Nexus file.php for the development environment.

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

#### Step - 2

nexus.php file, and then enter the following code.

```php
<?php

// load nexus 
require_once __DIR__."/nexus/autoload.php";

// set environment base
Nexus\Engine::$BASEDIR = __DIR__;
Nexus\Engine::$BASEURL = "http://localhost/<project>";

// set all source
Nexus\Source::php("/src/index");
Nexus\Source::html("/src/index");
Nexus\Source::css("/src/index");
Nexus\Source::js("/src/index");

// for multiple file
// Nexus\Source::php( file1, file2 file3 );

// set distribution file and setup
Nexus\Engine::build("/dist/index", "class"); // 'class' | 'plate'
Nexus\Engine::watch("/src/"); // use this if you want watch mode
```

#### Step - 3

There is already a watch mode for browsers by simply opening <your project>/nexus.php,
to use is open a browser and open your local development to enter watch mode, open the nexus.php

You can also build and watch with the command line, like this.
```bash

cd <your project folder>

$php nexus.php build

$php nexus.php watch

```



[![portfolio](https://ik.imagekit.io/anwarachilles/devneet-powered.svg?updatedAt=1704389411574)]('#')