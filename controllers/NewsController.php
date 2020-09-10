<?php

namespace BIT\controllers;

use BIT\app\App;

use BIT\models\NewsPost;

use BIT\app\View;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;

class NewsController {
    
    public function index(Request $request)
    {   
        // $post;
        // var_dump($request);
        $news = NewsPost::all();
        // return view('news.index');
        // echo 'labas buliau';
        return View::adminRender('news.index', ['url' => PLUGIN_DIR_URL, 'news' => $news]);
        
    }

    public function create(Request $request)
    {
        $response = new Response;
        $response->prepare($request);
        $response->setContent(json_encode(['a' => 'jjjjjjj']));
        return $response;
    }


    public function store(Request $request)
    {   
        
        $new_news = new NewsPost();
        $new_news->news_content = $request->content;
        // $new_news->= $request->menu_surname;

        // if ($request->hasFile('photo')) {
        //     $image = $request->file('photo');
        //     $name = time().'.'.$image->getClientOriginalExtension();
        //     $destinationPath = public_path('/images');
        //     $image->move($destinationPath, $name);
        //     $menu->photo = $name;
        // }
        $new_news->save();

        // return redirect()->route('news.index'); TODO su Js
        
    }


    public function show (/*NewsPost $newsPost*/)
    {
        //persiduoti post konkretus
        // $newsPost = NewsPost::get($post_id);
        return view(); //viena tik parodyti
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