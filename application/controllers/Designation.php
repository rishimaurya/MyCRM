<?php ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');


class Designation extends CI_Controller {
     public function addDesignation()
	{   
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
		if($rolecheck!="admin")
			return redirect('Login');
		
		if($rolecheck=="admin")
		{		
			$this->load->model('HeaderModel');
		    $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		    $data['count_msg']=$this->HeaderModel->count_msg();
		    $this->load->view('admin/admin_header',$data);
			$message['msg']="";
			$this->load->view('designation/add_designation',$message);
			$this->load->view('admin/admin_footer');
		}
   }
   
   public function insertDesignation()
   {
	    $sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];

		   if($rolecheck!="admin")
			return redirect('Login');
	       
	       if($_POST['designation']=="")
		{
		   	if($rolecheck=="admin")
				return redirect('Admin/admin_dashboard');
						
		}
	       
	        $this->load->model('AddDesignationModel');
			
			$designation=$_POST['designation'];   		

			$check_exist=$this->AddDesignationModel->check($designation);
			$check_exist= $check_exist->result();
			if($check_exist==null)
			{
		 
				$this->designation=$_POST['designation'];
			    $this->AddDesignationModel->insert_designation($this);
				$this->session->set_flashdata('insert','Designation Added Sucessfully');   
		  		return redirect('Designation/addDesignation');
		
			}
	     else
			{
				$message['msg']="username already exist";
				if($rolecheck=="admin")
				{		
			$this->load->model('HeaderModel');
		    $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		    $data['count_msg']=$this->HeaderModel->count_msg();
		    $this->load->view('admin/admin_header',$data);					
			$this->load->view('designation/add_designation',$message);
					$this->load->view('admin/admin_footer');
				}	
			}
      }
      
      public function viewDesignation()
      {
         $sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
		if($rolecheck!="admin")
			return redirect('Login');
		
		if($rolecheck=="admin")
		{		
			$this->load->model('HeaderModel');
		    $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		    $this->load->model('AddDesignationModel');
		    $data['count_msg']=$this->HeaderModel->count_msg();
			$this->load->view('admin/admin_header',$data);
			$row['designation']=$this->AddDesignationModel->view();
			$this->load->view('designation/view',$row);
			$this->load->view('admin/admin_footer');
		} 
          
      }
      
      
      	
      	public function delete()
	{
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
	    if($rolecheck=="")
				return redirect('Login');
		$row=$this->session->userdata('my_session');	
		if($row['role']!="admin")
			return redirect('Login');
		
		$designation_id=$_POST['designation_id'];
		$this->load->model('AddDesignationModel');
		$this->AddDesignationModel->delete($designation_id);
		$this->session->set_flashdata('delete','Designation deleted Sucessfully');
		return redirect('Designation/viewDesignation');
	}
	
	public function edit()
	{
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
	    if($rolecheck=="")
				return redirect('Login');
		$row=$this->session->userdata('my_session');	
		if($row['role']!="admin")
			return redirect('Login');

			$this->load->model('AddDesignationModel');
			$data=$this->AddDesignationModel->edit($_POST['designation_id']);
			$data['designation']=$data[0];
			if($rolecheck=="admin")
			{
				$this->load->model('HeaderModel');
		        $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		        $data['count_msg']=$this->HeaderModel->count_msg();
		        $this->load->view('admin/admin_header',$data);
				$this->load->view('designation/update',$data);
				$this->load->view('admin/admin_footer');
			}
			
	}

    public function update()
    {
        $sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
	    if($rolecheck=="")
				return redirect('Login');
		$row=$this->session->userdata('my_session');	
		if($row['role']!="admin")
			return redirect('Login');
		
		$this->id=$_POST['designation_id'];
		$this->designation=$_POST['designation'];
		
		$this->load->model('AddDesignationModel');
		$this->AddDesignationModel->update($this);
	    $this->session->set_flashdata('update','Designation updated Sucessfully');
		return redirect('Designation/viewDesignation');
    }
}
?>
