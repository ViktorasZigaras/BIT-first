<?php

namespace BIT\app;
use BIT\app\Post;
use WP_Query;
include_once(ABSPATH . 'wp-includes/pluggable.php');

class Query{
    //gauti postus pagal tipa
    public function postType($post_type)
    {
        $this->args['post_type'] = $post_type;
        return $this;
    }

    //gauti postus pagal title
    public function postTitle($post_title)
    {
        $this->args['post_title'] = $post_title;
        return $this;
    }

    //gauti postus pagal pavadinima
    public function postName($post_name)
    {
        $this->args['post_name'] = $post_name;
        return $this;
    }

    //surusiuoti postus pagal reikiamus parametrus. Paduodama pagal ka rusiuoti(pvz date) ir kokia tvarka ('DESC')'
    public function postSort($orderby, $order)
    {
        $this->args['orderby'] = $orderby;
        $this->args['order'] = $order;
        return $this;
    }

    //gauti reikmems is post_meta lenteles. Paduodama meta_key ir meta_value
     function postMeta($key, $value){
        $this->args['meta_key'] = $key;
        $this->args['meta_value'] = $value;
        return $this; 
     }

    public function getPost()
    {
         //naudodami WP_query gauname postus pagal mums reikalingus parametrus. Paramentai nurodyti funkcijose aukščiau - postType, postTitle. KOnkrečius paramentrus (posto tipą, pavadinimą ir kt. nurodome kviesdami funckcija)
        //Thanks to WP_Query Class, WordPress gives us access to the database quickly (no need to get our hands dirty with SQL) and securely (WP_Query builds safe queries behind the scenes). i objekta magic savybe ideti to string.
        $query = new WP_Query($this->args);
        $list = $query->get_posts();
        foreach ($list as &$post){
            $post = Post::get($post->ID);
        } 
        return $list;
    }

}