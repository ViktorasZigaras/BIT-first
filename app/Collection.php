<?php
namespace BIT\app;

use BIT\app\coreExeptions\wrongArgsTypeExeption;

class Collection{

    protected $items = [];

    public function __construct($items = []){
        $this->items = $this->getArrayableItems($items);

    }

    public function all()
    {
        return $this->items;
    }

    // public function contains($key, $operator = null, $value = null)
    // {
    //     if (func_num_args() === 1) {
    //         if ($this->useAsCallable($key)) {
    //             $placeholder = new stdClass;

    //             return $this->first($key, $placeholder) !== $placeholder;
    //         }

    //         return in_array($key, $this->items);
    //     }

    //     return $this->contains($this->operatorForWhere(...func_get_args()));
    // }



    protected function getArrayableItems($items){
        if (is_array($items)) {
            return $items;
        }
        elseif ($items instanceof self) {
            return $items->all();
        }

        return (array) $items;
    }
}