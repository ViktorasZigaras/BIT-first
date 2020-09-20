<?php

namespace BIT\controllers;
use BIT\app\View;
use BIT\models\IdeaPost;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use BIT\app\Cookie;

class IdeaController {
	public function __construct() {

	}

	public function frontIndex() {
		return View::render('home.ideja', []);
	}

	public function addIdea(Request $request, IdeaPost $idea) {

		$getPosts = IdeaPost::all();

		$text = [];
		$like = [];
		$post_date = [];
		$post_id = [];
		$data = [];
		foreach ($getPosts as $value) {
			$text[] .= $value->idea_content;
			$like[] .= $value->idea_like;
			$post_date[] .= $value->post_date;
			$post_id[] .= $value->ID;
		}
		foreach ($text as $key1 => $value1) {
			foreach ($like as $key2 => $value2) {
				foreach ($post_date as $key3 => $value3) {
					foreach ($post_id as $key4 => $value4) {
						if ($key1 == $key2 && $key2 == $key3 && $key3 == $key4) {
							$data[] = $text[$key1];
							$data[] = $like[$key2];
							$data[] = $post_date[$key3];
							$data[] = $post_id[$key4];
						}
					}
				}
			}
		}

		$data = array_chunk($data, 4);
		//var_dump($data);
		$response = new Response;
		$output = View::render('home.ideja', );
		$response->prepare($request);
		$response->setContent(json_encode(['html' => $output, 'allData' => $data]));

		if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
			$data = json_decode($request->getContent(), true);
			$request->request->replace(is_array($data) ? $data : array());
		}

		$array = $idea->idea_content = $request->request->get('idea');
		$like = $idea->idea_like = $request->request->get('idea_like');

		$txt = '';
		if (count(array_filter($array)) != "") {
			foreach ($array as $text) {
				;
				$txt .= $text . ' ';
			}
			$idea->idea_content = $txt;
			//$idea->save();
		}
		if($like){
			foreach($_COOKIE as $cookie){

				if( $_COOKIE["Idea_cookie"] != $like){	
							
					Cookie::ideaCookies($like);
					$newLike = IdeaPost::get($like);
					$oldLike = $newLike->idea_like;
					$newLike->idea_like =$oldLike+1;
					$newLike->save();
					break;
				}
			}
		}

		//var_dump($idea);
		return $response;
	}
}