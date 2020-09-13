<?php
namespace BIT\app\modelTraits;

trait Talbum{

    public $album_date = 'YYYY-MM_DD';
    public $album_content = '';

    /** adds tag to post type Album */
    public function addTag(string $tag) 
    {

    } 

    /** removes tag form post type Album */
    public function removeTag(string $tag) 
    {

    }

    /** returns all tags array as Iterable */
    public function getTags() 
    {
        $terms = get_terms( "hashtag", ['hide_empty' => 0,]);
    }

}