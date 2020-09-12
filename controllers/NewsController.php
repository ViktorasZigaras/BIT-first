<?php

namespace BIT\controllers;

use BIT\app\App;

use BIT\app\View;

use BIT\models\NewsPost;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;

class NewsController {
    
    public function index(/*Request $request*/) 
    {   
        $news = NewsPost::all();

        // return view('news.index');
        // echo 'labas buliau';
        return View::adminRender('news.index', ['url' => PLUGIN_DIR_URL, 'news' => $news]);

    }

    public function create(Request $request){}
    
    
    public function store(Request $request, NewsPost $newsPost)
    {   
        $new_news = new NewsPost();
        // $new_news->news_content = $request->getContent();

        
        $new_news->news_content = 'hey';
        print_r($new_news);
        $new_news->save();

        $response = new Response;
        $response->prepare($request);
        // $response->setContent(json_encode(['a' => $request->getContent()]));
        // $response->setContent(json_encode(['a' => $request]));
        $response->setContent(json_encode(['html' => $this->index()]));
        return $response;
    }


    public function show (/*NewsPost $newsPost*/)
    {
       
    }


    public function edit (/*NewsPost $newsPost*/)
    {
        return view('news.edit'); //kaip pasiimti objekta is db su id url?
    }

    public function update(Request $request/*, NewsPost $newsPost*/)
    {   
        $newsPost->news_content = $request->content;

    
        $newsPost->save();

        return 'labas';
        


        // return redirect()->route('menu.index')->with('success_message', 'Succsesfully updated.'); TODO su Js
    }


    public function destroy(/*NewsPost $newsPost*/)
    {
        // if($menu->restaurants->count()){
        //     return redirect()->route('menu.index')->with('info_message', 'Don\'t delete, there are restaurants by this menu.');;
        // }
        // $newsPost->wp_delete_post($newsPost->ID);
        // return redirect()->route('menu.index');

        // return redirect()->route('menu.index')->with('success_message', 'Succesfully deleted.');
        // TODO su Js
 
    }
}