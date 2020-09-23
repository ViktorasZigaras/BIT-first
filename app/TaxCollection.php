<?php
namespace BIT\app;

use BIT\app\modelTraits\Talbum;
use BIT\app\coreExeptions\InvalidOrderArgException;

class TaxCollection implements \IteratorAggregate
{
    private $tags = [];
    

    public function getIterator() : TaxIterator
    {
        return new TaxIterator($this);
    }

    public function getTerm($position)
    {
        if (isset($this->tags[$position])) {
            return $this->tags[$position];
        }
        return null;
    }   

    public function addTerm($tag)
    {
        $this->tags[] = $tag;
    }

    /** returns an array of hashtags sorted by name */
    public function sortByName() 
    {
        usort($this->tags, [$this, 'cmpByName']);
        return $this->tags;     
    }

    /** returns an array of hashtags sorted by count (times used) in descending order */

    /** Example usage:
    * $album = new AlbumPost;
    * $album->getAllTags()->sortByCount() */
    public function sortByCount() 
    {
        usort($this->tags, [$this, 'cmpByCount']);
        return $this->tags;        
    }
    
    public function cmpByName($a, $b) 
    {
        return $a->name <=> $b->name;
    }

    public function cmpByCount($a, $b) 
    {
        return $b->count <=> $a->count;
    }

    /** returns an array of hashtags sorted by $prop */

    /** Example usage:
    * $album = new AlbumPost;
    * $album->getAllTags()->sortBy('count', 'desc') */
    public function sortBy(string $prop, string $order = 'asc') 
    {
        $termProps = ['term_id', 'name', 'slug', 'term_taxonomy_id', 'description', 'count', 'filter'];
        if (in_array($prop, $termProps)) {
            usort($this->tags, function($a, $b) use ($prop, $order) {
                if ('asc' == $order) {
                    return ($a->$prop <=> $b->$prop);
                } elseif ('desc' == $order) {
                    return ($b->$prop <=> $a->$prop);
                } else {
                    throw new InvalidOrderArgException('Error: the second argument of sortBy() must be \'asc\' or \'desc\'.');
                }
            });
            return $this->tags;            
        } else {
            throw new InvalidOrderArgException('Error: the first argument of sortBy() is invalid.');
        }
    }

    public function pluck(...$args)
    {
        // $args - array
        // return $args;
        
    }

}

        // $album = new Talbum;
        // $tags = $album->getAllTags();
    
        // usort($tags, function($a, $b) {
        //     return ($a->count <=> $b->count);
        // });