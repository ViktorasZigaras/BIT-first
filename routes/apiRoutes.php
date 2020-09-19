<?php

// example Controller names and functions
// 'event' (key) is part of URL http://.../bebras/api/?route=event
return [
    'event' => 'EventController@index',
    'gallery' => 'GalleryController@index',

    'idejos' => 'IdeasController@index',
	'idejos' => 'IdeasController@adminIndex',
	'add-idea' => 'IdeaController@addIdea',
    'ideja-json' => 'IdeaController@json',
    
    'news_store' => 'NewsController@store',
    'news_update' => 'NewsController@update',
    'news_destroy' => 'NewsController@destroy'
];