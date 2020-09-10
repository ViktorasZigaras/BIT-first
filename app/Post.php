<?php
namespace BIT\app;

use BIT\app\coreExeptions\wrongArgsTypeExeption;

class Post{

    private $ID;
    protected static $type = 'post';
    // combines meta ant post tables
    public function __construct($post_id = 0){
        if($post_id == 0){
            foreach ( get_object_vars( new \WP_Post(new \stdClass())) as $var => $value ) {
                $this->$var = $value; 
                
            }
            if(isset(static::$type)) $this->post_type = static::$type;
        }
        elseif($post_id >0){
            foreach ( get_object_vars(get_post($post_id)) as $var => $value ) {
                $this->$var = $value; 
            }
            foreach ( get_post_meta($post_id) as $var => $value ) {
                $this->$var = $value[0]; 
            }
        }
    }

    // returns Post object with common post and meta fields
    public static function get($post_id = 0) :Post{
        $post_id = (int) $post_id;

        if(0 === $post_id || !get_post_status($post_id)){
            return new static();
        } 

		if ( $post_id<0 || (strcmp(get_post($post_id)->post_type, static::$type )!=0) ){
            throw new wrongArgsTypeExeption('Wrong $post_id args passed to Post::get($post_id)');
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
            if(! array_key_exists($var, get_object_vars( new \WP_Post(new \stdClass()) ))){
                $metaVars[$var] = $value;
            } 
        }
        $post = (array)$this;
        $post['ID'] = $this->ID;
        $post['meta_input'] = $metaVars;

        if(isset($this->ID)){
            // add_action('init', function() use($post){
            //     wp_update_post($post);
            // });
            wp_update_post($post);
        }
        else{
            // add_action('init', function() use($post){
            //     wp_insert_post($post);
            // });
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

