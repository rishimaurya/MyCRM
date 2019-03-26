<?php ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');


class Login extends CI_Controller {
	
	
	public function index()
	{ 
	        $this->load->model('LoginModel');
	        //$status = $this->LoginModel->check_status();
	        
	        $this->session->set_flashdata('error','');
			$this->load->view('login/login');
			
	}
	public function Error_404()
     {
         $this->load->view('errors/html/error404');
     }
     
	public function check_login()
	{
		if($_POST==null)
		{
			return redirect('Login');
		}
		else
		{	$date = date("Ymd");
	   
			$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|callback_username_check');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_password_check');
			$this->load->model('LoginModel');
			$this->username=$_POST['username'];
            
			$this->password=$_POST['password'];
			$this->mylist=$_POST['mylist'];
			
			$user=$_POST['mylist'];
			
			$row=$this->LoginModel->select_users($this);	
				
			if($row)
			{
				if($row[0]->is_blocked=="1" or $row[0]->blocked=="1" )
				{
				   $this->session->set_flashdata('error','CRM Is Blocked Login After Some Time.');
				   $this->load->view('login/login');
				   //return redirect(base_url().'Login');
				}
				else
				{
				date_default_timezone_set("Asia/Kolkata");
				$last_login= date("Y-m-d h:i:s");
				$this->load->model('LoginModel');
				$this->LoginModel->set_last_login($last_login,$this->username);
				
				//session begins
				
				$session_array=array('employee_id'=>$row[0]->employee_id,'username'=>$row[0]->username, 'first_name'=>$row[0]->first_name,'middle_name'=>$row[0]->middle_name,
				'last_name'=>$row[0]->last_name,'gender'=>$row[0]->gender,'dob'=>$row[0]->dob ,'doj'=>$row[0]->doj,'role'=>$row[0]->role,
				'father_name'=>$row[0]->father_name,'address'=>$row[0]->address,'last_login'=>$row[0]->last_login,'email'=>$row[0]->email,
				'mobile'=>$row[0]->mobile);	
				$this->load->library('session');
				$this->session->set_userdata('my_session',$session_array);

				
					if($_POST['mylist']=="admin")
						return redirect('Admin/admin_dashboard');
					if($_POST['mylist']=="manager")
						return redirect('Manager/manager_dashboard');
					if($_POST['mylist']=="employee")
						return redirect('Employee/employee_dashboard');
					if($_POST['mylist']=="researcher")
						return redirect('Researcher/researcher_dashboard');
				
			}
			}
			else
			{	
				
			  $this->session->set_flashdata('error','invalid username or password');
				$this->load->view('login/login');
				//return redirect('login/index',$message);
			  
			}
		}	
	}
	
	

	public function logout()
	{
		
		$this->session->unset_userdata('my_session');
		$this->session->unset_userdata('verified');
		return redirect('Login');
	}	
	
 	public function blockLogout()
 	{
 	   $row=$this->session->userdata('my_session');	
          if($row['role']=="admin")
 	   {
 	  	 $this->load->model('LoginModel');
 	  	 $status = $this->LoginModel->blockCrm();
	 	if($status)
 	  	 {
 	             return redirect(base_url().'Login/logout');
 	   	 }
 	   	 else
 	   	 {
 	   	     return redirect(base_url().'Login/logout');
 	   	 }
 	   }
 	   else
 	   {	
 	   	 return redirect(base_url().'Login');
 	   }
 	} 

       public function blockUser()
 	{
 	   $row=$this->session->userdata('my_session');	
          if($row['role']=="admin")
 	   {
 	  	 $id = $_GET['e_id'];
 	  	 $this->load->model('LoginModel');
 	  	 $status = $this->LoginModel->blockUser($id);
	 	if($status)
 	  	 {
 	             
 	   	 }
 	   	 else
 	   	 {
 	   	     
 	   	 }
 	   }
 	   else
 	   {	
 	   	 return redirect(base_url().'Login');
 	   }
 	}
 	
 	public function removeblockUser()
 	{
 	   $row=$this->session->userdata('my_session');	
          if($row['role']=="admin")
 	   {
 	  	 $id = $_GET['e_id'];
 	  	 $this->load->model('LoginModel');
 	  	 $status = $this->LoginModel->removeblockUser($id);
	 	if($status)
 	  	 {
 	             
 	   	 }
 	   	 else
 	   	 {
 	   	     
 	   	 }
 	   }
 	   else
 	   {	
 	   	 return redirect(base_url().'Login');
 	   }
 	} 	
 	
 	public function blockAllUsers()
 	{
 	   $row=$this->session->userdata('my_session');	
          if($row['role']=="admin")
 	   {
 	  	 $id = $_GET['e_id'];
 	  	 $this->load->model('LoginModel');
 	  	 $status = $this->LoginModel->blockAllUser($id);
	 	if($status)
 	  	 {
 	  	     $this->session->set_flashdata('insert','All Users Blocked Successfully. ');
 	             return redirect(base_url().'Admin/blockingusers');
 	   	 }
 	   	 else
 	   	 {
 	   	     $this->session->set_flashdata('insert','Users Blocking Failed. ');
 	   	     return redirect(base_url().'Admin/blockingusers');
 	   	 }
 	   }
 	   else
 	   {	
 	   	 return redirect(base_url().'Login');
 	   }
 	} 
 	
 	public function unBlockAllUsers()
 	{
 	   $row=$this->session->userdata('my_session');	
          if($row['role']=="admin")
 	   {
 	  	 $id = $_GET['e_id'];
 	  	 $this->load->model('LoginModel');
 	  	 $status = $this->LoginModel->unBlockAllUser($id);
	 	if($status)
 	  	 {
 	  	     $this->session->set_flashdata('insert','All Users Un Blocked Successfully. ');
 	             return redirect(base_url().'Admin/blockingusers');
 	   	 }
 	   	 else
 	   	 {
 	   	     $this->session->set_flashdata('insert','Users Un Blocking Failed. ');
 	   	     return redirect(base_url().'Admin/blockingusers');
 	   	 }
 	   }
 	   else
 	   {	
 	   	 return redirect(base_url().'Login');
 	   }
 	}
 	
 	public function unBlockTempCrm()
 	{
 	   $row=$this->session->userdata('my_session');	
          if($row['role']=="admin")
 	   {
 	  	 $this->load->model('LoginModel');
 	  	 $status = $this->LoginModel->unBlockCrm();
	 	if($status)
 	  	 {
 	              $this->session->set_flashdata('registered','CRM Un Blocked Successfully. ');
 	             return redirect(base_url().'Admin/admin_dashboard');
 	   	 }
 	   	 else
 	   	 {
 	   	      $this->session->set_flashdata('registered','CRM Un Blocking Failed. ');
 	   	     return redirect(base_url().'Admin/admin_dashboard');
 	   	 }
 	   }
 	   else
 	   {	
 	   	 return redirect(base_url().'Login');
 	   }
 	} 
 	
 	public function blockTempCrm()
 	{
 	   $row=$this->session->userdata('my_session');	
          if($row['role']=="admin")
 	   {
 	  	 $this->load->model('LoginModel');
 	  	 $status = $this->LoginModel->blockCrm();
	 	if($status)
 	  	 {
 	              $this->session->set_flashdata('registered','CRM Blocked Successfully. ');
 	             return redirect(base_url().'Admin/admin_dashboard');
 	   	 }
 	   	 else
 	   	 {
 	   	      $this->session->set_flashdata('registered','CRM Blocking Failed. ');
 	   	     return redirect(base_url().'Admin/admin_dashboard');
 	   	 }
 	   }
 	   else
 	   {	
 	   	 return redirect(base_url().'Login');
 	   }
 	} 
 	
}
?>
