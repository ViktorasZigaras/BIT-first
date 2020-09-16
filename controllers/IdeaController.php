<?php

namespace BIT\controllers;
use BIT\app\View;
use BIT\models\IdeaPost;
use BIT\app\Query;
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
		$query = new Query;
		$idea = new IdeaPost();
		$getPostType = $query->postType('event')->postMeta('idea_content', 'meta_value')->getPost();
		var_dump($getPostType );
		//return View::render('home.ideja', []);
		return View::render('home.ideja', ['url' => PLUGIN_DIR_URL, 'ideja' => $idea]);
	}

	public function addIdea(Request $request) {
		$response = new Response;
		$output = View::render('home.ideja');
		$response->prepare($request);
		$response->setContent(json_encode(['html' => $output]));

		if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
			$data = json_decode($request->getContent(), true);
			$request->request->replace(is_array($data) ? $data : array());
		}

		$idea = new IdeaPost();
		$idea->idea_content = $request->request->get('idea');
		//$idea->save();
		
		return $response;
	}
	public function renderIdea(Response $response, IdeaPost $ideaPost) {
		$query = new Query;
		$idea = new IdeaPost();
		$getPostType = $query->postType('event')->postSort('post_date','DESC')->getPost();

		$getPostType = $query->postType('event')->postMeta('idea_content', 'meta_value')->getPost();
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