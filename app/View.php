<?php

namespace BIT\app;

class View
{
    public static function render(string $templateName, array $vars) {
        /** $templateName = 'bebras.event'; //(theme view/bebras/event.php) */ 
        // kelias iki aktyvios temos
        $templateName = str_replace('.', '/', $templateName);
        $path = get_stylesheet_directory() . '/views/' . $templateName . '.php';
        // kintamieji is masyvo $vars
        extract($vars);
                
        ob_start();
        require $path;
        $content = ob_get_contents();
        ob_end_clean();
        
        return $content;
    }
}