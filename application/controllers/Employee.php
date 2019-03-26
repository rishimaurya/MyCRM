<?php ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Employee extends CI_Controller {
	public function employee_dashboard()
	{
		$row=$this->session->userdata('my_session');		
		 
		 if($row['role']=="employee")
	    {
	        $employeeid= $row['employee_id'];
		  $this->load->model('HeaderModel');
		$d=$this->HeaderModel->welcome($row['employee_id']); 
		
		foreach($d as $a)
		{
		  $data['status']=$a->welcome_status;
		  if($a->welcome_status == "0")
		     $this->HeaderModel->update_welcome_status($row['employee_id']);
		}
		    date_default_timezone_set("Asia/Kolkata");
		    $date_today= date("Y-m-d");
		    $data['welcome_employee']=$row['first_name']." ".$row['last_name'];
		    $data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		    $data['count_msg']=$this->HeaderModel->count_msg();
		    $this->load->model('LeadModel');
		    $data['delete'] = $this->HeaderModel->delete_services();		    
		    $results = $this->LeadModel->get_chart_data();
        $data['chart_data'] = $results['chart_data'];
        $data['target'] = $this->LeadModel->count_target_assign($employeeid);
        //$data['target'] = $results1['target'];
       // print_r ($data['target']);
		$data["result1"]=$this->LeadModel->count_lead_emp($employeeid,$date_today);
		//print_r ($data["result1"]);
		$data["result2"]=$this->LeadModel->count_freetrial_emp($employeeid,$date_today);
		$data["result3"]=$this->LeadModel->count_client_emp($employeeid,$date_today);
		$data["result6"]=$this->LeadModel->count_unapprove_client_emp($employeeid);
		$data["result7"]=$this->LeadModel->count_unapprove_free_emp($employeeid);
		$data["result4"]=$this->LeadModel->count_total_calls($employeeid);
		$data["result5"]=$this->LeadModel->count_target_achive($employeeid);
		   $data["msg"]=$this->HeaderModel->fetch_limited_msg($row['employee_id']);
		$d=$this->HeaderModel->fetch_calls();
		foreach($d as $a)
		{
               $data['message'][]=$this->HeaderModel->fetch_message_calls($a->message_id);
		}
		   
		    $this->load->view('employee/employee_header',$data);	
		  $this->load->view('employee/employee_page');
		  $this->load->view('employee/employee_footer');
		}
		else
		{
			return redirect('Login');
		}	 		 
	}
    public function settings()
	{
		$row=$this->session->userdata('my_session');		
		if($row['role']!="employee")
			return redirect('Login');
			
		$this->load->model('HeaderModel');
		    $data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		    $data['count_msg']=$this->HeaderModel->count_msg();
		    $this->load->view('employee/employee_header',$data);
		$this->load->view('settings');
		$this->load->view('employee/employee_footer');
	}
	
	public function viewLeads()
	{
		$row=$this->session->userdata('my_session');		
		if($row['role']!="employee")
			return redirect('Login');
	
	/*	Pagination Technique for View Leads.*/
		$data   = array();
		$this->load->model('EmployeeModel');
		$this->load->library('pagination');
		$this->load->helper('url');
		//$this->load->library('acl');
		
		$config['base_url'] = base_url().'/Employee/viewLeads/';
        $config['total_rows'] = $this->EmployeeModel->count_emp();;
        $config['per_page'] = 50;
        $config['uri_segment'] = 3;
        $config['suffix'] ='';
        
    //Styling Link for Pagination. 
        
        $config['full_tag_open']    = "<ul class='pagination'>";
        $config['full_tag_close']   = "</ul>";
        $config['num_tag_open']     = "<li>";
        $config['num_tag_close']    = "</li>";
        $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close']    = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open']    = "<li>";
        $config['next_tag_close']  = "</li>";
        $config['prev_tag_open']    = "<li>";
        $config['prev_tag_close']  = "</li>";
        $config['first_tag_open']   = "<li>";
        $config['first_tag_close'] = "</li>";
        $config['last_tag_open']    = "<li>";
        $config['last_tag_close']  = "</li>";
        $this->pagination->initialize($config); 
        
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['count']=$page;
		$data['result'] = $this->EmployeeModel->get_emp_leads($config['per_page'],$page);
		$data['links']  = $this->pagination->create_links();
	
	// $data['result'] = $this->EmployeeModel->get_emp_leads();
           $data['services'] = $this->EmployeeModel->selectServices();
		$this->load->model('HeaderModel');
		    $data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		    $data['count_msg']=$this->HeaderModel->count_msg();
		    $url = substr($_SERVER['REQUEST_URI'],1);
		   $this->session->set_userdata('cpage',$url);//echo $_SESSION['cpage'];
		    $this->load->view('employee/employee_header',$data);
		$this->load->view('leads/viewLeadsEmp', $data);
		$this->load->view('employee/employee_footer');
	}
	
	public function view_todays_leads()
	{
		$row=$this->session->userdata('my_session');		
		if($row['role']!="employee")
			return redirect('Login');
	
	/*	Pagination Technique for View Leads.*/
		$data   = array();
		$this->load->model('EmployeeModel');
		$this->load->library('pagination');
		$this->load->helper('url');
		//$this->load->library('acl');
		
		$config['base_url'] = base_url().'/Employee/view_todays_leads/';
        $config['total_rows'] = $this->EmployeeModel->count_todays_leads();;
        $config['per_page'] = 50;
        $config['uri_segment'] = 3;
        $config['suffix'] ='';
        
    //Styling Link for Pagination. 
        
        $config['full_tag_open']    = "<ul class='pagination'>";
        $config['full_tag_close']   = "</ul>";
        $config['num_tag_open']     = "<li>";
        $config['num_tag_close']    = "</li>";
        $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close']    = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open']    = "<li>";
        $config['next_tag_close']  = "</li>";
        $config['prev_tag_open']    = "<li>";
        $config['prev_tag_close']  = "</li>";
        $config['first_tag_open']   = "<li>";
        $config['first_tag_close'] = "</li>";
        $config['last_tag_open']    = "<li>";
        $config['last_tag_close']  = "</li>";
        $this->pagination->initialize($config); 
        
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['count']=$page;
		$data['result'] = $this->EmployeeModel->get_emp_todays_leads($config['per_page'],$page);
		$data['links']  = $this->pagination->create_links();
	
	// $data['result'] = $this->EmployeeModel->get_emp_leads();
           $data['services'] = $this->EmployeeModel->selectServices();
		$this->load->model('HeaderModel');
		    $data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		    $data['count_msg']=$this->HeaderModel->count_msg();
		    $url = substr($_SERVER['REQUEST_URI'],1);
		   $this->session->set_userdata('cpage',$url);//echo $_SESSION['cpage'];
		    $this->load->view('employee/employee_header',$data);
		$this->load->view('leads/viewTodaysLeadsEmp', $data);
		$this->load->view('employee/employee_footer');
	}
	
	public function importLeads()
	{
		$row=$this->session->userdata('my_session');		
		if($row['role']!="employee")
			return redirect('Login');
	
		$this->load->model('HeaderModel');
		    $data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		    $data['count_msg']=$this->HeaderModel->count_msg();
		    $this->load->view('employee/employee_header',$data);
			$this->load->view('leads/leads_excel');
		$this->load->view('employee/employee_footer');	
	}
	public function register_leads()
	{
		$row=$this->session->userdata('my_session');		
		if($row['role']!="employee")
			return redirect('Login');
	
    	$this->load->model('LeadModel');
	    $data['services']=$this->LeadModel->show_services();
		$this->load->model('HeaderModel');
		    $data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		    $data['count_msg']=$this->HeaderModel->count_msg();
		    $this->load->view('employee/employee_header',$data);
			$this->load->view('leads/leads',$data);
		$this->load->view('employee/employee_footer');
	}
	public function todays_followup()  
	{
		$row=$this->session->userdata('my_session');		
		if($row['role']!="employee")
			return redirect('Login');
	
		/*	Pagination Technique for View Leads.*/
		$data   = array();
		$this->load->model('EmployeeModel');
		$this->load->library('pagination');
		$this->load->helper('url');
		//$this->load->library('acl');
		
		$config['base_url'] = base_url().'/Employee/todays_followup/';
        $config['total_rows'] = $this->EmployeeModel->count_follow_up_date_emp('client');;
        $config['per_page'] = 20;
        $config['uri_segment'] = 3;
        $config['suffix'] ='';
        
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

		$data['result'] = $this->EmployeeModel->get_todays_followup($config['per_page'],$page);
		$data['links']  = $this->pagination->create_links();
		
			$this->load->model('HeaderModel');
		    $data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		    $data['count_msg']=$this->HeaderModel->count_msg();
		    $this->load->view('employee/employee_header',$data);
			$this->load->view('leads/viewlead_empcom', $data);
			$this->load->view('employee/employee_footer');
		
	}
	public function comment_history()
	{
		$row=$this->session->userdata('my_session');		
		if($row['role']!="employee")
			return redirect('Login');
	
	    //$data['result'] = $this->LeadModel->get_comment_history_emp($empid);
        
        /*	Pagination Technique for View Leads.*/
		$data   = array();
		$this->load->model('HeaderModel');
		$this->load->model('LeadModel');
		$this->load->library('pagination');
		$this->load->helper('url');
		//$this->load->library('acl');
		
		$config['base_url'] = base_url().'Employee/comment_history/';
        $config['total_rows'] = $this->LeadModel->count_get_comment_history_emp();

        $config['per_page'] = 20;
        $config['uri_segment'] = 3;
        $config['suffix'] ='';
        
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

		$data['result'] = $this->LeadModel->get_comment_history_emp($config['per_page'],$page);
		$data['links']  = $this->pagination->create_links();
	    
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
		
        
	    $this->load->view('employee/employee_header',$data);
		$this->load->view('leads/comment_history', $data);
		$this->load->view('employee/employee_footer');
	
	}
	public function change_password()
	{
		$row=$this->session->userdata('my_session');		
		//if($row['role']="employee")
		//	return redirect('Login');
	       $this->load->model('HeaderModel');
	       $data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
	       $data['count_msg']=$this->HeaderModel->count_msg();
               $this->load->view('employee/employee_header',$data);
               $this->load->view('employee/change_password');
               $this->load->view('employee/employee_footer');
	}
	
	public function update_password()
	{
		$row=$this->session->userdata('my_session');		
		if($row['role']!="employee")
			return redirect('Login');
	
		if($_POST['old_pswd']!="")
		{
			$this->old_pswd=$_POST['old_pswd'];
			$this->new_pswd=password_hash($_POST['new_pswd'], PASSWORD_DEFAULT, ['cost' => 12]);
			$this->load->model('UpdateProfile');
			$isUpdated=$this->UpdateProfile->updatePassword($this);
			if($isUpdated)
			{
				$this->session->set_flashdata('registered','password sucessfully changed');
				
				return redirect('Employee/employee_dashboard');
			}
			else
			{
				$this->session->set_flashdata('error','password not changed');
				
				$this->load->view('employee/change_password');
			}
		}
		else
			return redirect('Employee/change_password');
	}
	
	
	
	public function update()
	{
		$row=$this->session->userdata('my_session');		
		if($row['role']!="employee" and $row['role']!="researcher")
			return redirect('Login');
	       
		$this->load->model('HeaderModel');
	       $data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
	       $data['count_msg']=$this->HeaderModel->count_msg();
               if($row['role']=="employee")
              {
                 $this->load->view('employee/employee_header',$data);
                 $this->load->view('employee/employee_update');
               	 $this->load->view('employee/employee_footer');
              }
               if($row['role']=="researcher")
              {
                 $this->load->view('researcher/researcher_header',$data);
                 $this->load->view('employee/employee_update');
               	 $this->load->view('researcher/researcher_footer');
              }

         }

	public function update_profile()
	{
		$row=$this->session->userdata('my_session');		
		if($row['role']!="employee")
			return redirect('Login');
	
		//Using Form Entries
		if($_POST['first_name']!="")
		{
			$this->first_name=$_POST['first_name'];
			$this->middle_name=$_POST['middle_name'];
			$this->last_name=$_POST['last_name'];
			$this->father_name=$_POST['fname'];
			$this->mobile=$_POST['mobile'];
			$this->email=$_POST['email'];
			$this->address=$_POST['address'];
			$this->dob=$_POST['dob'];
			//Loading Model
			$this->load->model('UpdateProfile');
			$this->UpdateProfile->update_user($this);
			//LOADING vIEW
			$this->session->set_flashdata('profile','profile updated sucessfully...');
			return redirect('Employee/employee_dashboard');
		}
		else 
			return redirect('Employee/employee_dashboard');
	}
	
	public function timeline()
	{
		$row=$this->session->userdata('my_session');	
		if($row['role']!="employee")
	    	return redirect('Login');
		
            $this->load->model('HeaderModel');
		    $data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		    $data['count_msg']=$this->HeaderModel->count_msg();
		    $this->load->view('employee/employee_header',$data);
			$this->load->model('TimelineModel');
			$data['detail']=$this->TimelineModel->general_details();
			$data['userpost']=$this->TimelineModel->fetch_users();
			$data['user']=$this->TimelineModel->fetch_all_users();
			$this->load->view('timeline/timeline_employee',$data);
		$this->load->view('employee/employee_footer');

	}
	
	public function fetch_msg()
	{
	   $row=$this->session->userdata('my_session');
	   $this->load->model('TimelineModel');
	   $data['message']=$this->TimelineModel->fetch_message($row['employee_id']);
	   $data['update']= $this->TimelineModel->update($row['employee_id']);
	   $this->load->view('employee/fetch',$data);
	}
	
	public function TimelineMessage()
	{
	 	 $row=$this->session->userdata('my_session');	
		   if($row['role']!="employee")
	       return redirect('Login');
		
		 $this->load->model('TimelineModel');    
	     $message=$this->input->post('message');
	     date_default_timezone_set('Asia/Kolkata');
	     $datetime= date('Y-m-d H:i:s');	     
	     foreach($_POST['array'] as $id)
	     {
		     $send = array(
		        'reciever_id' => $id,
		        'sender_id' => $row['employee_id'],
		        'sender_name' =>  ucfirst($row['first_name'])." ". ucfirst($row['last_name']) ,
		        'message_text'=>$message,
		        'msg_date'=> date('Y-m-d'),
		        'msg_time'=> date('H:i:s')
		     );
		  $this->session->set_flashdata('insert','Message Send Sucessfully');   
		  $this->TimelineModel->send_message($send);
		 }
	    
				return redirect('Employee/Timeline');
		
	     
	}
    
    public function inbox()
    {
        $row=$this->session->userdata('my_session');	
		if($row['role']!="employee")
	    	return redirect('Login');
        
        $this->load->model('HeaderModel');
		
		/*	Pagination Technique for View Leads.*/
		$data   = array();
		$this->load->library('pagination');
		$this->load->helper('url');
		//$this->load->library('acl');
		
		$config['base_url'] = base_url().'/Employee/inbox/';
        $config['total_rows'] = $this->HeaderModel->count_fetch_message();
        $config['per_page'] = 20;
        $config['uri_segment'] = 3;
        $config['suffix'] ='';
        
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

		$data['message'] = $this->HeaderModel->fetch_message($config['per_page'],$page);
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg($row['employee_id']);
		
		$data['links']  = $this->pagination->create_links();
		//$data['message']=$this->HeaderModel->fetch_message();
		
		 $this->load->view('employee/employee_header',$data);
		$this->load->view('timeline/inbox_employee', $data);
		$this->load->view('employee/employee_footer');  
        
    }
    
    
    public function reply()
	{
	 	 $row=$this->session->userdata('my_session');	
		   if($row['role']!="employee")
	       return redirect('Login');
		
		 $this->load->model('TimelineModel');    
	     $message=$this->input->post('message');
	     date_default_timezone_set('Asia/Kolkata');
	     
		    $send = array(
		        'reciever_id' => $_POST['reciever_id'],
		        'sender_id' => $row['employee_id'],
		        'sender_name' =>  ucfirst($row['first_name'])." ". ucfirst($row['last_name']) ,
		        'msg_reply_id'=>$_POST['message_id'], 
		        'message_text'=>$message,
		        'msg_date'=> date('Y-m-d'),
		        'msg_time'=> date('H:i:s')
		     );
		  $this->session->set_flashdata('insert','Message Send Sucessfully');   
		  $this->TimelineModel->send_message($send);
		 
	    
				return redirect('Employee/inbox');
		
	     
	}
	public function remark()
	{
	  	 $row=$this->session->userdata('my_session');	
		   if($row['role']!="employee")
	       return redirect('Login');
	        $data   = array();
             $this->load->model('EmployeeModel');
	       $clientid=$_POST['client'];
	       //print_r ( $_POST);
	       
	       $employeeid= $row['employee_id'];
	       $data   = array();
        $this->load->model('EmployeeModel');
		$data['result'] = $this->EmployeeModel->get_remark($employeeid,$clientid);

		$this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
		$this->load->view('employee/employee_header',$data);
	    $this->load->view('leads/comment_history', $data);
		$this->load->view('employee/employee_footer');
    
	       
	}
	public function target_emp()
	{
			$row=$this->session->userdata('my_session');	
		   if($row['role']!="employee")
	       return redirect('Login');
	         
	   /*	Pagination Technique for View Leads.*/
		$data   = array();
		$this->load->model('EmployeeModel');
        $this->load->library('pagination');
		$this->load->helper('url');
		//$this->load->library('acl');
		
		$config['base_url'] = base_url().'/Employee/target_emp/';
        $config['total_rows'] = $this->EmployeeModel->count_target_emp($row['employee_id']);
        $config['per_page'] = 20;
        $config['uri_segment'] = 3;
        $config['suffix'] ='';
        
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

	    $this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
		$data['result']=$this->EmployeeModel->target_emp($row['employee_id'],$config['per_page'],$page);
	    $data['links']  = $this->pagination->create_links();
           
            $this->load->view('employee/employee_header',$data);
			$this->load->view('employee/view_target',$data);
			$this->load->view('employee/employee_footer');
             
	}
	public function target_achieve()
	{
		$row=$this->session->userdata('my_session');	
		   if($row['role']!="employee")
	       return redirect('Login');
	       $this->load->model('EmployeeModel');
	       $target_id=$_POST['target_id'];
	      // echo $target_id;
	      $data['data']=$this->EmployeeModel->get_target_data($target_id);
	      $this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
	      $this->load->view('employee/employee_header',$data);
			$this->load->view('employee/target_achieve',$data);
			$this->load->view('employee/employee_footer');
	        
	}
	public function get_target_achieve()
	{
		$row=$this->session->userdata('my_session');	
		   if($row['role']!="employee")
	       return redirect('Login');
	       $this->load->model('EmployeeModel');
	       $target_data=array(	
		'target_id'=>$_POST['target_id'],
			'target_achieve'=>$_POST['target_achieve'],
			'achieve_date'=>$_POST['achieve_date']);
			$this->EmployeeModel->target_achieve($target_data);
			return redirect('Employee/employee_dashboard');
		
	}
	public function target_history()
	{
		//echo "history";
		$row=$this->session->userdata('my_session');	
		   if($row['role']!="employee")
	       return redirect('Login');
	       $this->load->model('EmployeeModel');
	       $target_id=$_POST['target_id'];
	       $data['result']=$this->EmployeeModel->target_history($target_id);
	       $this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
	       $this->load->view('employee/employee_header',$data);
			$this->load->view('employee/target_history',$data);
			$this->load->view('employee/employee_footer');
	      
	       
	}
	public function total_achieve()
	{
				$row=$this->session->userdata('my_session');	
		   if($row['role']!="employee")
	       return redirect('Login');
	       $this->load->model('EmployeeModel');
	       $target_id=$_POST['target_id'];
	      // echo $target_id;
	      $data['data']=$this->EmployeeModel->get_target_total($target_id);
	      $this->load->model('HeaderModel');
		  $data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		  $data['count_msg']=$this->HeaderModel->count_msg();
	      $this->load->view('employee/employee_header',$data);
		  $this->load->view('employee/total_achieve',$data);
		  $this->load->view('employee/employee_footer');

	}
	public function graph()
	{
		//echo "graph";
	}
			
			
}
?>
