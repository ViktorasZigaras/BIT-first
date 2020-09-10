<?php

namespace BIT\app;
// use BIT\app\Config;
use BIT\app\Post;
use WP_Query;
include_once(ABSPATH . 'wp-includes/pluggable.php');
//ar reikia sito?

class Query{
    public function postType($post_type)
    {
        $this->args['post_type'] = $post_type;
        return $this;
    }

    public function postTitle($post_title)
    {
        $this->args['post_title'] = $post_title;
        return $this;
    }

    public function getPost()
    {
        //naudodami WP_query gauname postus pagal mums reikalingus parametrus. Paramentai nurodyti funkcijose aukščiau - postType, postTitle. KOnkrečius paramentrus (posto tipą, pavadinimą ir kt. nurodome kviesdami funckcija)
        //Thanks to WP_Query Class, WordPress gives us access to the database quickly (no need to get our hands dirty with SQL) and securely (WP_Query builds safe queries behind the scenes).
        $wp_query = new WP_Query( $this->args );
        if($wp_query->have_posts() ) : 
            while ( $wp_query->have_posts() ) : 
               $wp_query->the_post(); 
               $id = get_the_id();
               $newPostObj = Post::get($id);
            //    var_dump($newPostObj);
            endwhile; 
            wp_reset_postdata(); 
        else: 
        endif;
    }

   
}