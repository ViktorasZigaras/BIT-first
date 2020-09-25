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
		return View::adminRender('idejos.idejos');
	}

	public function render(Request $request, IdeaPost $idea)
	{
		$data = (IdeaPost::all())->pluck('idea_content', 'idea_like', 'post_date', 'idea_solution', 'ID')->all();

		$response = new Response;
		$output = View::adminRender('idejos.idejos');
		$response->prepare($request);
		$response->setContent(json_encode(['html' => $output, 'allData' => $data]));

		if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
			$data = json_decode($request->getContent(), true);
			$request->request->replace(is_array($data) ? $data : array());
		}
		return $response;
	}


	public function edit(Request $request, IdeaPost $idea)
	{
		if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
			$data = json_decode($request->getContent(), true);
			$request->request->replace(is_array($data) ? $data : array());
		}

		$ideaContent  = $idea->idea_content = $request->request->get('idea');
		$editId = $idea->ID = $request->request->get('editId');

		$editPost = IdeaPost::get($editId);

		$array = [];
		if(is_array($ideaContent) && count(array_filter($ideaContent)) != "" ){
			$array = $ideaContent; 
	
			$txt = '';
			foreach ($array as  $text) {
				$txt .= $text . ' ';
			}
			$editPost->idea_content = $txt;	
			$editPost->save();
		}
	//	public function delete($force_delete = false)
	}

	public function create(Request $request, IdeaPost $idea)
	{
		if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
			$data = json_decode($request->getContent(), true);
			$request->request->replace(is_array($data) ? $data : array());
		}

		$soliution  = $idea->idea_solution = $request->request->get('soliution');
		$soliutionId  = $idea->ID = $request->request->get('solutionId');

		$soliutionPost = IdeaPost::get($soliutionId);

		if(is_array($soliution) && count(array_filter($soliution)) != "" ){
			$array = $soliution; 
	
			$txt = '';
			foreach ($array as  $text) {
				$txt .= $text . ' ';
			}	
			$soliutionPost->idea_solution = $txt;
			$soliutionPost->save();
		}
	}

	public function delete(Request $request, IdeaPost $idea)
	{

		if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
			$data = json_decode($request->getContent(), true);
			$request->request->replace(is_array($data) ? $data : array());
		}

		$deleteId = $idea->ID = $request->request->get('deleteId');

		$deletePost = IdeaPost::get($deleteId);
		$deletePost->delete();
	}
}
