<?php

namespace BIT\controllers;
use BIT\app\View;
use BIT\models\IdeaPost;
use BIT\app\Query;
use BIT\app\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class IdeaController {
	public function __construct() {

	}

	public function frontIndex() {
		return View::render('home.ideja');
	}

	public function addIdea(Request $request, IdeaPost $idea) {
	
		$data = IdeaPost::all(['idea_content', 'idea_like', 'post_date', 'ID']);

		$response = new Response;
<<<<<<< HEAD
		$output = View::render('home.ideja', );
=======
		$output = View::render('home.ideja');
>>>>>>> 33a7015f5af261d7917c0ef9fc27d7c69e795588
		$response->prepare($request);
		$response->setContent(json_encode(['html' => $output, 'allData' => $data]));

		if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
			$data = json_decode($request->getContent(), true);
			$request->request->replace(is_array($data) ? $data : array());
		}

		$array  = $idea->idea_content = $request->request->get('idea');
		$like  = $idea->idea_like = $request->request->get('idea_like');

		if(is_array($array) && count(array_filter($array)) != "" ){
			$txt = '';
			foreach ($array as  $text) {;
				$txt .=$text . ' ';			
			}
			$idea->idea_content = $txt;	
			$idea->save();
		}
		if($like){
			Cookie::ideaCookie($like);

			$ideaLike = IdeaPost::get($like);				
			$ideaLike ->idea_like = $ideaLike->idea_like+1;
			$ideaLike->save();
		}		

		return $response;
	}
}