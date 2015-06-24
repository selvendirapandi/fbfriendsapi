<?php
class Auth_model extends CI_Model {

    // Constructor 

    public function __construct() {
        parent::__construct();
    }

    //Controller End
    // --------------------------------------------------------------------

    function setUserSession($row = NULL) {
                $values = array('user_id' => $row->id, 'logged_in' => TRUE);
                $this->session->set_userdata($values);
    }

    //End of setUserSession Function

    function clearUserSession() {
        $array_items = array('user_id' => '', 'logged_in' => '');
        $this->session->unset_userdata($array_items);
    }

    //End of clearSession Function
}

// End Auth_model Class
   
/* End of file Auth_model.php */ 
/* Location: ./application/models/Auth_model.php */