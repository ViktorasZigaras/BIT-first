<?php

require __DIR__ . '/app/Post.php';
require __DIR__ . '/app/Config.php';

class Query{

    public function getPost()
    {
        $args = array(
            'post_type'=> 'events',
        );              
        
        $wp_query = new WP_Query( $args );
        if($wp_query->have_posts() ) : 
            while ( $wp_query->have_posts() ) : 
               $wp_query->the_post(); 
               $id = get_the_id();
            endwhile; 
            wp_reset_postdata(); 
        else: 
        endif;
    }
}