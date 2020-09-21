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

    public function sortByName() 
    {
        usort($this->tags, [$this, 'byName']);
        return $tags;        
    }

    public function sortByCount() 
    {
        usort($this->tags, [$this, 'byCount']);
        return $tags;        
    }

    public function byName($a, $b) 
    {
        return $a->name <=> $b->name;
    }

    public function byCount($a, $b) 
    {
        return $a->count <=> $b->count;
    }
}

        // $album = new Talbum;
        // $tags = $album->getAllTags();
    
        // usort($tags, function($a, $b) {
        //     return ($a->count <=> $b->count);
        // });