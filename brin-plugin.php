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

if ( !class_exists( 'brin_plugin' ) ) {
    class brin_plugin {

        public $plugin;

        function __construct() {
            $this->plugin = plugin_basename( __FILE__ );

        }

        function register() {
            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
            
            add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );
            
            add_filter( "plugin_action_links_$this->plugin", array( $this, 'settings_link' ) );
            
        }

        public function settings_link( $links ) {
            $settings_link = '<a href="options-general.php?page=brin_plugin">Settings</a>';
            array_push( $links, $settings_link);
            return $links;
        }

        public function add_admin_pages() {
            add_menu_page( 'Brin Plugin', 'Brin', 'manage_options', 'brin_plugin', array( $this, 'admin_index' ), 'dashicons-store', 110);
        }

        public function admin_index() {
            require_once plugin_dir_path( __FILE__ ) . 'templates/admin.php'; 
        }

        protected function create_post_type() {
            add_action( 'init', array( $this, 'custom_post_type' ) );
        }

        function custom_post_type() {
            register_post_type( 'book', ['public' => true, 'label' => 'Books'] );
        }

        function enqueue() {
            /**
             * enqueue all scripts
             */
            wp_enqueue_style( 'my_plugin_style', plugins_url( '/assets/mystyle.css', __FILE__ ) );
            wp_enqueue_script( 'my_plugin_script', plugins_url( '/assets/myscript.js', __FILE__ ) );
        }
        
        function activate() {
            require_once plugin_dir_path( __FILE__ ) . 'includes\brin-plugin-activate.php';
            brin_plugin_activate::activate();
        }

        function deactivate() {
            require_once plugin_dir_path( __FILE__ ) . 'includes\brin-plugin-deactivate.php';
            brin_plugin_activate::deactivate();
        }
    }

    $brin_plugin = new brin_plugin();
    $brin_plugin->register();

    /**
     * activation
     */
    register_activation_hook ( __FILE__, array( $brin_plugin, 'activate' ) );

    /**
     * deactivate
     */
    register_deactivation_hook ( __FILE__, array( $brin_plugin, 'deactivate' ) );
}