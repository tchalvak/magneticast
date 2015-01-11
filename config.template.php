<?php

// Environment specific configuration

define('ROOT', __DIR__.'/'); // The directory of magneticast, whereever you're keeping it, feel free to hardcode this if you like
define('BASE_URL', ('http://'.(isset($_SERVER['HTTP_HOST'])? $_SERVER['HTTP_HOST'] : 'localhost:7777').'/')); // The domain url of magneticast, e.g. http://localhost:7777/ during dev

$app['debug'] = true; // For debugging, in development only.
ini_set('display_errors', 1);
