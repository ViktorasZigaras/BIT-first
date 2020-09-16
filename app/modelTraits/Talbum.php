<?php
namespace BIT\app\modelTraits;

trait Talbum{

    public $album_date = 'YYYY-MM_DD';
    public $album_content = '';
    public $taxonomy = 'hashtag';

    /** adds tag (Hashtag term) to post type Album */
    
    public function checkMulti(string $tag)
    {
        // if(contains commas) {
        //     $tags = explode();
        // }
        // foreach ( tags as $term_key => $term) {
            //     wp_insert_term(
            //         $term['name'],
            //         $this->taxonomy, 
            //         array(
            //             'description'   => $term['description'],
            //             'slug'          => $term['slug'],
            //         )
            //     );
            // unset( $term ); 
        // }
    }
    
    
    public function addTag(string $tag) 
    {   
        // if (!term_exists( $tag, $this->taxonomy )) {
        //     wp_insert_term( $tag, $this->taxonomy, ['slug' => str_replace(' ', '-', $tag)] );
        //     // unset( $tag );            
        // }
        // foreach (getTags() as $term) {}
        // if ($term->name == $tag) {
        //     $tag_id = $term->term_id;
        /**Hierarchical taxonomies must always pass IDs rather than names ($tag) 
         * so that children with the same names but different parents aren't confused.*/
            wp_set_post_terms( $this->ID, $tag, $this->taxonomy, $append = true );
        // }
        
    } 

    /** removes tag form post type Album */
    public function removeTag(string $tag) 
    {
        foreach (getTags() as $term) {}
        if ($term->name == $tag) {
            $tag_id = $term->term_id;
            wp_remove_object_terms( $this->ID, $tag_id, $this->taxonomy );
        }
        

        // if (!term_exists( $tag, $this->taxonomy )) {
        //     wp_remove_object_terms( $this->ID, $tag, $this->taxonomy );
        // }
        
    }

    /** returns all (post) tags array (as Iterable) */
    // add_action('init', [Talbum::class, 'getTags']);
    public function getTags() 
    {
        $terms = get_the_terms($this->ID, $this->taxonomy);

        // $args = ['taxonomy' => $this->taxonomy, 'hide_empty' => 0,];
        // $terms = get_terms($args);

        return $terms;
    // array(
    //     [0] => WP_Term Object
    //     (
    //         [term_id] => 9
    //         [name] => summer
    //         [slug] => summer
    //         [term_group] => 0
    //         [term_taxonomy_id] => 9
    //         [taxonomy] => hashtag
    //         [description] => 
    //         [parent] => 0
    //         [count] => 2
    //         [filter] => raw
    //     )
    // )
    }

}