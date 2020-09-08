<?php
namespace BIT\app;

class Config{

    public static function postTypeRegister(){
      $types = require PLUGIN_DIR_PATH . 'configs/postTypeConfigs.php';
        if ($types) {
            add_action('init', function() use($types){
            foreach ($types as $type => $args) {
                    register_post_type($type, $args);
                }   
            });   
        }
       
        
    }
}