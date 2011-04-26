<?php

/**
 *
 * @param string $email
 * @param string $code
 * @return boolean success whether the email was successfully sent
 */
function send_validation_email($email, $linkString)
{
    $CI =& get_instance();

    $CI->load->library('email');

    $CI->email->set_newline("\r\n"); //just has to be there
    $CI->email->from($CI->config->item('from'), $CI->config->item('name'));
    $CI->email->to($email);
    $CI->email->subject('Activate account');
    $CI->email->message("Click the following link to activate your account:\n\n" .
        base_url() . "user/activate/" . $linkString);

    $success = $CI->email->send();
//    error_log($CI->email->print_debugger());
    return $success;
}

function send_password_request_email($email, $linkString)
{
    $CI =& get_instance();

    $CI->load->library('email');

    $CI->email->set_newline("\r\n"); //just has to be there
    $CI->email->from($CI->config->item('from'), $CI->config->item('name'));
    $CI->email->to($email);
    $CI->email->subject('Reset password');
    $CI->email->message("Click the following link to reset your password:\n\n" .
                    base_url() . "user/activate/" . $linkString);

    $success = $CI->email->send();
    return $success;
}

?>
