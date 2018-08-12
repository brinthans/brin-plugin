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

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

define( 'PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'PLUGIN', plugin_basename( __FILE__ ) );

use Inc\Base\Activate;
use Inc\Base\Deactivate;

function activate_brin_plugin() {
    Activate::activate();
}

function deactivate_brin_plugin() {
    Deactivate::deactivate();
}

register_activation_hook( __FILE__, 'activate_brin_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_brin_plugin' );

if ( class_exists( 'Inc\\Init' ) ) {
    Inc\Init::register_services();
}