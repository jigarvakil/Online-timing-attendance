<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model1','m1');
		
	}
	
	public function home(){
		$user=$_SESSION['username'];
		$userdata=array(
			'sz_email'=>$user
		);
		$data['user']=	$this->m1->FetchData('tbl_user',$userdata);
		$uid= $data['user'][0]->nm_userid;
		$recordData=array(
			'nm_userid'=>$uid
		);
		$data['record']= $this->m1->FetchData('tbl_record',$recordData);
		$this->load->view('home',$data);
		
	}

	public function logout(){
		unset($_SESSION['username']);
		
		redirect(base_url().'Welcome','refresh');
		
	}

	public function index() {
		$this->load->view('login');
	}

	public function login(){
		$username=$this->input->post('txtusername');
		$password=$this->input->post('txtpassword');
		$data=array(
			'sz_email' => $username,
			'sz_pwd' => $password,
		);
		$result = $this->m1->FetchNumRecord('tbl_user',$data);
		if($result==1){
			$this->session->set_userdata('username',$username);
			redirect(base_url().'Welcome/home','refresh');
		

		}else{
			 echo "<script> alert('Login Not success!'); </script>";
			
			redirect(base_url().'Welcome','refresh');
			
		}
	}

	public function AddEntry(){
		$user=$_SESSION['username'];
		$reason= $this->input->post('txtreason');
		$date = date('Y-m-d');
		date_default_timezone_set('Asia/Kolkata');
		$time = date('H:i:sa');
			$userdata=array(
			'sz_email'=>$user
		);
		$data['user']=	$this->m1->FetchData('tbl_user',$userdata);
		$uid= $data['user'][0]->nm_userid;
		$status=1;
		$data=array(
			'nm_userid'=>$uid,
			'dt_date'=>$date,
			'sz_time'=>$time,
			'status'=> $status,
			'reason' => $reason
		);
		
	 	$this->m1->InsertData('tbl_record',$data);
		
		redirect(base_url()."Welcome/home",'refresh');
	}

	public function AddExit(){
		$user=$_SESSION['username'];
		$reason= $this->input->post('txtreason');
		$date = date('Y-m-d');
		date_default_timezone_set('Asia/Kolkata');
		$time = date('H:i:sa');
			$userdata=array(
			'sz_email'=>$user
		);
		$data['user']=	$this->m1->FetchData('tbl_user',$userdata);
		$uid= $data['user'][0]->nm_userid;
		$status=2;
		$data=array(
			'nm_userid'=>$uid,
			'dt_date'=>$date,
			'sz_time'=>$time,
			'status'=> $status,
			'reason' => $reason
		);
		
	 	$this->m1->InsertData('tbl_record',$data);
		
		redirect(base_url()."Welcome/home",'refresh');
	}



}