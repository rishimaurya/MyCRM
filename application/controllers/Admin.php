<?php ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');


class Admin extends CI_Controller {
	
	public function admin_dashboard()
	{
		$row=$this->session->userdata('my_session');	
		if($row['role']!="admin")
			return redirect('Login');
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

		$data['target'] = $this->LeadModel->count_target_assign_all($row['employee_id']);
		$data["result1"]=$this->LeadModel->count_lead($date_today);
		$data["result2"]=$this->LeadModel->count_freetrial();
		$data["result3"]=$this->LeadModel->count_client();
		$data["result6"]=$this->LeadModel->count_unapprove_client();
		$data["result7"]=$this->LeadModel->count_unapprove_free();
         
		$data["result4"]=$this->LeadModel->count_total_calls_all($row['employee_id']);
		$data["result5"]=$this->LeadModel->count_target_achive_all($row['employee_id']);
		$data["msg"]=$this->HeaderModel->fetch_limited_msg($row['employee_id']);
		$d=$this->HeaderModel->fetch_calls();
		foreach($d as $a)
		{
               $data['message'][]=$this->HeaderModel->fetch_message_calls($a->message_id);
		}

		$this->load->view('admin/admin_header',$data);
		$this->load->view('admin/admin_page',$data);
		$this->load->view('admin/admin_footer');
	  
	}
	public function update()
	{
		$row=$this->session->userdata('my_session');	
		if($row['role']!="admin")
	    	return redirect('Login');
		$this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
		$this->load->view('admin/admin_header',$data);  
		$this->load->view('admin/admin_update');
		$this->load->view('admin/admin_footer');
		
	}
	public function update_profile()
	{
		$row=$this->session->userdata('my_session');	
		if($row['role']!="admin")
	    	return redirect('Login');

		//Using Form Entries
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
			$this->session->set_flashdata('profile','profile sucessfully updated');
		return redirect('Admin/admin_dashboard');
	}
	public function change_password()
	{
		$row=$this->session->userdata('my_session');	
		if($row['role']!="admin")
	    	return redirect('Login');
				$this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
		$this->load->view('admin/admin_header',$data);  
		$this->load->view('admin/change_password');
		$this->load->view('admin/admin_footer');  
		
		
	}
	public function update_password()
	{
		$row=$this->session->userdata('my_session');	
		if($row['role']!="admin")
	     	return redirect('Login');
			
		$this->old_pswd=$_POST['old_pswd'];
		$this->new_pswd=password_hash($_POST['new_pswd'], PASSWORD_DEFAULT, ['cost' => 12]);
		$this->load->model('UpdateProfile');
		$isUpdated=$this->UpdateProfile->updatePassword($this);
		if($isUpdated)
		{
			$this->session->set_flashdata('registered','password sucessfully changed');
			
			return redirect('Admin/admin_dashboard');
		}
		else
		{
			$this->session->set_flashdata('error','password not changed');
			
			$this->load->view('admin/change_password');
		}
		
	}
	public function register_leads()
	{
		$row=$this->session->userdata('my_session');	
		if($row['role']!="admin")
	    	return redirect('Login');
		
		$this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
		$this->load->model('LeadModel');
	    $data['services']=$this->LeadModel->show_services();
		$this->load->view('admin/admin_header',$data);
			$this->load->view('leads/leads',$data);
		$this->load->view('admin/admin_footer');

	}
	
	public function timeline()
	{
		$row=$this->session->userdata('my_session');	
		if($row['role']!="admin")
	    	return redirect('Login');
		
            $this->load->model('HeaderModel');
		    $data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		    $data['count_msg']=$this->HeaderModel->count_msg();
		    $this->load->view('admin/admin_header',$data);
			$this->load->model('TimelineModel');
			$data['detail']=$this->TimelineModel->general_details();
			$data['userpost']=$this->TimelineModel->fetch_users();
			$data['user']=$this->TimelineModel->fetch_all_users();
			$this->load->view('timeline/timeline',$data);
		    $this->load->view('admin/admin_footer');

	}
	
	public function fetch_msg()
	{
	   $row=$this->session->userdata('my_session');
	   $this->load->model('TimelineModel');
	   $data['message']=$this->TimelineModel->fetch_message($row['employee_id']);
	   $data['update']= $this->TimelineModel->update($row['employee_id']);
	   $this->load->view('admin/fetch',$data);
	}
	
