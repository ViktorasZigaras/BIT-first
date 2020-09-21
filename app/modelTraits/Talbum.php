<?php
namespace BIT\app\modelTraits;

use BIT\app\TaxCollection;
use BIT\app\coreExeptions\InitHookNotFiredExeption;

trait Talbum {

    public $album_date = 'YYYY-MM_DD';
    public $album_content = '';
    private $taxonomy = 'hashtag';
     
    public function checkMulti(string $tag)
    {
        if (did_action('init')) {       
            $tags = explode(', ', $tag);
            foreach ($tags as $key => $term) {
                foreach (getTags() as $post_term) {
                    if ($post_term->name == $term) {
                        $tag_ids[] = $post_term->term_id;                    
                    }
                }
            }
            wp_remove_object_terms( $this->ID, $tag_ids, $this->taxonomy );
        } else {
            throw new InitHookNotFiredExeption('Error: Call to custom taxonomy function before init hook is fired.');
        }    
    }
    
    /** adds tag (Hashtag term) to post type Album */
    public function addTag(string $tag) 
    {
        if (did_action('init')) {
            // if (!term_exists( $tag, $this->taxonomy )) {
            //     wp_insert_term( $tag, $this->taxonomy, ['slug' => str_replace(' ', '-', $tag)] );
                           
            // }
            echo 'ID ' . $this->ID;
            wp_set_post_terms( $this->ID, $tag, $this->taxonomy, $append = true );
            /**Hierarchical taxonomies must always pass IDs rather than names ($tag) 
             * so that children with the same names but different parents aren't confused.*/
        } else {
            throw new InitHookNotFiredExeption('Error: Call to custom taxonomy function before init hook is fired.');
        }
    } 

    /** removes tag form post type Album */
    public function removeTag(string $tag) 
    {
        if (did_action('init')) {
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
        } else {
            throw new InitHookNotFiredExeption('Error: Call to custom taxonomy function before init hook is fired.');
        }        
    }

    /** returns all post tags as array */
    public function getTags() 
    {
        if (did_action('init')) {
            $terms = get_the_terms($this->ID, $this->taxonomy);
            return $terms;
        } else {
            throw new InitHookNotFiredExeption('Error: Call to custom taxonomy function before init hook is fired.');
        }
    }

    /** returns all hashtags as Collection */
    public function getAllTags() 
    {
        if (did_action('init')) {
            $taxCollection = new TaxCollection();

            $args = ['taxonomy' => $this->taxonomy, 'hide_empty' => 0,];
            $terms = get_terms($args);

            foreach ($terms as $term) {
                $taxCollection->addTerm($term);
            }
            return $taxCollection;
        } else {
            throw new InitHookNotFiredExeption('Error: Call to custom taxonomy function before init hook is fired.');
        }
    }

    
}