<?php

namespace BIT\models;
use BIT\app\modelTraits\Tpox;
use BIT\app\Post;

class PoxPost extends Post{
    use Tpox;

    
    protected static $type = 'pox';

    
}