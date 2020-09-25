<?php

namespace BIT\controllers;

use BIT\app\View;
use BIT\models\IdeaPost;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IdeAdminController
{
	public function __construct()
	{
	}

	public function adminIndex()
	{
		return View::adminRender('idejos.index');
	}

	public function adminApi(Request $request, IdeaPost $idea)
	{

		$data = (IdeaPost::all())->pluck('idea_content', 'idea_like', 'post_date', 'idea_solution', 'ID')->all();

		$response = new Response;
		$output = View::adminRender('idejos.index');
		$response->prepare($request);
		$response->setContent(json_encode(['html' => $output, 'allData' => $data]));

		if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
			$data = json_decode($request->getContent(), true);
			$request->request->replace(is_array($data) ? $data : array());
		}

		// $ideaContent  = $idea->idea_content = $request->request->get('idea');
		// $editId = $idea->ID = $request->request->get('editId');
		// $soliution  = $idea->idea_solution = $request->request->get('soliution');
		// $soliutionId  = $idea->ID = $request->request->get('solutionId');
		$deleteId = $idea->ID = $request->request->get('deletedId');
		$deletePost = IdeaPost::get($deleteId);
		// var_dump($deletePost);
		// $editPost = IdeaPost::get($editId);
		// $soliutionPost = IdeaPost::get($soliutionId);

		// wp_delete_post($deleteId);
		$deletePost->save();

		// $array = [];
		// if(is_array($ideaContent) && count(array_filter($ideaContent)) != "" ){
		// 	$array = $ideaContent; 
	
		// 	$txt = '';
		// 	foreach ($array as  $text) {;
		// 		$txt .= $text . ' ';
		// 	}
		// 	$editPost->idea_content = $txt;	
		// 	$editPost->save();
		// }
		// if(is_array($soliution) && count(array_filter($soliution)) != "" ){
		// 	$array = $soliution; 
	
		// 	$txt = '';
		// 	foreach ($array as  $text) {;
		// 		$txt .= $text . ' ';
		// 	}	
		// 	$soliutionPost->idea_solution = $txt;
		// 	$soliutionPost->save();
		// }

	//	public function delete($force_delete = false)
		return $response;
	}
}
