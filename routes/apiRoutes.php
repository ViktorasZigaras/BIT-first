<?php

// example Controller names and functions
// 'event' (key) is part of URL http://.../bebras/api/?route=event
return [
	'event' => 'EventController@index',
	'gallery' => 'GalleryController@index',

	'api-ideas' => 'IdeasController@ideasAip',
	'add-idea' => 'IdeaController@addIdea',

	'idea-render' => 'IdeAdminController@render',
	'idea-edit' => 'IdeAdminController@edit',
	'idea-create' => 'IdeAdminController@create',
	'idea-delete' => 'IdeAdminController@delete',

	'news_store' => 'NewsController@store',
	'news_update' => 'NewsController@update',
	'news_destroy' => 'NewsController@destroy',
];