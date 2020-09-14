<?php

namespace BIT\app;
use BIT\app\Post;
require PLUGIN_DIR_PATH . '/../../../wp-load.php';
require_once( ABSPATH . 'wp-admin/includes/image.php' );

class Attachment extends Post{

    protected static $type = 'attachment';


    public function save($formInputName = '', $parentId = 0){

        $wordpress_upload_dir = wp_upload_dir();
        $fileNamePrefix = 1; 
        
        $profilepicture = $_FILES[$formInputName];
        $new_file_path = $wordpress_upload_dir['path'] . '/' . $profilepicture['name'];
        $new_file_mime = mime_content_type( $profilepicture['tmp_name'] );
        //validation
        if( empty( $profilepicture ) )
            die( 'File is not selected.' );
        
        if( $profilepicture['error'] )
            die( $profilepicture['error'] );
        
        if( $profilepicture['size'] > wp_max_upload_size() )
            die( 'It is too large than expected.' );
        
        if( !in_array( $new_file_mime, get_allowed_mime_types() ) )
            die( 'WordPress doesn\'t allow this type of uploads.' );
        
        while( file_exists( $new_file_path ) ) {
            $i++;
            $new_file_path = $wordpress_upload_dir['path'] . '/' . $fileNamePrefix . '_' . $profilepicture['name'];
        }
        //save to DB
        if( move_uploaded_file( $profilepicture['tmp_name'], $new_file_path ) ) {
        
            $upload_id = wp_insert_attachment( array(
                'guid'           => $new_file_path, 
                'post_mime_type' => $new_file_mime,
                'post_title'     => preg_replace( '/\.[^.]+$/', '', $profilepicture['name'] ),
                'post_status'    => 'inherit'
            ), $new_file_path, $parentId );
        
            // Generate and save the attachment metas into the database
            wp_update_attachment_metadata( $upload_id, wp_generate_attachment_metadata( $upload_id, $new_file_path ) );
        }
    }
}