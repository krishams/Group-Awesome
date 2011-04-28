<?php
if ( ! function_exists('l')) {
    function l($lines) {
        if (is_array($lines) && !empty ($lines)) {
            $CI =& get_instance();
            $CI->lang->load('page', $CI->config->item('language'));
            foreach ($lines as $key => $value) {
                if (empty($value)) {
                    $lines[$key] = $CI->lang->line($key);
                }
            }
        }
        return $lines;
    }
}
?>