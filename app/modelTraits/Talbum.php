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
        
        if (!term_exists( $tag, $this->taxonomy )) {
            wp_insert_term( $tag, $this->taxonomy, ['slug' => str_replace(' ', '-', $tag)] );
            unset( $tag );            
        }
        wp_set_post_terms( $post_id = $this->ID, $tag, $this->taxonomy, $append = false );
    } 

    /** removes tag form post type Album */
    public function removeTag(string $tag) 
    {
        //getTags()

        if (!term_exists( $tag, $this->taxonomy )) {
            wp_remove_object_terms( $post_id, $tag, $this->taxonomy );
        }
        
    }

    /** returns all tags array (as Iterable) */
    public function getTags() 
    {
        // get_the_terms( int|WP_Post $post, string $taxonomy )
        // $post: Post ID or object
        $terms = get_terms( $this->taxonomy, ['hide_empty' => 0,] );
        return $terms;
    }

}