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
		return View::render('ideas.idejos');
	}

	public function ideasAip(Request $request, IdeaPost $idea) {

		$data = IdeaPost::all(['idea_content', 'idea_like', 'post_date', 'idea_solution', 'ID']);
// var_dump($data);
		$response = new Response;
		$output = View::render('ideas.idejos');
		$response->prepare($request);
		$response->setContent(json_encode(['html' => $output, 'allData' => $data] ));

		return $response;
	}
}
