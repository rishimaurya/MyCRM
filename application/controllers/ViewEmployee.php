<?php ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class ViewEmployee extends CI_Controller {

	public function get_employee_list()
	{
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
		if($rolecheck!="admin" && $rolecheck!="manager")
			return redirect('Login');
			/*	Pagination Technique for View Leads.*/
		$data   = array();
		$this->load->model('EmployeeModel');
		$this->load->library('pagination');
		$this->load->helper('url');
		//$this->load->library('acl');
		
		$config['base_url'] = base_url().'/ViewEmployee/get_employee_list/';
        $config['total_rows'] = $this->EmployeeModel->count('users');
        $config['per_page'] = 20;
        $config['uri_segment'] = 3;
        $config['suffix'] ='.html';
        
    //Styling Link for Pagination. 
        
        $config['full_tag_open']    = "<ul class='pagination'>";
        $config['full_tag_close']   = "</ul>";
        $config['num_tag_open']     = "<li>";
        $config['num_tag_close']    = "</li>";
        $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close']    = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open']    = "<li>";
        $config['next_tagl_close']  = "</li>";
        $config['prev_tag_open']    = "<li>";
        $config['prev_tagl_close']  = "</li>";
        $config['first_tag_open']   = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open']    = "<li>";
        $config['last_tagl_close']  = "</li>";
        $this->pagination->initialize($config); 
        
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data['result'] = $this->EmployeeModel->get_employee_list($config['per_page'],$page);
		$data['links']  = $this->pagination->create_links();
		if($rolecheck=="admin")
		{	
            $this->load->model('HeaderModel');
		    $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		    $data['count_msg']=$this->HeaderModel->count_msg();
		    $this->load->view('admin/admin_header',$data);
		    $this->load->view('employee/employee_list',$data);
			$this->load->view('admin/admin_footer');
		}	
		if($rolecheck=="manager")
		{	
		    $this->load->model('HeaderModel');
		    $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		    $data['count_msg']=$this->HeaderModel->count_msg();
			$this->load->view('manager/manager_header',$data);
			$this->load->view('employee/employee_list_manager',$data);
			$this->load->view('manager/manager_footer');
		}	
	}
	public function edit()
	{
		$row=array();
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
		if($rolecheck!="admin" && $rolecheck!="manager")
			return redirect('Login');
		
		$this->load->model('EmployeeModel');
		$employee_id=$_POST['employee_id'];

		$row=$this->EmployeeModel->get_employee($employee_id);
		foreach($row as $a)
		{
		    $post=$a->role;
		}
		$row['mydata']=$row[0];
				$row['designation']=$this->EmployeeModel->get_post();
		if($rolecheck=="admin")
		{	
			$this->load->model('HeaderModel');
		    $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		    $data['count_msg']=$this->HeaderModel->count_msg();
		    $this->load->view('admin/admin_header',$data);	   
   if($post=="employee")
		     $this->load->view('employee/update_employee_option',$row);
		   else
		    $this->load->view('employee/update_employee',$row);
			$this->load->view('admin/admin_footer');
		}	
		if($rolecheck=="manager")
		{	
		    $this->load->model('HeaderModel');
		    $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		    $data['count_msg']=$this->HeaderModel->count_msg();
			$this->load->view('manager/manager_header',$data);
			if($post=="employee")
		     $this->load->view('employee/update_employee_option',$row);
		   else
		    $this->load->view('employee/update_employee',$row);
		
			$this->load->view('manager/manager_footer');
		}	
	}
	public function update_employee()
	{
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
	    if($rolecheck!="admin" && $rolecheck!="manager")
			return redirect('Login');
		
		if($_POST['employee_id']=="")
		{
		   	
			return redirect('ViewEmployee/get_employee_list');
			
		}
		else
		{	
			$this->load->model('EmployeeModel');
			$a = $this->EmployeeModel->check_username($_POST['username']);
			if($a > 0)
			{
         	            $this->session->set_flashdata('duplicate','Username not available');			
            		    return redirect('ViewEmployee/get_employee_list');
			}			
			$this->first_name=$_POST['first_name'];
			$this->middle_name=$_POST['middle_name'];
			$this->last_name=$_POST['last_name'];
			//$this->father_name=$_POST['father_name'];
			$this->mobile=$_POST['mobile'];
			$this->email=$_POST['email'];
			$this->username=$_POST['username'];
			$this->role=$_POST['role'];
			$this->subpost=$_POST['subpost'];
			$this->employee_id=$_POST['employee_id'];
			
		    $this->EmployeeModel->update_employee($this);
			$this->session->set_flashdata('update','Updated successfully...');
			return redirect('ViewEmployee/get_employee_list');
		}	
	}
	public function delete_emp()
	{
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
		if($rolecheck!="admin" && $rolecheck!="manager")
			return redirect('Login');
		
		$employee_id=$_POST['employee_id'];
		$this->load->model('EmployeeModel');
		$this->EmployeeModel->delete_employee($employee_id);
		
		
		$this->session->set_flashdata('delete','Employee deleted ...');
			
			return redirect('ViewEmployee/get_employee_list');
	}
	
	public function reset_password()
	{
	    $row=$this->session->userdata('my_session');	
		if($row['role']!="admin")
	    	return redirect('Login');
				$this->load->model('HeaderModel');
				$this->load->model('EmployeeModel');
				$user=$_POST['employee_id'];//print_r($_POST);
		
		$data['user']=$this->EmployeeModel->getUserP();
                $data['data']=$this->EmployeeModel->get_employee_data($user);
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);//print_r($data);
		$data['count_msg']=$this->HeaderModel->count_msg();
		$this->load->view('admin/admin_header',$data);  
		$this->load->view('employee/change_password',$data);
		$this->load->view('admin/admin_footer');
	}
	
	public function admin_resets_password()
	{
	    $row=$this->session->userdata('my_session');	
		//if(($row['role']!="employee") || ($row['role']!="researcher"))
	     	//return redirect('Login');
		$role = $row['role'].'/'.$row['role'].'_dashboard';	
		$rol = $row['role'].$row['role'].'change_password';	
		$user_id=$_POST['employee_id'];
		$new_pswd=password_hash($_POST['new_pswd'], PASSWORD_DEFAULT, ['cost' => 12]);
		$this->load->model('EmployeeModel');
		$isUpdated=$this->EmployeeModel->resetPassword($user_id,$new_pswd);
		if($isUpdated)
		{
			$this->session->set_flashdata('registered','Password sucessfully changed');
			
			return redirect($role);
		}
		else
		{
			$this->session->set_flashdata('registered','Password not changed');
			
			return redirect($rol);
		}
		
	}
	
	public function lead_record()
	{
 		$row=$this->session->userdata('my_session');	
		if($row['role']!="admin")
			return redirect('Login');
		//	$row=array();
		date_default_timezone_set("Asia/Kolkata");
		$date_today= date("Y-m-d");
		$employeeid= $_POST['employee_id'];
		$this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
		$this->load->model('EmployeeModel');
		$user=$_POST['employee_id'];//print_r($_POST);
		$data['data']=$this->EmployeeModel->get_employee_data($user);
		
		$this->load->model('LeadModel');
		$data['target'] = $this->LeadModel->count_target_assign($employeeid);
		$data["result1"]=$this->LeadModel->count_lead_emp($employeeid,$date_today);
		//print_r ($data["result1"]);
		$data["result2"]=$this->LeadModel->count_freetrial_emp($employeeid,$date_today);
		$data["result3"]=$this->LeadModel->count_client_emp($employeeid,$date_today);
		$data["result4"]=$this->LeadModel->count_total_calls($employeeid);
		$data["result6"]=$this->LeadModel->count_unapprove_client_emp($employeeid);
		$data["result7"]=$this->LeadModel->count_unapprove_free_emp($employeeid);
		
		$data["result5"]=$this->LeadModel->count_target_achive($employeeid);
		$data["msg"]=$this->HeaderModel->fetch_limited_msg($row['employee_id']);
		$d=$this->HeaderModel->fetch_calls();
		foreach($d as $a)
		{
               $data['message'][]=$this->HeaderModel->fetch_message_calls($a->message_id);
		}
		$this->load->view('admin/admin_header',$data);
		$this->load->view('admin/lead_record',$data);
		$this->load->view('admin/admin_footer');
		
			   
		
	} 
	
	public function target_assigned()
	{
//echo "target";
$row=$this->session->userdata('my_session');	
		if($row['role']!="admin")
			return redirect('Login');
			//$row=array();
		$employeeid= $_POST['employee_id'];
$this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
		$this->load->model('EmployeeModel');
		$user=$_POST['employee_id'];//print_r($_POST);
		$data['data']=$this->EmployeeModel->get_employee_data($user);
		$this->load->view('admin/admin_header',$data);  
		$this->load->view('admin/target_assigned');
		$this->load->view('admin/admin_footer');

	}
public function get_target_assigned()
{

$row=$this->session->userdata('my_session');	
		if($row['role']!="admin")
	     	return redirect('Login');
	     	$this->load->model('EmployeeModel');
		$target_data=array(	
		'employee_id'=>$_POST['employee_id'],
			'target_assign'=>$_POST['target_assign'],
			'start_date'=>$_POST['start_date'],
			'end_date'=>$_POST['end_date']);
		/*$user_id=$_POST['employee_id'];
		$target=$_POST["target_assign"];
		$start_date=$_POST["start_date"];
		$start_end=$_POST["end_date"];);*/
		
		$this->EmployeeModel->target_assigned($target_data);
		
			
			return redirect('Admin/admin_dashboard');
		
		
	
}
}
?>
