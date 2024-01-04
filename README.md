
# Nexus - PHP builder to (SPA)

The concept is to wrap all HTML, CSS, JS, PHP into 1 PHP file only, very useful for the construction of simple 1 file tools without conflict.
## How To Use

Create a nexus.php file, and then enter the following code.

```php
<?php
// file: nexus.php

require_once __DIR__."/autoload.php";

Nexus\Engine::$BASEDIR = __DIR__;
Nexus\Engine::$BASEURL = "http://localhost/<project>";

Nexus\Source::php("/src/index");
Nexus\Source::html("/src/index");
Nexus\Source::css("/src/index");
Nexus\Source::js("/src/index");

Nexus\Engine::build("/dist/index", "class");
Nexus\Engine::watch("/src/");
```

After that open a browser and open your local development to enter watch mode, open the nexus nexus.php