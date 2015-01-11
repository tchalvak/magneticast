<?php
// Functionality for dealing with the rest api part of the system


$app->get('/api/ideas/search/{term}', function($term) use ($app){
	$filtered_ideas = IdeaFactory::search($term);
	return $app->json($filtered_ideas);
});

$app->get('/api/ideas/{id}', function($id) use ($app){
	$id = (int) $id;
	if(!$id){
		return $app->json(array('success'=>'false','error'=>'No valid idea id specified'), 400);// Bad request.
	}
	$idea = IdeaFactory::idea($id);
	if(!$idea instanceof Idea){
		return $app->json(array('success'=>'false','error'=>'No idea found for that id'), 404);// Idea not found.
	}
	return $app->json($idea);
});

$app->get('/api/ideas', function() use ($app){
	$ideas = IdeaFactory::all();
	return $app->json($ideas);
});

$app->get('/api/test', function() use ($app){
	$success = array('success'=>true);
	return $app->json($success);
});

// Manually test with curl:
//curl http://localhost:7777/api/ideas -d '{"idea":"Hello World!"}' -H 'Content-Type: application/json'

$app->post('/api/ideas', function(Request $request) use ($app){
    $post = array(
        'idea' => $request->request->get('idea'),
    );
    $idea = new Idea($post['idea']);
    $idea = IdeaFactory::saveIdea($idea);
    $success = '{"success":true}';
    return $app->json($post, 201);
});

$app->get('/api/ideas', function() use ($app){
	return 'All ideas';
});

// Let's get some api call & response working up in here
$app->get('/api/{call}/{data}', function($call, $data) use ($app){
	// We can actually just pass json data encoded for the url to {data} soon.
	$response = 'Call to a api type of '.$call.' with data '.$data;

	return $response; // This will be a json response shortly.
});

