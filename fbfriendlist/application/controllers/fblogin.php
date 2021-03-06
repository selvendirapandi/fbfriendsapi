<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fblogin extends CI_Controller {

    function __construct() {
        parent::__construct();
        //Load Models
        $this->load->model('user_model');
        $this->load->model('auth_model');
    }

    public function index() {
		$this->load->view('file/header');
	    $this->load->view('file/menu');
	    $this->load->view('view_fblogin');
	    $this->load->view('file/footer');
        
    }

    //Authenticate via facebook
    function facebook_auth() {
        
        
        $this->config->load('facebook');
        $this->load->library('facebook');
        $user = $this->facebook->getUser();
        if ($user) {
            try {
                // Proceed knowing you have a logged in user who's authenticated.
                $user_profile = $this->facebook->api('/me');
                $user_friends = $this->facebook->api('/me/friends');
                //print_r($user_friends);exit;
            } catch (FacebookApiException $e) {
                error_log($e);
                $user = null;
            }
        }
        if (!empty($user_profile)) {
            $conditions = array('oauth_uid' => $user_profile['id'], 'oauth_provider' => 'facebook');
            $row = $this->user_model->checkFacebookUser($conditions);
            if (!empty($row)) 
			{
				
				$flist = $this->user_model->getFriends($row->id);
			    $frieds_auth_fid =  array();
			
				foreach($flist as $friends)				
				$frieds_auth_fid[] = $friends->oauth_fid;	
		
		        
       	
				if(count($user_friends > 0))
				{
				   foreach($user_friends['data'] as $friend)
				    {					
						if(!in_array($friend['id'],$frieds_auth_fid))
						{
					      $insertData = array('uid' => $row->id, 'name' => $friend['name'], 'oauth_fid' => $friend['id']);
                          $this->user_model->addFriend($insertData);
						}
                    }
				}
					
				if (isLoggedIn() === true)
				redirect('/download/download_friendslist');
					   
				$this->register_session($row);
            } 
			
			else {
                $insertData = array('oauth_uid' => $user_profile['id'], 'oauth_provider' => 'facebook', 'user_name' => $user_profile['name']
                    , 'name' => $user_profile['name'], 'email' => $user_profile['email'], 'created' => date('Y-m-d H:i:s')
                    , 'facebookurl' => $user_profile['link'], 'total_friends' => $user_friends['summary']['total_count'], 'app_shared_by' => count($user_friends['count']));
                //Create User
                $row = $this->user_model->createFbUser($insertData);
                if (count($row)) {
                    foreach($user_friends['data'] as $friend) {
                        $insertData = array('uid' => $row->id, 'name' => $friend['name'], 'oauth_fid' => $friend['id']);
                        $this->user_model->addFriend($insertData);
                    }
                    $this->register_session($row);
                }
            }
        } else {
            # There's no active session, let's generate one
            $login_url = $this->facebook->getLoginUrl(array('scope' => $this->config->item('scope')));
            header("Location: " . $login_url);
        }
    }

    //After successful authentication register session and redirect 
    function register_session($row) {
        $this->load->model('auth_model');
        // update the last activity in the users table
        $updateData = array();
        $updateData['last_activity'] = date('Y-m-d H:i:s');
        // update process for users table
        $this->user_model->updateUser(array('id' => $row->id), $updateData);
        $this->auth_model->setUserSession($row);
        redirect('/download/download_friendslist');
    }

    function logout() {
        //facebook session destroy
        $this->load->library('facebook');
        $this->facebook->destroySession();
        $this->auth_model->clearUserSession();
        redirect('fbloin');
    }

}

/* End of file fblogin.php */
/* Location: ./application/controllers/fblogin.php */