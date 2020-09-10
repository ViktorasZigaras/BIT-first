<?php

namespace BIT\controllers;

use BIT\app\App;
use BIT\app\View;

use Symfony\Component\HttpFoundation\Request;
use BIT\models\NewsPost;

class NewsController {
    
    public function index(Request $request)
    {   

        $news = NewsPost::all();
        View::adminRender('news.index', ['url' => PLUGIN_DIR_URL, 'news']);
        
    }

    public function create()
    {
        return view('news.create'); 
    }
    
    
    public function store(Request $request, NewsPost $newsPost)
    {   
        _dc($newsPost);
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


    public function show(NewsPost $newsPost)
    {
        //persiduoti post konkretus
        // $newsPost = NewsPost::get($post_id);
        return view(); //viena tik parodyti
    }


    public function edit(NewsPost $newsPost)
    {
        return view('news.edit'); //kaip pasiimti objekta is db su id url?
    }

    public function update(Request $request, NewsPost $newsPost)
    {   
        $newsPost->news_content = $request->content;


        // // $menu->surname = $request->surname;
        // if ($request->hasFile('photo')) {
        //     $image = $request->file('photo');
        //     $name = time().'.'.$image->getClientOriginalExtension();
        //     $destinationPath = public_path('/images');
        //     $image->move($destinationPath, $name);
        //     $menu->photo = $name;
        // }
        $newsPost->save();
        // return redirect()->route('menu.index');
        // return redirect()->route('menu.index')->with('success_message', 'Succsesfully updated.'); TODO su Js
    }


    public function destroy(NewsPost $newsPost)
    {
        // if($menu->restaurants->count()){
        //     return redirect()->route('menu.index')->with('info_message', 'Don\'t delete, there are restaurants by this menu.');;
        // }
        $newsPost->wp_delete_post($newsPost->ID);
        // return redirect()->route('menu.index');

        // return redirect()->route('menu.index')->with('success_message', 'Succesfully deleted.');
        // TODO su Js
 
    }
}