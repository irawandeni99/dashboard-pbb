<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('base_urI')) {
    function base_urI($path = '') {
        $CI =& get_instance();
        $base = $CI->config->item('flags');
        return rtrim($base, '/') . '/' . ltrim($path, '/');
    }
}
