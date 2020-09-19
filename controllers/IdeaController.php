<?php

namespace BIT\controllers;
use BIT\app\View;
use BIT\models\IdeaPost;
use BIT\app\Query;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IdeaController {
	public function __construct() {

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
			$text[] .= $value->idea_content;
			$like[] .= $value->idea_like;
			$post_date[] .=  $value->post_date;
			
		}
		foreach($text as $key1 => $value1 ){
			foreach($like as $key2 => $value2 ){
				foreach($post_date as $key3 => $value3 ){
					if($key1 == $key2 && $key2 == $key3){
						$data[] = $text[$key1];
						$data[] = $like[$key2];
						$data[] = $post_date[$key3];
					}
				}
			}
		}
		$data = array_chunk($data,3);
		
		$response = new Response;
		$output = View::render('home.ideja',);
		$response->prepare($request);
		$response->setContent(json_encode(['html' => $output, 'allData' => $data ] ));

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
			$idea->save();
		}		
		return $response;
	}
}