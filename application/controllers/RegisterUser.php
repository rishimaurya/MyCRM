<?php ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');


class RegisterUser extends CI_Controller {
	
	function __construct() {
        parent::__construct();
      $this->load->model("RegisterUserModel");
    }
	public function index()
	{   
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
		if($rolecheck!="admin" && $rolecheck!="manager")
			return redirect('Login');
		
		if($rolecheck=="admin")
		{		
			$this->load->model('HeaderModel');
		    $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		    $data['count_msg']=$this->HeaderModel->count_msg();
		    $this->load->view('admin/admin_header',$data);
			$message['msg']="";
			$this->load->view('admin/register_user',$message);
			$this->load->view('admin/admin_footer');
		}
		if($rolecheck=="manager")
		{		
		    $this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
			$this->load->view('manager/manager_header',$data);
			$message['msg']="";
			$this->load->view('manager/register_user',$message);
			$this->load->view('manager/manager_footer');
		}
	}
	
	public function getPost()
	 {
		 if(!empty($_GET['role']))
		  {
			  $role=$_GET['role'];
			  if($role == "employee")
			  {
			  $post = $this->RegisterUserModel->fetch_designation();
			  if(!empty($post))
				{
					echo "<option value=''> Select Sub Designation </option> ";
					foreach ( $post as $data )
					 {
						 echo "<option value='".$data->designation."'>".$data->designation."</option> ";
					 }
				}
			  }
			  else
			  {
			       echo "<option value='0'>No Sub Designation</option> ";
			  }
			  
		  }
		 else
		  {
			 redirect('RegisterUser', 'refresh');
		  }
	 }
	 
   /* public function check_available()
	{
		$this->load->model('SignupModel');
		$username=$_POST['username'];   		

        $check_exist=$this->SignupModel->check($username);
		$check_exist= $check_exist->result();
		if($check_exist==null)
		{
			$message['msg']="username available";
			$this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
			$this->load->view('public/header',$data);
			$this->load->view('sign_up/insert',$message);
			$this->load->view('public/footer');
		}
		else
		{
			$message['msg']="";
			$this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
			$this->load->view('public/header',$data);
			$this->load->view('sign_up/insert',$message);
			$this->load->view('public/footer');
		}
		
	} */
	public function insert()
	{
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];

		if($rolecheck!="admin" && $rolecheck!="manager")
			return redirect('Login');
		
		if($_POST['username']=="")
		{
		   	if($rolecheck=="admin")
				return redirect('Admin/admin_dashboard');
			if($rolecheck=="manager")
				return redirect('Manager/manager_dashboard');
		}
		else
		{
			
			$username=$_POST['username'];   		

			$check_exist=$this->RegisterUserModel->check($username);
			$check_exist= $check_exist->result();
			if($check_exist==null)
			{
		 
				$this->username=$_POST['username'];
				$this->role=$_POST['user'];
				$this->subpost=$_POST['subpost'];
				$this->password= password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 12]);
				$this->first_name=$_POST['first_name'];
				$this->middle_name=$_POST['middle_name'];
				$this->last_name=$_POST['last_name'];
				$this->dob=$_POST['dob'];
				$this->doj=$_POST['doj'];
				$this->gender=$_POST['gender'];
				//$this->father_name=$_POST['fname'];
				$this->mobile=$_POST['mobile'];
				$this->email=$_POST['email'];
				//$this->address=$_POST['address'];
				      
				/*$addr1=$_POST['address1'];
				$addr2=$_POST['address2'];
				$city=$_POST['city'];
				$pincode=$_POST['pincode'];
				$state=$_POST['state'];
				$this->address = ''.$addr1.'  '.$addr2.'  '.$city.'  ('.$pincode.')  '.$state;*/
				
				
				

				$this->RegisterUserModel->insert_users($this);
				$this->session->set_flashdata('insert','user registered successfully.');
				if($rolecheck=="admin")
				{			
					return redirect('RegisterUser');
				}
				if($rolecheck=="manager")
				{			
				    return redirect('RegisterUser');
				}
			}
			else
			{
				$this->session->set_flashdata('already','Username Not Available');
				$message['msg']="username already exist";
				if($rolecheck=="admin")
				{		
					return redirect('RegisterUser');
				}	
				if($rolecheck=="manager")
				{		
					return redirect('RegisterUser');				
				}
			}
		}	
	}

	
	
		
}

?>
