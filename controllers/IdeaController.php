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
		$getPosts = IdeaPost::all();

		$text = [];
		$like = [];
		$post_date = [];
		$data = [];
		foreach($getPosts as $key => $value){
			//var_dump($value->idea_content);
			$text[] .= $value->idea_content;
			$like[] .= $value->idea_like;
			$post_date[] .=  $value->post_date;

		//	var_dump($text);

			// if($text[$key] == $like[$key] &&  $like[$key] == $post_date[$key] ){
			// 	$data = $text + $like + $post_date ;

			// }
			
		}
		// foreach($text as $key1 => $value1 ){
		// 	foreach($like as $key2 => $value2 ){
		// 		foreach($post_date as $key3 => $value3 ){
		// 			if($key1 == $key2 && $key2 == $key3){
		// 				$data =( $text+$like+$post_date);
		// 				//$data[] =( 'content '.$text[$key1].' like '.$like[$key2].' date '.$post_date[$key3]);
						
		// 			}
		// 		}
		// 	}
		// }
		
		// var_dump( $data);
		

		$response = new Response;
		$output = View::render('home.ideja',);
		$response->prepare($request);
		$response->setContent(json_encode(['html' => $output, 'text' => $text, 'like' => $like, 'date' => $post_date ] ));

		if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
			$data = json_decode($request->getContent(), true);
			$request->request->replace(is_array($data) ? $data : array());
		}

		$array  = $idea->idea_content = $request->request->get('idea');

		if(count(array_filter($array)) != ""){
			var_dump($array );
			$txt = '';
			foreach ($array as  $text) {;
				$txt .=$text . ' ';			
			}
			$idea->idea_content = $txt;	
			//$idea->save();
		}		
		return $response;
	}
	public function json(Request $request, Response $response) {
		$query = new Query;
		$getPostType = $query->postType('idea')->getPost();

		$response = new Response;
		$output = View::render('home.ideja',);
		$response->prepare($request);
		$response->setContent(json_encode(['html' => $output, 'html' => $getPostType]));
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