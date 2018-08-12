<?php
/**
 * @package BrinPlugin
 */

class brin_plugin_deactivate {
    public static function activate() {
        flush_rewrite_rules();
    }
}