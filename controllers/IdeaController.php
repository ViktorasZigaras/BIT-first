<?php

namespace BIT\controllers;
use BIT\app\View;
use BIT\models\IdeaPost;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IdeaController {
	public function __construct() {
		// $this->data = IdeaPost::all();
		// IdeaPost::get($post_id);
		// IdeaPost::all()

		// $kazkas = new IdeaPost();
		// $kazkas->idea_content = ‘bla bla’;
		// $kazkas->idea_like = 2;        (int)
		// $kazkas->save();

		// $kazkas = IdeaPost::get($post_id);
		// $kazkas->idea_content = ‘bla bla’;
		// $kazkas->idea_like = 2;       (int)
		// $kazkas->save();
	}

	public function frontIndex() {

		//    echo '<pre>';
		//    var_dump( $this->request);
		// $content = $this->request->content;
		return View::render('home.ideja', []);
	}

	public function addIdea(Request $request) {
		$response = new Response;
		// echo '<pre>';
		// var_dump($request);
		$output = View::render('home.ideja');
		$response->prepare($request);
		$response->setContent(json_encode(['html' => $output]));

		if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
			$data = json_decode($request->getContent(), true);
			$request->request->replace(is_array($data) ? $data : array());
		}
		
		$idea = new IdeaPost();
		//$idea->idea_content = 'aaaaaaaaaaaaaaaaaaaaaaaaaa,  ddddddddddddddddddd, ddddddddddddddddddddddddddd, dddddddddddddddd';
		$idea->idea_content = $request->request->get('idea');
		//$idea->idea_content = $request->request->get('idea')[0];
		//$request = json_decode($request->getContent(), true);
		// $parametersAsArray = [];
		// if ($content = $request->getContent()) {
		// 	$parametersAsArray = json_decode($content, true);
		// }
		
		//$a = $request->getContent();
		//$a = $$idea->idea_content = $request->query->get('idea');

		//echo '<pre>';
		
		//$a =  $parametersAsArray[0]['idea'];
		//var_dump($a);
		$idea->save();
		return $response;
	}
	public function store(Request $request, IdeaPost $ideaPost) {
		$idea = new IdeaPost();
		$idea->idea_content = $request->request->get('idea');
		$idea->save();
	}

	// function frontIndex() {
	//  var_dump($this->request);
	//  // echo '<pre>';
	//  // var_dump($this->request);
	//  $output = View::render('home.ideja');
	//  $this->response->prepare($this->request);
	//  $this->response->setContent(json_encode(['html' => $output]));
	//  //var_dump($this->request->query->get('route'));
	//  return $this->response;
	//  //http://localhost/wordpress/wp-content/plugins/BIT-first/api/?route=event
	// }
	//}

// function frontIndex(Request $request) {
	// 	var_dump($request);
	// $response = new Response;
	// // echo '<pre>';
	// // var_dump($request);
	// $output = View::render('home.ideja');
	// $response->prepare($request);
	// $response->setContent(json_encode(['html' => $output]));
	// //var_dump($request->query->get('route'));
	// return $response;
	//http://localhost/wordpress/wp-content/plugins/BIT-first/api/?route=event
}