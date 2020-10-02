<?php

namespace BIT\app;
use BIT\app\Post;
use WP_Query;
use BIT\app\coreExeptions\wrongArgsTypeExeption;
include_once(ABSPATH . 'wp-includes/pluggable.php');

class Query{
    //gauti postus pagal tipa
    public function postType(string $post_type)
    {
        $this->args['post_type'] = $post_type;
        return $this;
    }

    //gauti postus pagal title
    public function postTitle(string $post_title)
    {
        $this->args['post_title'] = $post_title;
        return $this;
    }

    //gauti postus pagal pavadinima
    public function postName(string $post_name)
    {
        $this->args['post_name'] = $post_name;
        return $this;
    }

    //surusiuoti postus pagal reikiamus parametrus. Paduodama pagal ka rusiuoti(pvz date) ir kokia tvarka ('DESC')'
    public function postSort(string $orderby, string $order = 'ASC')
    {
        $sortOrder = ['DESC', 'ASC'];
        if (!in_array($order, $sortOrder)) {
            throw new wrongArgsTypeExeption ('Reikia nurodyti "DESC" arba "ASC"');
        }
        $this->args['orderby'] = $orderby;
        $this->args['order'] = $order;
        return $this;
    }

    //gauti reikmems is post_meta lenteles. Paduodama meta_key ir meta_value
     function postMeta(string $key, string $value){
        $this->args['meta_key'] = $key;
        $this->args['meta_value'] = $value;
        return $this; 
     }

    public function getPost() :array
    {
         //naudodami WP_query gauname postus pagal mums reikalingus parametrus. Paramentai nurodyti funkcijose aukščiau - postType, postTitle. KOnkrečius paramentrus (posto tipą, pavadinimą ir kt. nurodome kviesdami funckcija)
        //Thanks to WP_Query Class, WordPress gives us access to the database quickly (no need to get our hands dirty with SQL) and securely (WP_Query builds safe queries behind the scenes).
        $query = new WP_Query($this->args);
        $list = $query->get_posts();
        foreach ($list as &$post){
            $post = Post::getModel($post);
        } 
       
        return new Collection($list);
    }

}