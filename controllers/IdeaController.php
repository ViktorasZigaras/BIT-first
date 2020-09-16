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
		return View::render('home.ideja', []);
	}

	public function addIdea(Request $request) {
		$idea = new IdeaPost();

		$response = new Response;
		$output = View::render('home.ideja');
		$response->prepare($request);
		$response->setContent(json_encode(['html' => $output]));

		if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
			$data = json_decode($request->getContent(), true);
			$request->request->replace(is_array($data) ? $data : array());
		}

		$array  = $idea->idea_content = $request->request->get('idea');

		if(count(array_filter($array)) != ""){
			var_dump($array );
			$txt = '';
			foreach ($array as $key => $text) {;
				$txt .=$text . ' ';			
			}
			$idea->idea_content = $txt;	
			$idea->save();
		}else{
			echo 'negautas array';
		}

		
		return $response;
	}
	public function json(Response $response, IdeaPost $ideaPost) {
		$query = new Query;
		$getPostType = $query->postType('idea')->getPost();
		$response->setContent(json_encode(['$getPostType'] ));
		//$query = new Query;
		// $idea = new IdeaPost();
		// $getPostType = $query->postType('event')->postSort('post_date','DESC')->getPost();

		// $getPostType = $query->postType('event')->postMeta('idea_content', 'meta_value')->getPost();
		return $response;
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