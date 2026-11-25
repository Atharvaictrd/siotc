// application/helpers/academic_helper.php

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('get_academic_year')) {
    function get_academic_year() {
        $current_month = date('n');
        $current_year = date('Y');
        if ($current_month < 9) {
            $academic_year = ($current_year - 1) . '-' . $current_year;
        } else {
            $academic_year = $current_year . '-' . ($current_year + 1);
        }
        return $academic_year;
    }
}

?>
