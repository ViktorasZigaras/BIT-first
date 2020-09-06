<?php

namespace BIT\app;


class Post{

    protected $ID;
    // combines meta ant post tables
    public function __construct($postID = 0){
        
        if(!$postID === 0){
            foreach ( get_object_vars(new \WP_Post(null)) as $var => $value ) {
            $this->$var = $value; 
            }
        }
        elseif($postID >0){
            foreach ( get_object_vars(get_post($postID)) as $var => $value ) {
                $this->$var = $value; 
            }
            foreach ( get_post_meta($postID) as $var => $value ) {
                $this->$var = $value[0]; 
            }
        }
    }

    // returns Post object with common post and meta fields
    public static function get($post_id) :Post{
        $post_id = (int) $post_id;
		if ( !$post_id || !get_post($post_id) ){
            return null;
        }
        return new static($post_id);
    }

    // returns all Post object by type
    public static function all() :array{
        $list =[];
        foreach (get_posts(['posts_per_page' => -1, 'post_type' => static::$type]) as $post) {
            $list[$post->ID] = static::get($post->ID);
        }
        return $list;
    }
    
    // inserts or updates new object to DB 
    public function save(){
        $metaVars = []; 
        foreach(get_object_vars($this) as $var => $value){
            if( ($value) && (! array_key_exists($var, get_object_vars( new \WP_Post(null) )))){
                $metaVars[$var] = $value;
            } 
        }
        $post = (array)$this;
        $post['meta_input'] = $metaVars;

        if(isset($this->ID)){
            wp_update_post($post);
        }
        else{
            wp_insert_post($post);
        }
    }

    //returns objects ID (protected)
    public function __get($prop){
        if('ID' == $prop){
            return $this->ID;
        }
        return null;
    }




}

