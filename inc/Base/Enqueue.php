<?php
/**
 * @package BrinPlugin
 */
namespace Inc\Base;

class Enqueue {
    public function register() {
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
    }
    
    function enqueue() {
        /**
         * enqueue all scripts
         */
        wp_enqueue_style( 'my_plugin_style', PLUGIN_URL . 'assets/mystyle.css' );
        wp_enqueue_script( 'my_plugin_script', PLUGIN_URL. 'assets/myscript.js' );
    }
}