<?php

namespace Obi_LearnDash_Redirect;

class Redirect_Groups extends RedirectAbstract
{

    private static $instance;


    private function __construct()
    {

       add_action('template_redirect', array( $this, 'redirectTheEndUser') );

    }

    /**
     * Static Method.
     * 
     * Returns the instance.
     */

    public static function get_instance()
    {

        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    
    }

    protected static function getOptionsSerialized()
    {

        parent::$OptionsSerialized = get_post_meta(get_the_ID(), '_groups', true);

        return parent::$OptionsSerialized;
    
    }

    protected static function getAccessMode(){

        parent::$AccessMode = parent::$OptionsSerialized['groups_group_price_type'];

        return parent::$AccessMode;

    }

    protected static function getButtonURLvalue(){

        parent::$ButtonURL = parent::$OptionsSerialized['groups_custom_button_url'];

        return parent::$ButtonURL;

    }


    private static function obi_group_check_user_access(){

        $userMeta = get_user_meta( get_current_user_ID(), 'learndash_group_users_' . get_the_ID(), true );

        if($userMeta === '' || $userMeta === null){

            return;

        }

        if(get_the_ID() != $userMeta){

            return;

        }

        return true;

    }

    public function redirectTheEndUser(){

        if(current_user_can( 'manage_options' ) ){

            return;

        }
        
        if("groups" != get_post_type()){
            
            return;
            
        }
        

        self::getOptionsSerialized();

        

        self::getAccessMode();
        
    
        if(parent::$AccessMode != 'closed'){

            return;

        }

        self::getButtonURLvalue();

        if(parent::$ButtonURL === ''){

            return;

        }


        if ( self::obi_group_check_user_access() === true ){
            return;
        }

        wp_safe_redirect(parent::$ButtonURL);
        exit();




    }

}
