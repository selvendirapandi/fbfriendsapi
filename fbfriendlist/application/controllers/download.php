<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Download extends CI_Controller {

    //Global variable
    public $outputData;
    public $loggedInUser;

    function __construct() {
        parent::__construct();
        //Load Models
        $this->load->model('user_model');

        if (isLoggedIn() === false) {
            die('Please login to view this page');
        }

        //Get Logged In user
        $this->loggedInUser = $this->user_model->getLoggedInUser();
    }

    public function download_friendslist() {
        // Load the Library
        $this->load->library("excel");
        $this->outputData['friends'] = $this->user_model->getFriends($this->loggedInUser->id);
        if (!empty($_POST)) {
            $this->excel->setActiveSheetIndex(0);
            $this->excel->stream('friend_list_'.$this->loggedInUser->id.'.xls', $this->outputData['friends']);
        } 
		
		$this->load->view('file/header');
	    $this->load->view('file/menu');
	    $this->load->view('view_download', $this->outputData);
	    $this->load->view('file/footer');
        
    }

}

/* End of file download.php */
/* Location: ./application/controllers/download.php */