<?php
namespace BIT\app;

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

    // public function count() : int
    // {
    //     return count($this->tags);
    // }

    public function addTerm($tag)
    {
        $this->tags[] = $tag;
    }

    public function sortByName() 
    {
        $tags = $this->getAllTags();

    }
}