	public function TimelineMessage()
	{
	 	 $row=$this->session->userdata('my_session');	
		   if($row['role']!="admin")
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
		        'status'=>'0',
		        'msg_time'=> date('H:i:s')
		     );
		  $this->session->set_flashdata('insert','Message Send Sucessfully');   
		  $this->TimelineModel->send_message($send);
		 }
	    
				return redirect('Admin/Timeline');
		
	     
	}

	public function importLeads()
	{
		$row=$this->session->userdata('my_session');	
		if($row['role']!="admin")
	    	return redirect('Login');
		
		$this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
		$this->load->view('admin/admin_header',$data);
		$this->load->view('leads/leads_excel');
		$this->load->view('admin/admin_footer');	
	
	}
	
	public function viewLeads()
	{
		$row=$this->session->userdata('my_session');	
	    if($row['role']!="admin")
	    	return redirect('Login');
	/*	Pagination Technique for View Leads.*/
		$data   = array();
		$this->load->model('LeadModel');
		$this->load->library('pagination');
		$this->load->helper('url');
		//$this->load->library('acl');
		
		$config['base_url'] = base_url().'/Admin/viewLeads/';
        $config['total_rows'] = $this->LeadModel->count('client');;
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
		
		$data['result'] = $this->LeadModel->get_leads($config['per_page'],$page);
		$data['links']  = $this->pagination->create_links();
	    $data['services']=$this->LeadModel->selectServices();
	    $this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
                $url = substr($_SERVER['REQUEST_URI'],1);
		   $this->session->set_userdata('cpage',$url);//echo $_SESSION['cpage'];
		$this->load->view('admin/admin_header',$data);
		$this->load->view('leads/viewLeads', $data);
		$this->load->view('admin/admin_footer');
	
	}
	
	public function comment_history()
	{
		$row=$this->session->userdata('my_session');	
		if($row['role']!="admin")
	    	return redirect('Login');
		
		//$data['result'] = $this->LeadModel->get_comment_history();
		/*	Pagination Technique for View Leads.*/
		$data   = array();
		$this->load->model('HeaderModel');
		$this->load->model('LeadModel');
		$this->load->library('pagination');
		$this->load->helper('url');
		//$this->load->library('acl');
		
		$config['base_url'] = base_url().'Admin/comment_history/';
        $config['total_rows'] = $this->LeadModel->count_get_comment_history();

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

		$data['result'] = $this->LeadModel->get_comment_history($config['per_page'],$page);
		$data['links']  = $this->pagination->create_links();
	    
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
		
		
		$this->load->view('admin/admin_header',$data);//print_r($data);
			$this->load->view('leads/comment_history', $data);
		$this->load->view('admin/admin_footer');

	}

    public function inbox()
    {
        $row=$this->session->userdata('my_session');	
		if($row['role']!="admin")
	    	return redirect('Login');
        
        $this->load->model('HeaderModel');
		
		/*	Pagination Technique for View Leads.*/
		$data   = array();
		$this->load->library('pagination');
		$this->load->helper('url');
		//$this->load->library('acl');
		
		$config['base_url'] = base_url().'/Admin/inbox/';
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
		
		$this->load->view('admin/admin_header',$data);
		$this->load->view('timeline/inbox', $data);
		$this->load->view('admin/admin_footer');  
    
        
    }
    
    
    public function reply()
	{
	 	 $row=$this->session->userdata('my_session');	
		   if($row['role']!="admin")
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
		 
	    
				return redirect('Admin/inbox');
		
	     
	}
	
	public function tipArchive()
	{
	    $row=$this->session->userdata('my_session');	
		if($row['role']!="admin")
	    	return redirect('Login');
        
        $this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['message']=$this->HeaderModel->fetch_message($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg($row['employee_id']);
		$this->load->view('admin/admin_header',$data);
		$this->load->view('tip_archive', $data);
		$this->load->view('admin/admin_footer');
	    
	}
	
	public function fullChat()
	{
	    $row=$this->session->userdata('my_session');	
		if($row['role']!="admin")
	    	return redirect('Login');   
	    
	    /*	Pagination Technique for View Leads.*/
		$data   = array();
		$this->load->model('HeaderModel');
		$this->load->library('pagination');
		$this->load->helper('url');
		//$this->load->library('acl');
		
		$config['base_url'] = base_url().'Admin/fullchat/';
        $config['total_rows'] = $this->HeaderModel->count_full_chat();

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

		$data['all_message'] = $this->HeaderModel->load_full_chat($config['per_page'],$page);
		$data['links']  = $this->pagination->create_links();
	    
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
		$this->load->view('admin/admin_header',$data);
		$this->load->view('admin/fullchat', $data);
		$this->load->view('admin/admin_footer');	
	}
	public function generalDetails()
	{
		$row=$this->session->userdata('my_session');	
		if($row['role']!="admin")
	    	return redirect('Login');
	   $this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
	   $this->load->model('TimelineModel');
	   $data['detail']=$this->TimelineModel->general_details();	
		$this->load->view('admin/admin_header',$data);
		$this->load->view('general/general_view', $data);
		$this->load->view('admin/admin_footer');	
    }
    
    public function updateGeneral()
    {
	     $row=$this->session->userdata('my_session');	
		if($row['role']!="admin")
	    	return redirect('Login');
	    	
	     $this->load->model('TimelineModel');    
	  
	     $websitedetails=$this->input->post('websitedetails');
	      $this->session->set_flashdata('Update','Details Updated Sucessfully');   
		  $this->TimelineModel->insert_detail($websitedetails);
		 
	    
				return redirect('Admin/generalDetails');
	}
	
	public function addBank()
	{
		$row=$this->session->userdata('my_session');	
		if($row['role']!="admin")
	    	return redirect('Login');
	   $this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
	   
		$this->load->view('admin/admin_header',$data);
		$this->load->view('general/add_bank');
		$this->load->view('admin/admin_footer');
    }
    
    public function insertBank()
    {
		$row=$this->session->userdata('my_session');	
		   if($row['role']!="admin")
	       return redirect('Login');
		
		 $this->load->model('TimelineModel');    
	     $bank_name=$this->input->post('bank_name');
	     $account_no=$this->input->post('account_no');
		     $send = array(
		        'bank_name' => $bank_name,
		        'account_no' => $account_no     
		     );
		  $this->session->set_flashdata('insert','Bank Details Saved');   
		  $this->TimelineModel->insert_bank($send);
		 
	    
				return redirect('Admin/updateBank');
		
	}
	
	public function updateBank()
	{
	 $row=$this->session->userdata('my_session');	
		if($row['role']!="admin")
	    	return redirect('Login');
	   $this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
	    
	     $this->load->model('TimelineModel');    
	     $data['bank']=$this->TimelineModel->bank_details();
		$this->load->view('admin/admin_header',$data);
		$this->load->view('general/update',$data);
		$this->load->view('admin/admin_footer'); 
	}
	
	public function editBank()
	{
		$row=$this->session->userdata('my_session');	
		if($row['role']!="admin")
	    	return redirect('Login');
	   $this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
	    $this->load->model('TimelineModel');
	    $data['detail']=$this->TimelineModel->fetch_bank($_POST['bank_id']);	
		$this->load->view('admin/admin_header',$data);
		$this->load->view('general/editbank', $data);
		$this->load->view('admin/admin_footer');	

	}
	
	public function saveBank()
	{
	   	$row=$this->session->userdata('my_session');	
		   if($row['role']!="admin")
	       return redirect('Login');
		
		 $this->load->model('TimelineModel');    
	     $bank_name=$this->input->post('bank_name');
	     $account_no=$this->input->post('account_no');
		    
		  $this->session->set_flashdata('insert','Bank Details Saved');   
		  $this->TimelineModel->update_bank($_POST['id'],$bank_name,$account_no);
				return redirect('Admin/updateBank');
	}
	
	public function deleteBank()
	{
		$row=$this->session->userdata('my_session');	
		   if($row['role']!="admin")
	       return redirect('Login');
		
		 $this->load->model('TimelineModel');
		 $this->session->set_flashdata('delete','Bank Details deleted');   
		  $this->TimelineModel->delete_bank($_POST['bank_id']);
				return redirect('Admin/updateBank');

	}
     public function blockingUsers()
     {
         $row=$this->session->userdata('my_session');	
		   if($row['role']!="admin")
	       return redirect('Login');
	        $data   = array();
		$this->load->model('EmployeeModel');
		$this->load->library('pagination');
		$this->load->helper('url');
		//$this->load->library('acl');
		
		$config['base_url'] = base_url().'/Admin/blockingUsers';
        $config['total_rows'] = $this->EmployeeModel->count('users');
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

		$data['result'] = $this->EmployeeModel->get_employee_list($config['per_page'],$page);
		$data['links']  = $this->pagination->create_links();
			
            $this->load->model('HeaderModel');
		    $data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		    $data['count_msg']=$this->HeaderModel->count_msg();
		    $this->load->view('admin/admin_header',$data);
		    $this->load->view('admin/employee_list',$data);
			$this->load->view('admin/admin_footer');
			
     }
}

?>
