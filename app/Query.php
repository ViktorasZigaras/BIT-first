<?php

require __DIR__ . '/app/Post.php';
require __DIR__ . '/app/Config.php';
use WP_Query;

class Query{
    public function postType($post_type)
    {
        $this->args['post_type'] = $post_type;
        return $this;
    }
    public function getPost()
    {
        $wp_query = new WP_Query( $this->args );
        if($wp_query->have_posts() ) : 
            while ( $wp_query->have_posts() ) : 
               $wp_query->the_post(); 
               $id = get_the_id();
               $newPostObj = Post::get($id);
               var_dump($newPostObj);
            endwhile; 
            wp_reset_postdata(); 
        else: 
        endif;
    }
}