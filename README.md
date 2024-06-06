
# Nexus - Toolkit PHP to bundling All Source to SPA

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
// prepare v2
```

#### Step - 3

There is already a watch mode for browsers by simply opening <your project>/nexus.php,
to use is open a browser and open your local development to enter watch mode, open the nexus.php

You can also build and watch with the command line, like this.
```bash
cd <your project folder>

$php nexus.php
```

#
[![portfolio](https://ik.imagekit.io/anwarachilles/devneet-powered.svg?updatedAt=1704715329026)]('#')