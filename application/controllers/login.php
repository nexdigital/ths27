<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


    function __construct(){
		parent::__construct();
		  session_start();
	}
     function index(){

        if($this->session->userdata('login')== "true"){
            
                $data['heading']    = "Dashboard";
                $data['view']       = "welcome_message";
                $this->load->view('content/body_content',$data);

        }else{

            
                $this->load->view('content/login_content');
          

        }
    

     }

    function sbt_login(){


        $username  = $_POST["username"];
        $password  = $_POST["password"];

        $active_user  = $this->tool_model->check_login($username,$password);

        if($active_user){

                         $this->tool_model->set_session_login($active_user);
                         $status = TRUE;
                         $message =  "Login Success. Please Wait...";

                         $user_id = $this->session->userdata('user_id');
                         $data['login']  = "1";
                         $this->master_user->edit_user($user_id,$data);

                     }else{
                         $status = FALSE;
                         $message = "Incorrect Username or Password";
                     }


       		 echo json_encode(array('status'=>$status,'message' => $message));


    }

    function logout(){

             $user_id = $this->session->userdata('user_id');
             $data['login']  = "0";
              $this->master_user->edit_user($user_id,$data);
    		 $this->tool_model->remove_session_login();
    		redirect('');

    }

}

