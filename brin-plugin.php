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

    function activate() {
        // generate a cpt
        $this -> custom_post_type();
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

}

if ( class_exists( 'brin_plugin' ) ) $brin_plugin = new brin_plugin();

// activation
register_activation_hook ( __FILE__, array( $brin_plugin, 'activate' ) );

// deactivate
register_deactivation_hook ( __FILE__, array( $brin_plugin, 'deactivate' ) );

// uninstall
