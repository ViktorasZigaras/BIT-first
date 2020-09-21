<?php
namespace BIT\app\modelTraits;

use BIT\app\TaxCollection;

trait Talbum {

    public $album_date = 'YYYY-MM_DD';
    public $album_content = '';
    private $taxonomy = 'hashtag';
     
    public function checkMulti(string $tag)
    {       
        $tags = explode(', ', $tag);
        foreach ($tags as $key => $term) {
            foreach (getTags() as $post_term) {
                if ($post_term->name == $term) {
                    $tag_ids[] = $post_term->term_id;                    
                }
            }
        }
        wp_remove_object_terms( $this->ID, $tag_ids, $this->taxonomy );
    }
    
    /** adds tag (Hashtag term) to post type Album */
    public function addTag(string $tag) 
    {           
        /**Hierarchical taxonomies must always pass IDs rather than names ($tag) 
         * so that children with the same names but different parents aren't confused.*/
        wp_set_post_terms( $this->ID, $tag, $this->taxonomy, $append = true );        
    } 

    /** removes tag form post type Album */
    public function removeTag(string $tag) 
    {
        if(strpos($tag, ',')) {
            checkMulti($tag);
        } else {
            foreach (getTags() as $term) {
                if ($term->name == $tag) {
                    $tag_id = $term->term_id;
                    wp_remove_object_terms( $this->ID, $tag_id, $this->taxonomy );
                }
            }
        }        
    }

    /** returns all (post) tags array (as Iterable) */
    public function getTags() 
    {
        $terms = get_the_terms($this->ID, $this->taxonomy);
        return $terms;    
    }

    /** returns all hashtags Collection */
    public function getAllTags() 
    {
        $taxCollection = new TaxCollection();

        $args = ['taxonomy' => $this->taxonomy, 'hide_empty' => 0,];
        $terms = get_terms($args);

        foreach ($terms as $term) {
            $taxCollection->addTerm($term);
        }
        return $taxCollection;
    }

    
}