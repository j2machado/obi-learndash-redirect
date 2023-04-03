<?php

namespace Obi_LearnDash_Redirect;

class Obi_Main_Plugin{

    private static $instance;

    private function __construct(){

        add_action('admin_footer', array( $this, self::console_logging() ) );

    }

    public static function get_instance(){

        if( ! isset(self::$instance)){
            self::$instance = new self();
        }

        return self::$instance;

    }


    public static function console_logging(){

        echo apply_filters('obi_console_message', 'Hola tres hola', 10);

    }

}