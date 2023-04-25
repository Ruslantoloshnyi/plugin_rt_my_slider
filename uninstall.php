<?php

defined('WP_UNINSTALL_PLUGIN') || exit;

global $wpdb;
$table_name = $wpdb->prefix . 'rt_slider_tbl';

$wpdb->delete($table_name);
