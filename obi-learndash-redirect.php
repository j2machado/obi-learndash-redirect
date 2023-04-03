<?php
/*
Plugin Name: Obi LearnDash Redirect
Plugin URI: https://obijuan.dev/obi-learndash-redirect
Description: Redirect users to your course/group custom sales page.
Version: 1.0.0
Author: Obi Juan
Author URI: https://obijuan.dev
License: GPLv2 or later
Text-Domain: obi-learndash-redirect
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
  }

require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

use Obi_Init as GlobalObi_Init;
use Obi_LearnDash_Redirect\Obi_Main_Plugin;

class Obi_Init{

    private static $instance;

    private function __construct(){
        $this->define_constants();
    }

    public static function get_instance(){

        if( ! isset(self::$instance)){
            self::$instance = new self();
        }

        return self::$instance;

    }

    private function define_constants(){
     
        define( 'OBI_LEARNDASH_REDIRECT_VERSION', '1.0.0' );
        define( 'OBI_LEARNDASH_REDIRECT_TEXTDOMAIN', 'obi-learndash-redirect');
        define( 'OBI_LEARNDASH_REDIRECT_DIRNAME', plugin_basename( dirname(__FILE__) ) );
        define( 'OBI_LEARNDASH_REDIRECT_FILE', __FILE__);
        define( 'OBI_LEARNDASH_REDIRECT_PREFIX', 'obi_learndash_redirect');
        define( 'OBI_LEARNDASH_REDIRECT_PATH', plugin_dir_path( OBI_LEARNDASH_REDIRECT_FILE ) );
        define( 'OBI_LEARNDASH_REDITECT_URL', plugin_dir_url( OBI_LEARNDASH_REDIRECT_FILE ) );
    
    }

    public function activate(){

        // Here...

        exit('Whatchadoo!');

    }

}

$obi_learndash_redirect = Obi_Init::get_instance();
register_activation_hook( OBI_LEARNDASH_REDIRECT_FILE, array( $obi_learndash_redirect, 'activate' ) );