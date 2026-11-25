<?php

namespace App\Helpers;

if (!function_exists('is_active_menu')) {
    function is_active_menu(string $url): string
    {
        $current_url = current_url(true)->getPath();
        return ($current_url === $url) ? 'active' : '';
    }
}