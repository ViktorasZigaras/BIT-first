<?php

// example Controller names and functions
// 'event' (key) is part of URL http://.../bebras/api/?route=event
return [
	'event' => 'EventController@index',
	'gallery' => 'GalleryController@index',

	'api-ideas' => 'IdeasController@ideasAip',

	'idea-create-front' => 'IdeaController@create',
	'idea-render-front' => 'IdeaController@render',

	'idea-render-admin' => 'IdeAdminController@render',
	'idea-edit-admin' => 'IdeAdminController@edit',
	'idea-create-admin' => 'IdeAdminController@create',
	'idea-delete-admin' => 'IdeAdminController@delete',

	'news_store' => 'NewsController@store',
	'news_update' => 'NewsController@update',
	'news_destroy' => 'NewsController@destroy',
];