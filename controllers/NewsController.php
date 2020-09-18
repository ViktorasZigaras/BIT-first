<?php

namespace BIT\controllers;

use BIT\app\App;

use BIT\app\View;

use BIT\models\NewsPost;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;

class NewsController {
    
    public function index() 
    {   
        $news = NewsPost::all();

        return View::adminRender('news.index', ['url' => PLUGIN_DIR_URL, 'news' => $news]);
    }

    public function create(Request $request){}
    
    
    public function store(Request $request, NewsPost $newsPost)
    {   
        $new_news = new NewsPost();
        $new_news->news_content = $request->request->get('news-content');
        $new_news->save();

        $response = new Response;
        $response->prepare($request);
        $response->setContent(json_encode(['html' => $this->index()]));
        return $response;

        var_dump($response);
    }


    public function show (){}

    public function edit (){}

    public function update(Request $request, NewsPost $newsPost)
    {   
        $new_news->news_content = $request->get('news-content');
        
        $newsPost->save();

        $news = NewsPost::all();

        $response = new Response;
        $response->prepare($request);
        $response->setContent(json_encode(['list' => 'hello']));
        // $response->setContent(json_encode(['list' => View::adminRender('news.list', ['news' => $news])]));
        return $response;
    }


    public function destroy(Request $request, NewsPost $newsPost)
    {   
        $newsPost->delete();

        $news = NewsPost::all();

        $response = new Response;
        $response->prepare($request);
        $response->setContent(json_encode(['list' => 'hello']));
        // $response->setContent(json_encode(['list' => View::adminRender('news.list', ['news' => $news])]));
        return $response;
 
    }
}