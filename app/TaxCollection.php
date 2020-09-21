<?php
namespace BIT\app;

use BIT\app\modelTraits\Talbum;

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
}

        // $album = new Talbum;
        // $tags = $album->getAllTags();
    
        // usort($tags, function($a, $b) {
        //     return ($a->count <=> $b->count);
        // });