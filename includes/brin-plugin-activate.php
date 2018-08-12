<?php
/**
 * @package BrinPlugin
 */

class brin_plugin_activate {
    public static function activate() {
        flush_rewrite_rules();
    }
}