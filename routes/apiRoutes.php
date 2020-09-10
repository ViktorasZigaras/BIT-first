<?php

// example Controller names and functions
// 'event' (key) is part of URL http://.../bebras/api/?route=event
return [
    'event' => 'EventController@index',
    'gallery' => 'GalleryController@index',
    
    // 'news' => 'NewsController@testing',
    'news_create' => 'NewsController@create',
    'news_update' => 'NewsController@update',
    'news_destroy' => 'NewsController@destroy'
];