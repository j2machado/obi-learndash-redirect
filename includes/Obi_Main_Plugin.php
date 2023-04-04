<?php

namespace Obi_LearnDash_Redirect;
/**
 * 
 */
// Avoid direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Obi_Main_Plugin{

    /**
     * @var Class 
     * Single instance of this class
     */
    
     private static $instance;
    
     /**
     * @var serialized
     * Stores the course options as a serialized array.
     */

    private static $courseOptionsSerialized;

    /**
     * @var string
     * Stores the course access mode obtained from the course options.
     */
    
    private static $courseAccessMode;

    /**
     * @var string
     * Stores the course Button URL obtained from the course options.
     */

    private static $courseButtonURL;

    
    private function __construct(){

        add_action('template_redirect', array($this, 'redirect_from_course_page_to_landing' ) );

    }

    /**
     * Static Method.
     * 
     * Returns the instance.
     */

    public static function get_instance(){

        if( ! isset(self::$instance)){
            self::$instance = new self();
        }

        return self::$instance;

    }

    /**
     * Static Method.
     * 
     * Returns the options of the current course.
     * 
     * return @serialized
     */

    private static function get_LD_course_options_serialized(){

        self::$courseOptionsSerialized = get_post_meta(get_the_ID(), '_sfwd-courses', true);

        return self::$courseOptionsSerialized;

    }


    /**
     * Static Method.
     * 
     * Returns the access mode of the current course.
     * 
     * return @string
     */

    private static function get_course_access_mode(){
       
        self::$courseAccessMode = self::$courseOptionsSerialized['sfwd-courses_course_price_type'];

        return self::$courseAccessMode;

    }

    /**
     * Static Method.
     * 
     * Returns the Button URL value of the current course.
     * 
     * return @string
     */

    private static function get_course_button_URL(){
        
        self::$courseButtonURL = self::$courseOptionsSerialized['sfwd-courses_custom_button_url'];

        return self::$courseButtonURL;

    }

    /**
     * Encapsulates the logic.
     * 
     * Maybe redirects the user if conditions are met.
     */

    public function redirect_from_course_page_to_landing(){

        if(current_user_can( 'manage_options' ) ){

            return;

        }
        
        if("sfwd-courses" != get_post_type()){
            
            return;
            
        }

        self::get_LD_course_options_serialized();

        self::get_course_access_mode();

        if(self::$courseAccessMode != "closed"){
            
            return;
        
        }

        self::get_course_button_URL();

        if(self::$courseButtonURL === ''){
        
            return;
        
        }

        if( ld_course_check_user_access( get_the_ID() , get_current_user_ID() )){
        
            return;
        
        }
        
        wp_safe_redirect( self::$courseButtonURL );
        exit();
    }

}