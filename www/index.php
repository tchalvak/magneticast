<?php
require_once realpath(__DIR__.'/../').'/vendor/autoload.php'; // Auto loads the dependencies, e.g. the whole of silex

// Instantiate the app
$app = new Silex\Application();

require_once realpath(__DIR__.'/../').'/config.php';
require_once ROOT.'core/core.php'; // Main includes that are used everywhere.

// Translate json appropriately.
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;
//use App\ideas; // Use the shortcut for the idea class.
//use App\ideas\IdeaFactory as IdeaFactory; // Use the shortcut for the ideafactory class.

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => ROOT.'core/views',
));

// This checks if a request is sending json, and decodes the json if possible
$app->before(function (Request $request) {
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        $data = json_decode($request->getContent(), true); // Turn request into array.
        $request->request->replace(is_array($data) ? $data : array()); // Ensure it's an array, empty if nothing else.
    }
});


// The standard simple hello world example
$app->get('/hello/{name}', function ($name) use ($app) {
  return 'Hello '.$app->escape($name);
});

// An even simpler display of the main page, complete with html in the php, ew!
$app->get('/', function() use ($app){
	// Obviously this is just an index placeholder for the main page, because the REST urls are being created first.
	return $app['twig']->render('main.twig', ['next_feature'=>'casting']);
});

$app->get('/cast/{spell}', function($spell) use ($app) {
	return '<h1>You cast '.$app->escape($spell).'</h1>';
});

include ROOT.'core/api.php'; // Include the api system.

// Aw yeah, run dat app
$app->run();