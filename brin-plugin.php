<?php
/**
 * @package BrinPlugin
 */
/*
Plugin Name: Brin Plugin
Plugin URI: https://wordpress.com
Description: My first custom plugin.
Version: 1.0.0
Author: Brinthan
Author URI: https://wordpress.com
License: GPLv2 or later
Text Domain: brin-plugin
Domain Path: /lang
*/

if ( !defined( 'ABSPATH' ) ) die();

class brin_plugin {

    function __construct() {
        add_action( 'init', array( $this, 'custom_post_type' ) );
    }

    function register() {
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
    }

    function activate() {
        // generate a cpt
        $this->custom_post_type();
        // flush rewrite rules
        flush_rewrite_rules();
    }

    function deactivate() {
        // flush rewrite rules
        flush_rewrite_rules();
    }

    function uninstall() {
        //delete CPT
        //delete all the plugin data from the DB
    }

    function custom_post_type() {
        register_post_type( 'book', ['public' => true, 'label' => 'Books'] );
    }

    function enqueue() {
        // enqueue all our scripts
        wp_enqueue_style( 'my_plugin_style', plugins_url( '/assets/mystyle.css', __FILE__ ) );
        wp_enqueue_script( 'my_plugin_script', plugins_url( '/assets/myscript.js', __FILE__ ) );
    }

}

if ( class_exists( 'brin_plugin' ) ) {
    $brin_plugin = new brin_plugin();
    $brin_plugin->register();
}

// activation
register_activation_hook ( __FILE__, array( $brin_plugin, 'activate' ) );

// deactivate
register_deactivation_hook ( __FILE__, array( $brin_plugin, 'deactivate' ) );

// uninstall
