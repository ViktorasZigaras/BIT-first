<?php

namespace BIT\controllers;

use BIT\app\View;
use BIT\models\IdeaPost;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IdeasController {
	public function __construct() {
	}

	public function index() {
		return View::render('ideas.idejos', []);
	}

	// public function index(Request $request) {
	// 	// echo '<pre>';
	// 	// var_dump($request);
	// 	$idea = IdeaPost::all();
	// 	return View::render('home.idea', ['url' => PLUGIN_DIR_URL, 'idea' => $idea]);
	// }
	public function create(Request $request) {
		$response = new Response;
		$response->prepare($request);
		$response->setContent(json_encode(['a' => 'jjjjjjj']));
		var_dump($response);
		return $response;
	}
	public function store(Request $request, IdeaPost $ideaPost) {
		$idea = new IdeaPost();
		$idea->idea_content = $request->idea;
		$idea->save();
	}
	function adminIndex(Request $request) {
		$response = new Response;
		// echo '<pre>';
		// var_dump($request);
		$output = View::adminRender('idea.index');
		$response->prepare($request);
		$response->setContent(json_encode(['html' => $output]));
		//var_dump($request->query->get('route'));
		return $response;
		//http://localhost/wordpress/wp-content/plugins/BIT-first/api/?route=event
	}
}
