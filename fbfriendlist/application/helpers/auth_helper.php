<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Check Whether the user is logged in
 *
 * @access	public
 * @return	string
 */
function isLoggedIn() {
    $CI = & get_instance();
    return $CI->session->userdata('logged_in') == '1' ? TRUE : FALSE;
}

// ------------------------------------------------------------------------
	

/* End of file auth_helper.php */
/* Location: ./application/helpers/auth_helper.php */