<?php

class User_model extends CI_Model {

    /**
     * Constructor 
     *
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Update users
     */
    function updateUser($updateKey = array(), $updateData = array()) {
        $this->db->update('users', $updateData, $updateKey);
    }

    //End of updateUser Function 
    // --------------------------------------------------------------------

    /**
     * Get Users
     *
     * @access	private
     * @param	array	conditions to fetch data
     * @return	object	object with result set
     */
    function getUsers($conditions = array(), $fields = '') {

        if (count($conditions) > 0)
            $this->db->where($conditions);

        $this->db->from('users');

        if ($fields != '')
            $this->db->select($fields);
        else
            $this->db->select('users.id,users.user_name');


        $result = $this->db->get();
        return $result;
    }

    //End of getUsers Function

    /**
     * check Fb User exists
     *
     * @access	public
     * @param	array	conditions to fetch data
     * @return	array	resultant data
     */
    function checkFacebookUser($conditions = array()) {
        if (count($conditions)) {
            $this->db->where($conditions);
        }
        return ($this->get_user_data());
    }

    //End of Function 

    /**
     * create Facebook user
     *
     * @access	public
     * @param	array  data to be inserted
     * @return	array  again return the inserted data
     */
    function createFbUser($insertData = array()) {
        $this->db->insert('users', $insertData);
        $lastinsertid = $this->db->insert_id();
        return ($this->get_user_data($lastinsertid));
    }

    /**
     * Add Facebook user's friend
     *
     * @access	public
     * @param	array  data to be inserted
     */
    function addFriend($insertData = array()) {
        $this->db->insert('friendslist', $insertData);
    }

    //End of createUser Function
    //@param	int  userid
    function get_user_data($id = '', $fields = '') {
        $this->db->from('users');
        if ($fields == '')
            $this->db->select('users.id,users.user_name,users.name,users.email');
        else
            $this->db->select($fields);
        if ($id != '') {
            $this->db->where('users.id', $id);
        }
        $result = $this->db->get();
        $row = $result->row();
        return $row;
    }

    /**
     * Get getLoggedInUser
     */
    function getLoggedInUser() {
        $user = '';
        $condition = array('users.id' => $this->session->userdata('user_id'));
        $fields = 'users.id,users.user_name,users.name';
        $query = $this->getUsers($condition, $fields);
        if ($query->num_rows() > 0) {
            $user = $query->row();
        }
        return $user;
    }

    /**
     * Get Fb User Friends
     *
     * @access	public
     * @param	int userid to fetch data
     * @return	array	resultant data
     */
    function getFriends($user_id = 0) {
        //Stored Procedure Call
        $sql = "CALL GetFriends(?)";
        $parameters = array($user_id);
        $query = $this->db->query($sql, $parameters);
		$res = $query->result();
		$query->next_result();
        $query->free_result(); 
        return $res;
    }
	
	

}

// End User_model Class

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */
?>
