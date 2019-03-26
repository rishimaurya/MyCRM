<?php ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Researcher extends CI_Controller {
	public function researcher_dashboard()
	{
		$row=$this->session->userdata('my_session');	
		if($row['role']!="researcher")
	    	return redirect('Login');
	    	
		$this->load->model('HeaderModel');
		$d=$this->HeaderModel->welcome($row['employee_id']); 
		
		foreach($d as $a)
		{
		  $data['status']=$a->welcome_status;
		  if($a->welcome_status == "0")
		     $this->HeaderModel->update_welcome_status($row['employee_id']);
		}
		$data['welcome_employee']=$row['first_name']." ".$row['last_name'];
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();		 
		  $data["msg"]=$this->HeaderModel->fetch_limited_msg($row['employee_id']);
		$d=$this->HeaderModel->fetch_calls();
		foreach($d as $a)
		{
               $data['message'][]=$this->HeaderModel->fetch_message_calls($a->message_id);
		}
		$data['delete'] = $this->HeaderModel->delete_services();
		
		$this->load->model('LeadModel');
		$date=DATE('Y-m-d');
		$data['target'] = $this->LeadModel->count_target_assign_all($row['employee_id']);
		$data["result1"]=$this->LeadModel->count_lead($date);
		
		$data["result2"]=$this->LeadModel->count_freetrial();
		$data["result3"]=$this->LeadModel->count_client();
		$data["result4"]=$this->LeadModel->count_total_calls_all($row['employee_id']);
		$data["result5"]=$this->LeadModel->count_target_achive_all($row['employee_id']);
		  $this->load->view('researcher/researcher_header',$data);	
		  $this->load->view('researcher/researcher_page',$data);
		  $this->load->view('researcher/researcher_footer');
			 		 
	}
	public function options()
	{
	$row=$this->session->userdata('my_session');		
		
		if($row['role']=="researcher")
	    {
		$this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
		$this->load->model('ResearcherModel');
		$data['result']=$this->ResearcherModel->get_service();
		$this->load->view('researcher/researcher_header',$data);
		$this->load->view('researcher/options', $data);
		$this->load->view('researcher/researcher_footer');
	    }
	    
	   else if($row['role']=="admin")
	    {
		$this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
		$this->load->model('ResearcherModel');
		$data['result']=$this->ResearcherModel->get_service();
		$this->load->view('admin/admin_header',$data);
		$this->load->view('researcher/options', $data);
		$this->load->view('admin/admin_footer');
	    }
	    
	   else if($row['role']=="manager")
	    {
		$this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
		$this->load->model('ResearcherModel');
		$data['result']=$this->ResearcherModel->get_service();
		$this->load->view('manager/manager_header',$data);
		$this->load->view('researcher/options', $data);
		$this->load->view('manager/manager_footer');
	    }
	    else
		{
			return redirect('Login');
		}
	        
	}
	public function get_user()
	{
		$row=$this->session->userdata('my_session');		
		
		if($row['role']=="researcher")
	    {
		$this->load->model('ResearcherModel');
		$this->ResearcherModel->get_user();
	    }
	    else
		{
			return redirect('Login');
		}
	        
	 }
	public function all()
	{
		$row=$this->session->userdata('my_session');		
		
		if($row['role']=="researcher")
	    {
	    $this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
     	$this->load->view('researcher/researcher_header',$data);
     	$this->load->view('researcher/all');
		$this->load->view('researcher/researcher_footer');
	    }
	    else
		{
			return redirect('Login');
		}
	    
    }
	public function all_user()
	{
		$row=$this->session->userdata('my_session');		
		
		if($row['role']=="researcher")
	    {
		$this->load->model('ResearcherModel');
		$this->ResearcherModel->all_user();
	    }
	    else
		{
			return redirect('Login');
		}
	        
	  }
	
	public function timeline()
	{
     	$row=$this->session->userdata('my_session');		
		
		if($row['role']=="researcher")
	    {
	        $this->load->model('HeaderModel');
		    $data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		    $data['count_msg']=$this->HeaderModel->count_msg();
		    $this->load->view('researcher/researcher_header',$data);
			$this->load->model('TimelineModel');
			//$data['detail']=$this->TimelineModel->general_details();
			$data['userpost']=$this->TimelineModel->fetch_users();
			$data['user']=$this->TimelineModel->fetch_all_users();
			$this->load->view('timeline/timeline_researcher',$data);
		    $this->load->view('researcher/researcher_footer');

	    }
	    else
		{
			return redirect('Login');
		}
	        
	 }
	 
	 
	public function sendMessage()
	{
	    $row=$this->session->userdata('my_session');		
		
		if($row['role']=="researcher" || $row['role']=="admin" || $row['role']=="manager")
	    {
	       if(!empty($_POST['services']))
	        {
				$this->load->model('ResearcherModel');    
				$message=$this->input->post('message');
				$this->load->model('TimelineModel');
				$d=$this->TimelineModel->website_details();
				foreach($d as $a)
				{
				   $message = $message . "  " . $a->website_detail;
			    }
				$data=$this->ResearcherModel->fetch_all_users();
		 date_default_timezone_set("Asia/Kolkata");
				
foreach($data as $a)
				{
				 $send = array(
					'reciever_id' => $a->employee_id,
					'sender_id' => $row['employee_id'],
					'sender_name' =>  ucfirst($row['first_name'])." ". ucfirst($row['last_name']) ,
					'message_text'=>$message,
					'msg_date'=> DATE('Y-m-d'),
					'msg_time'=> DATE('H:i:s'),
					'call_id' => '1'
				 );
				 $this->session->set_flashdata('insert','Message Send Sucessfully');   
				 $message_id=$this->ResearcherModel->send_message($send);
			   }
			   
			   foreach ($_POST['services'] as $id)
			   {
				  $service = array(
						  'message_id' => $message_id,
						  'researcher_id' =>$row['employee_id'],
						  'service_id' => $id
					  );
				   $this->ResearcherModel->call_services($service); 
			   }
			   $send = $this->ResearcherModel->send_Service_SMS();
				return redirect('Researcher/options');
			}
	        else
	        {
				$this->session->set_flashdata('insert','Please Select Atleast One Service.');
			    return redirect('Researcher/options');
			}
	        
	    }
	
	    else
		{
			return redirect('Login');
		}
	}
	
	public function sendOptional()
	{
	 
	  $row=$this->session->userdata('my_session');		
		
		if($row['role']=="researcher")
	    {
	       
	        $this->load->model('ResearcherModel');    
	        $message=$this->input->post('message');
	        $data=$this->ResearcherModel->fetch_all_users();
	       
	        foreach($_POST['services'] as $id)
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
		     $this->ResearcherModel->send_message($send);
		   }
	    
				return redirect('Researcher/TimelineOption');
	
	        
	    }
	
	    else
		{
			return redirect('Login');
		}
	    
	}
	
	public function fetch_msg()
	{
	   $row=$this->session->userdata('my_session');
	   $this->load->model('TimelineModel');
	   $data['message']=$this->TimelineModel->fetch_message($row['employee_id']);
	   $data['timeline_count']= $this->TimelineModel->update($row['employee_id']);
	   $this->load->view('researcher/fetch',$data);
	}
	
		 public function TimelineMessage()
		{
		  $row=$this->session->userdata('my_session');	
		   if($row['role']!="researcher")
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
	    
				return redirect('Researcher/Timeline');
     }
	 
	public function inbox()
    {
        $row=$this->session->userdata('my_session');	
		if($row['role']!="researcher")
	    	return redirect('Login');
        
        $this->load->model('HeaderModel');
		
		/*	Pagination Technique for View Leads.*/
		$data   = array();
		$this->load->library('pagination');
		$this->load->helper('url');
		//$this->load->library('acl');
		
		$config['base_url'] = base_url().'/Researcher/inbox/';
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
		
		$this->load->view('researcher/researcher_header',$data);
		$this->load->view('timeline/inbox_researcher', $data);
		$this->load->view('researcher/researcher_footer');  
        
    }
    
    
    public function reply()
	{
	 	 $row=$this->session->userdata('my_session');	
		   if($row['role']!="researcher")
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
		 
	    
				return redirect('Researcher/inbox');
		
	     
	}
        public function change_password()
	{
		$row=$this->session->userdata('my_session');		
		//if($row['role']="employee")
		//	return redirect('Login');
	       $this->load->model('HeaderModel');
	       $data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
	       $data['count_msg']=$this->HeaderModel->count_msg();
               $this->load->view('researcher/researcher_header',$data);
               $this->load->view('employee/change_password');
               $this->load->view('researcher/researcher_footer');
	}
}
?>
