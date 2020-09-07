<?php
namespace BIT\app;

class Config{

    public static function postTypeRegister(){

        $types = require PLUGIN_DIR_PATH . 'configs/postTypeConfigs.php';
        if ($types) {
            foreach ($types as $type1 => $args1) {
                
                add_action('init', function() use ($type1, $args1){
                   
                    register_post_type($type1, $args1);
                });   
            }   
        }
    }

}