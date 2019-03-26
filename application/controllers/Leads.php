<?php ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');


class Leads extends CI_Controller {
    function __construct() { 
         parent::__construct(); 
         $this->load->helper('cookie');
      }
	
	
	public function insert_leads()
	{
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
		if($_POST['first_name']=="")
		{
			if($rolecheck=="")
				return redirect('Login');
		   	if($rolecheck=="admin")
				return redirect('Admin/admin_dashboard');
			if($rolecheck=="manager")
				return redirect('Manager/manager_dashboard');
		   	if($rolecheck=="employee")
				return redirect('Employee/employee_dashboard');
		}
		else
		{
			$this->load->model('LeadModel');
		        $a=$this->LeadModel->check_duplicate($_POST['mobile']);
            		  if($a>0)
 			   {
			$this->session->set_flashdata('error',' Lead already Exist.');				
				return redirect(base_url().$rolecheck.'/register_leads');	
			   }
			
			$client_data = array(
			'first_name'=>$_POST['first_name'],
			'middle_name'=>$_POST['middle_name'],
			'last_name'=>$_POST['last_name'],
			'gender'=>$_POST['gender'],
			'mobile'=>$_POST['mobile'],
			'email'=>$_POST['email'],
			//'leadsource'=>$_POST['leadsource'],
			'callback'=>$_POST['callback'],
			//'response'=>$_POST['response'],
			'leadstatus'=>$_POST['leadstatus'],
			'start_date'=>$_POST['start_date'],
			'end_date'=>$_POST['end_date'],			
			'traderexp'=>$_POST['traderexp'],
			'description'=>$_POST['description']);
			$data['service_id']=$this->input->post('services');//array of service id
			//print_r($service_id);

			$data['lead']=$this->LeadModel->insert_users($client_data);
			//echo $lead_id;
			$this->LeadModel->insert_services($data,$_POST['start_date'],$_POST['end_date']);
			$this->session->set_flashdata('insert',' Lead registered successfully.');
			if($rolecheck=="admin")
				return redirect('Admin/viewLeads');
			if($rolecheck=="manager")
				return redirect('Manager/viewLeads');
			if($rolecheck=="employee")
				return redirect('Employee/viewLeads'); 
		}
	}
	public function edit()
	{
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
	
		if((!isset($_POST['client'])) AND (!isset($_GET['client'])))
		{
			if($rolecheck=="")
				return redirect('Login');
		   	if($rolecheck=="admin")
				return redirect('Admin/viewLeads');
			if($rolecheck=="manger")
				return redirect('Manager/viewLeads');
			if($rolecheck=="employee")
				return redirect('Employee/viewLeads');
		}
		else
		{	
			if(!empty($_POST['client']))
			{
				$this->client_id=$_POST['client'];
			}else $this->client_id=base64_decode($_GET['client']);
			$this->load->model('LeadModel');
			$row=$this->LeadModel->edit($this,$sesVal['employee_id']);
			$row->client=$row->client->result();
			$row->services=$row->services->result();
			$data['comment']=$row->comment->result();
			//print_r($data);
			$data['mydata']=$row->client[0];
			$data['result']=$row->services;
			$data['client_services']=$row->client_services->result();

			if($rolecheck=="admin")
			{
				$this->load->model('HeaderModel');
		        $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		        $data['count_msg']=$this->HeaderModel->count_msg();
		        $this->load->view('admin/admin_header',$data);
				$this->load->view('leads/update_leads',$data);
				$this->load->view('admin/admin_footer');
			}
			if($rolecheck=="manager")
			{
			    $this->load->model('HeaderModel');
		        $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		        $data['count_msg']=$this->HeaderModel->count_msg();
				$this->load->view('manager/manager_header',$data);
				$this->load->view('leads/update_leads',$data);
				$this->load->view('manager/manager_footer');
			}
			if($rolecheck=="employee")
			{
			    $this->load->model('HeaderModel');
		        $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		        $data['count_msg']=$this->HeaderModel->count_msg();
				$this->load->view('employee/employee_header',$data);
				$this->load->view('leads/update_leads',$data);
				$this->load->view('employee/employee_footer');
			}
		}
	}
	
        public function edit_disposed_leads()
	{
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
	
		if((!isset($_POST['client'])) AND (!isset($_GET['client'])))
		{
		   	return redirect('Leads/view_disposed_leads');
			
		}
		else
		{	
			if(!empty($_POST['client']))
			{
				$this->client_id=$_POST['client'];
			}else $this->client_id=base64_decode($_GET['client']);
			$this->load->model('LeadModel');
			$row=$this->LeadModel->edit_disposed_leads($this);
			$row=$row->result();
			$data['mydata']=$row[0];
			if($rolecheck=="admin")
			{
				$this->load->model('HeaderModel');
		        $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		        $data['count_msg']=$this->HeaderModel->count_msg();
		        $this->load->view('admin/admin_header',$data);
				$this->load->view('leads/update_disposed_leads',$data);
				$this->load->view('admin/admin_footer');
			}
			if($rolecheck=="manager")
			{
				$this->load->model('HeaderModel');
		        $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		        $data['count_msg']=$this->HeaderModel->count_msg();
				$this->load->view('manager/manager_header',$data);
				$this->load->view('leads/update_disposed_leads',$data);
				$this->load->view('manager/manager_footer');
			}
			
		}
	}
	public function update_leads()
	{
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
	    if($rolecheck=="")
				return redirect('Login'); 
		if($_POST['client_id']=="")
		{			
		   	if($rolecheck=="admin")
				return redirect('Admin/viewLeads');
			if($rolecheck=="manager")
				return redirect('Manager/viewLeads');
			if($rolecheck=="employee")
				return redirect('Employee/viewLeads');
		}
		else
		{	
			$this->load->model('LeadModel');
			$this->first_name=$_POST['first_name'];
			$this->middle_name=$_POST['middle_name'];
			$this->last_name=$_POST['last_name'];
			$this->gender=$_POST['gender'];
			$this->mobile=$_POST['mobile'];
			$this->email=$_POST['email'];
			//$this->address=$_POST['address'];
			$this->leadsource=$_POST['leadsource'];
		//	$this->callback=$_POST['callback'];
			//$this->response=$_POST['response'];
			//$this->leadstatus=$_POST['leadstatus'];
			//$this->traderprofile=$_POST['traderprofile'];
			//$this->traderexp=$_POST['traderexp'];
			$this->status=$_POST['status'];
			$this->client_id=$_POST['client_id'];
			$this->follow_up_date=$_POST['follow_up_date'];
			$this->start_date=$_POST['start_date'];
			$this->end_date=$_POST['end_date'];
			//$this->call_status=$_POST['call'];
			$this->investment=$_POST['investment'];
			$this->comment=$_POST['comment'];
			$this->color_bit='1';
			$service_id=$this->input->post('services');//array of service id
			
			date_default_timezone_set("Asia/Kolkata");
			$date_today= date("Y-m-d h:i:s");
			
			$this->load->model('ServiceModel');
			$this->ServiceModel->insert_client_services($sesVal['employee_id'],$service_id,$this->client_id,$_POST['start_date'],$_POST['end_date']);
			//$this->LeadModel->active_free_services($sesVal['employee_id'],$_POST['start_date'],$_POST['end_date']);
			$this->ServiceModel->set_call_status($sesVal['employee_id'],$this->client_id,$_POST['call'],$date_today);
			$this->LeadModel->update_leads($this,$date_today);
			if($_SESSION['cpage']==''){ $_SESSION['cpage']=$rolecheck.'viewLeads';}
			$this->session->set_flashdata('update','Updated successfully...');
			if($rolecheck=="admin")
				return redirect(base_url().$_SESSION['cpage']);
			if($rolecheck=="manager")
				return redirect(base_url().$_SESSION['cpage']);
			if($rolecheck=="employee")
				return redirect(base_url().$_SESSION['cpage']);
		}	
	}
	
	public function delete_leads()
	{
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
		if($rolecheck=="")
				return redirect('Login');
			
       if((!isset($_POST['client'])) AND (!isset($_GET['client'])))
		{
			if($rolecheck=="")
				return redirect('Login');
		   	if($rolecheck=="admin")
				return redirect('Admin/viewLeads');
			if($rolecheck=="manger")
				return redirect('Manager/viewLeads');
			if($rolecheck=="employee")
				return redirect('Employee/viewLeads');
		}
		else
		{	
			if(!empty($_POST['client']))
			{
				$this->client_id=$_POST['client'];
			}else $this->client_id=base64_decode($_GET['client']);
		$this->load->model('LeadModel');
		$this->LeadModel->delete_leads($this);
		
		
			$this->session->set_flashdata('delete','Deleted  successfully and moved to disposed leads...');
			
			if($rolecheck=="admin")
				return redirect('Admin/viewLeads');
			if($rolecheck=="manager")
				return redirect('Manager/viewLeads');
			
	 }
		
	}
    
    public function multiDisposing()
	{
        $sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
	    if($rolecheck=="")
				return redirect('Login');
		if($_POST['checkbox']!='')
		{
				$this->load->model('LeadModel');
				$this->LeadModel->multiDisposing();
		$this->session->set_flashdata('delete','Deleted  successfully and moved to disposed leads...');
			
			if($rolecheck=="admin")
				return redirect($_SESSION['cpage']);
			if($rolecheck=="manager")
				return redirect($_SESSION['cpage']);
	  }
	  else
	  {
		  $this->session->set_flashdata('delete','Please Select Leads...');
			
			if($rolecheck=="admin")
				return redirect($_SESSION['cpage']);
			if($rolecheck=="manager")
				return redirect($_SESSION['cpage']);
	  }
	}
	public function delete_disposed_leads()
	{
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
		if($rolecheck=="")
				return redirect('Login');
                if((!isset($_POST['client'])) AND (!isset($_GET['client'])))
                 {
                     return redirect('Leads/view_disposed_leads');
                 }
			
		if(!empty($_POST['client']))
			{
				$this->client_id=$_POST['client'];
			}else $this->client_id=base64_decode($_GET['client']);
		$this->load->model('LeadModel');
		$this->LeadModel->delete_disposed_leads($this);
		
		$this->session->set_flashdata('delete','Deleted Permanently...');
		return redirect('Leads/view_disposed_leads');
		
		
	}
	
	public function set_filter_data()
	{
          $sesVal=$this->session->userdata('my_session');
		$role=$sesVal['role'];
	    if(!empty($_POST))
	    {
	        if(!is_null(get_cookie('status'))) delete_cookie('status');
	        if(!is_null(get_cookie('services'))) delete_cookie('services');
	        if(!is_null(get_cookie('follow_up_date'))) delete_cookie('follow_up_date');
	        if(!is_null(get_cookie('sdate'))) delete_cookie('sdate');
	        if(!is_null(get_cookie('end_date'))) delete_cookie('end_date');
	        if(!is_null(get_cookie('called'))) delete_cookie('called');
	    
		    $this->input->set_cookie('status', $_POST['status'],'3000');//print_r($_POST);
		    $this->input->set_cookie('services', $_POST['services'],'3000');
		    $this->input->set_cookie('follow_up_date', $_POST['follow_up_date'],'3000');
		    $this->input->set_cookie('sdate', $_POST['sdate'],'3000');
		    $this->input->set_cookie('end_date', $_POST['end_date'],'3000');
		    $this->input->set_cookie('called', $_POST['called'],'3000');
		    return redirect('Leads/filter_leads_by');
	    }
	    else return redirect(base_url().$role.'/viewLeads/');
	}
	
    public function filter_leads_by()  //alag se banana for employee
	{
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
	    if($rolecheck=="")
				return redirect('Login');
				
		   $url = substr($_SERVER['REQUEST_URI'],1);
		   $this->session->set_userdata('cpage',$url);
 		
 		if(get_cookie('follow_up_date')!="" or get_cookie('status')!="")
 		{
			$follow_up_date=get_cookie('follow_up_date');
			$status=get_cookie('status');
			$services=get_cookie('services');
			$sdate=get_cookie('sdate');
			$end_date=get_cookie('end_date');
			$called=get_cookie('called');
		}
		else return redirect($rolecheck.'/viewLeads');
		
        if($follow_up_date=="" && $status=="all" && $sdate=="" && $end_date=="" && $services=="all" && $called=="all")
		{	
				
				if($rolecheck=="admin")
					return redirect('Admin/viewLeads');
				if($rolecheck=="manager")
					return redirect('Manager/viewLeads');
				if($rolecheck=="employee")
					return redirect('Employee/viewLeads');
			
		}
		else
		{
                   $url = substr($_SERVER['REQUEST_URI'],1);
		   $this->session->set_userdata('cpage',$url);//echo $_SESSION['cpage'];
		     if($follow_up_date!="" or $status!="all" or $sdate!="" or $end_date!="" or $services!="all" or $called!="all")
		      {
				  $this->load->model('LeadModel');
				  if($rolecheck=="admin")
				     {
						$data = $this->pagination('LeadModel','/Leads/filter_leads_by/','client','get_Leads_by_filter','count_get_Leads_by_filter');
						
						$this->load->model('HeaderModel');
		                $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		                $data['count_msg']=$this->HeaderModel->count_msg();
		                $data['services']=$this->LeadModel->selectServices();
		                $this->load->view('admin/admin_header',$data);
		                $this->load->view('leads/viewLeads', $data);
						$this->load->view('admin/admin_footer');
					 }
					if($rolecheck=="manager")
					 {	
						$data = $this->pagination('LeadModel','/Leads/filter_leads_by/','client','get_Leads_by_filter','count_get_Leads_by_filter');                        $data['services']=$this->LeadModel->selectServices();
                        
						$this->load->model('HeaderModel');
						$data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
						$data['count_msg']=$this->HeaderModel->count_msg();
						$this->load->view('manager/manager_header',$data);
						$this->load->view('leads/viewLeads', $data);
						$this->load->view('manager/manager_footer');
					 }
					if($rolecheck=="employee")
					 {	
						$data = $this->pagination('LeadModel','/Leads/filter_leads_by/','client','get_Leads_by_filter_emp','count_get_Leads_by_filter_emp');
		       			$data['services']=$this->LeadModel->selectServices();
		       			$this->load->model('HeaderModel');
						$data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
						$data['count_msg']=$this->HeaderModel->count_msg();
		       			$this->load->view('employee/employee_header',$data);
						$this->load->view('leads/viewLeadsEmp', $data);
						$this->load->view('employee/employee_footer');
					 }					        
		     }
		}
	
}

	public function view_disposed_leads()
	{
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
		if($rolecheck=="")
				return redirect('Login');
			
		$data   = array();
        $this->load->model('LeadModel');
        $this->load->helper('url');
        
        $data = $this->pagination('LeadModel','/Leads/view_disposed_leads/','client','get_disposed_leads','count_disposed_rows');
		
		if($rolecheck=="")
				return redirect('Login');
        if($rolecheck=="admin")
		{
				$this->load->model('HeaderModel');
		        $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		        $data['count_msg']=$this->HeaderModel->count_msg();
		        $this->load->view('admin/admin_header',$data);
		        $this->load->view('leads/view_disposed_leads', $data);
			$this->load->view('admin/admin_footer');
		}
		if($rolecheck=="manager")
		{
		    $this->load->model('HeaderModel');
		        $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		        $data['count_msg']=$this->HeaderModel->count_msg();
			$this->load->view('manager/manager_header',$data);
			$this->load->view('leads/view_disposed_leads', $data);
			$this->load->view('manager/manager_footer');
		}
	}
	
	public function todays_followup()  //alag se banana
	{
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
	    if($rolecheck=="")
				return redirect('Login');
		
		$data = $this->pagination('LeadModel','/Leads/todays_followup/','client','get_todays_followup','count_follow_date_rows');
		if($rolecheck=="admin")
		{	
				$this->load->model('HeaderModel');
		        $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		        $data['count_msg']=$this->HeaderModel->count_msg();
		        $this->load->view('admin/admin_header',$data);
		        $this->load->view('clients/view_clients', $data);
			$this->load->view('admin/admin_footer');
		}
		if($rolecheck=="manager")
		{	
		    $this->load->model('HeaderModel');
		        $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		        $data['count_msg']=$this->HeaderModel->count_msg();
			$this->load->view('manager/manager_header',$data);
			$this->load->view('clients/view_clients', $data);
			$this->load->view('manager/manager_footer');
		}
	}
	public function distribute_leads()
	{
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
	    if($rolecheck=="")
				return redirect('Login');
	
		
		$this->load->model('DistributeLead');
		for($z=1;$z<=2;$z++)
		{
		    if(!empty($data)) unset($data);
			$count=$this->DistributeLead->get_count();
			$client_id=$this->DistributeLead->get_client_id();
			$emp_id=$this->DistributeLead->get_emp_id();
			$div=($count['client_count'])/($count['emp_count']);
			
			if($count['client_count'] > $count['emp_count'])	
			    $div=intval($div);
			else   $div=ceil($div);
			
			$k=0;
			for($i=0;$i<$count['emp_count'];$i++)
			{
				for($j=$k;$j<($k+$div);$j++)
				{
					if(!empty($client_id[$j]->client_id))
					 {$data[] = array(
					        'employee_id' => $emp_id[$i]->employee_id,
					        'lead_id' => $client_id[$j]->client_id,
					        'date'=> date('Y-m-d'),
					        );
					}
					else break;
				}
				$k=$j;
				
			}
			if(!empty($data)) $this->DistributeLead->assigned_to($data);	
			unset($data);	
		}
		
		return redirect('Leads/show_distributed_leads');
	}
	public function show_distributed_leads()
	{
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
		 if($rolecheck=="")
				return redirect('Login');
	
		
		if($rolecheck=="admin")
		{	
		     $data = $this->pagination('DistributeLead','/Leads/show_distributed_leads','lead_assigned_to','show_assigned_leads','count');
				$this->load->model('HeaderModel');
		        $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		        $data['count_msg']=$this->HeaderModel->count_msg();
		        $this->load->view('admin/admin_header',$data);
		        $this->load->view('leads/view_distributed_leads', $data);
			$this->load->view('admin/admin_footer');
		}
		if($rolecheck=="manager")
		{	
		   $data = $this->pagination('DistributeLead','/Leads/show_distributed_leads','lead_assigned_to','show_assigned_leads','count');
		    $this->load->model('HeaderModel');
		        $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		        $data['count_msg']=$this->HeaderModel->count_msg();
			$this->load->view('manager/manager_header',$data);
			$this->load->view('leads/view_distributed_leads', $data);
			$this->load->view('manager/manager_footer');
		}
		if($rolecheck=="employee")
		{	
		  $data = $this->pagination('DistributeLead','/Leads/show_distributed_leads','lead_assigned_to','show_assigned_leadsEmp','count_show_assigned_leadsEmp');
		    $this->load->model('HeaderModel');
		        $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		        $data['count_msg']=$this->HeaderModel->count_msg();
			$this->load->view('employee/employee_header',$data);
			$this->load->view('leads/view_distributed_leadsemp', $data);
			$this->load->view('employee/employee_footer');
		}
	}
	
	public function update_disposed()
	{
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
		 if($rolecheck=="")
				return redirect('Login');
	
		
		if($_POST['client_id']=="")
		{
		   	return redirect('Leads/view_disposed_leads');
		}
		else
		{	
			$this->load->model('LeadModel');
			
			$this->first_name=$_POST['first_name'];
			$this->middle_name=$_POST['middle_name'];
			$this->last_name=$_POST['last_name'];
			$this->gender=$_POST['gender'];
			$this->mobile=$_POST['mobile'];
			$this->email=$_POST['email'];
			$this->address=$_POST['address'];
			$this->status=$_POST['status'];
			$this->client_id=$_POST['client_id'];
			$this->follow_up_date=$_POST['follow_up_date'];
			$this->comment=$_POST['comment'];
			
			date_default_timezone_set("Asia/Kolkata");
			$date_today= date("Y-m-d");
			if(strcasecmp($this->status,"pending")==0 || strcasecmp($this->status,"converted")==0)
			{
				$this->LeadModel->update_dispose_to_client($this);
			}
				
			$this->LeadModel->update_leads($this,$date_today);
			$this->session->set_flashdata('update','Updated successfully...');
			
			return redirect('Leads/view_disposed_leads');
			
		}	
	}
	public function unassign_lead()
	{
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
		 if($rolecheck=="")
				return redirect('Login');
	
		$client_id=$_POST['client_id'];
		$this->load->model('DistributeLead');
		$this->DistributeLead->unassign_lead($client_id);
		$this->session->set_flashdata('unassign','Lead Unassigned...');
		return redirect('Leads/show_distributed_leads');
	}
	public function unassign_all_leads()
	{
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
		 if($rolecheck=="")
				return redirect('Login');
	
		$this->load->model('DistributeLead');
		$this->DistributeLead->unassign_all_leads();
		return redirect('Leads/show_distributed_leads');
	}
  	public function mobile_track()
	{
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
	    if($rolecheck=="")
				return redirect('Login');
	
		$row=array();
		$mobile=$_POST['mobile'];
		$this->load->model('LeadModel');
		$row1=$this->LeadModel->mobile_track($mobile);
		
		if($row1)
		{
			$row1['result']=$row1;
			if($rolecheck=="admin")
			{	
				$this->load->model('HeaderModel');
		        $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		        $data['count_msg']=$this->HeaderModel->count_msg();
		        $this->load->view('admin/admin_header',$data);
		        $this->load->view('leads/viewMobileTracker',$row1);
				$this->load->view('admin/admin_footer');
			}
			if($rolecheck=="manager")
			{	
			    $this->load->model('HeaderModel');
		        $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		        $data['count_msg']=$this->HeaderModel->count_msg();
				$this->load->view('manager/manager_header',$data);
				$this->load->view('leads/viewMobileTracker',$row1);
				$this->load->view('manager/manager_footer');
			}
			if($rolecheck=="employee")
			{	
			    $this->load->model('HeaderModel');
		        $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		        $data['count_msg']=$this->HeaderModel->count_msg();
				$this->load->view('employee/employee_header',$data);
				$this->load->view('leads/viewMobileTracker',$row1);
				$this->load->view('employee/employee_footer');
			}
		}
		else
		{
			$this->session->set_flashdata('error','Mobile number not found');
			if($rolecheck=="admin")
			   return redirect('Admin/admin_dashboard');
		    if($rolecheck=="manager")
			   return redirect('Manager/manager_dashboard');
			if($rolecheck=="employee")
			   return redirect('Employee/employee_dashboard');   
		}	
	}
	
		public function assign_tracker_lead()
	{
	    $sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
	    if($rolecheck=="")
				return redirect('Login');
		if($rolecheck == "admin" || $rolecheck == "manager")
		{       
				$this->load->model('LeadModel');
				$data['employee']=$this->LeadModel->check_assigned($_POST['client']);
				$data['lead']=$_POST['mobile'];
				$data['client_id']=$_POST['client'];
				$this->load->model('HeaderModel');
		        $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		        $data['count_msg']=$this->HeaderModel->count_msg();
		        if($rolecheck == "admin")
		        {
		           $this->load->view('admin/admin_header',$data);
		           $this->load->view('leads/manualassignlead',$data);
		           $this->load->view('admin/admin_footer');
		        }
		        if($rolecheck == "manager")
		        {
		           $this->load->view('manager/manager_header',$data);
		           $this->load->view('leads/manualassignlead',$data);
		           $this->load->view('manager/manager_footer');
		        }
		}		 	
	}
	
	public function manualassign_lead()
	{
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
	    if($rolecheck=="")
				return redirect('Login');
		//$this->load->model('DistributeLead');
				$this->load->model('HeaderModel');
		        $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		        $data['count_msg']=$this->HeaderModel->count_msg();
		        $this->load->view('admin/admin_header',$data);
		        $this->load->view('leads/manualassignlead');
		$this->load->view('admin/admin_footer');
	}
	public function searchemployee()
	{
		//echo $_POST['employee'];
		$this->load->model('LeadModel');
		$this->LeadModel->searchemployee();
		//echo "Jelly";
	
	}
	public function searchlead()
	{
		//echo $_POST['employee'];
		$this->load->model('LeadModel');
		$this->LeadModel->searchlead();
		//echo "Jelly";
	
	}
    
    public function massign_lead()
	{
		//echo "reached";
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
	    if($rolecheck=="")
				return redirect('Login');
				$this->load->model('LeadModel');
				if(!empty($_POST['client']))
				$this->LeadModel->delete_assigned_lead($_POST['client']);
				$this->LeadModel->massign_lead();
				$this->session->set_flashdata('success', 'Lead Assigned Successfully');
				redirect('/Leads/show_distributed_leads','refresh');
	}
	
	public function active_freetrial()
	{
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
	    if($rolecheck=="")
				return redirect('Login');
			
		if($rolecheck=="admin")
		{	
			$this->load->model('HeaderModel');
		    $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		    $data['count_msg']=$this->HeaderModel->count_msg();
		    $data   = array();
		    $data = $this->pagination('LeadModel','/Leads/active_freetrial/','client','active_freetrial','active_freetrial_count');
            $this->load->model('HeaderModel');
		        $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		        $data['count_msg']=$this->HeaderModel->count_msg();
            $this->load->view('admin/admin_header',$data);
			$this->load->view('clients/activefreetrialclient', $data);
			$this->load->view('admin/admin_footer');
		}
		if($rolecheck=="manager")
		{	
			$data   = array();
		    $data = $this->pagination('LeadModel','/Leads/active_freetrial/','client','active_freetrial','active_freetrial_count');
            $this->load->model('HeaderModel');
		        $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		        $data['count_msg']=$this->HeaderModel->count_msg();
            $this->load->view('manager/manager_header',$data);
			$this->load->view('clients/activefreetrialclient', $data);
			$this->load->view('manager/manager_footer');
		}
		if($rolecheck=="employee")
		{	
		    $data   = array();
		    $data = $this->pagination('LeadModel','/Leads/active_freetrial/','client','active_freetrial_emp','active_freetrial_emp_count');//print_r($data);
			$this->load->model('HeaderModel');
		        $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		        $data['count_msg']=$this->HeaderModel->count_msg();
			$data['past']="active";
			$this->load->view('employee/employee_header',$data);
			$this->load->view('clients/activefreetrialemp',$data);
			$this->load->view('employee/employee_footer');
		}
	
	}
	public function past_freetrial()
	{
	$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
	    if($rolecheck=="")
				return redirect('Login');
			
		$data   = array();
		//$status=$_POST['status'];
        $data = $this->pagination('LeadModel','/Leads/past_freetrial/','client','past_freetrial','past_freetrial_count');
        //$data['result'] = $this->LeadModel->past_freetrial();
		if($rolecheck=="admin")
		{	
				$this->load->model('HeaderModel');
		        $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		        $data['count_msg']=$this->HeaderModel->count_msg();
		        $this->load->view('admin/admin_header',$data);
		        $this->load->view('clients/pastfreetrial', $data);
			$this->load->view('admin/admin_footer');
		}
		if($rolecheck=="manager")
		{	
		    $this->load->model('HeaderModel');
		        $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		        $data['count_msg']=$this->HeaderModel->count_msg();
			$this->load->view('manager/manager_header',$data);
			$this->load->view('clients/view_clients', $data);
			$this->load->view('manager/manager_footer');
		}
		if($rolecheck=="employee")
		{	
			$data   = array();
		    $data = $this->pagination('LeadModel','/Leads/past_freetrial/','client','past_freetrial_emp','past_freetrial_emp_count');//print_r($data);
			$this->load->model('HeaderModel');
		        $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		        $data['count_msg']=$this->HeaderModel->count_msg();
			$data['past']="past";
			$this->load->view('employee/employee_header',$data);
			$this->load->view('clients/activefreetrialemp',$data);
			$this->load->view('employee/employee_footer');
		}
		
	}
	
	public function pagination($model,$path,$table,$function,$count_row)
	{
		/*	Pagination Technique for View Leads.*/
		$data   = array();
		$this->load->model($model,'DistributeLead');
		$this->load->library('pagination');
		$this->load->helper('url');
		
		$config['base_url'] = base_url().$path;
        $config['total_rows'] = $this->DistributeLead->$count_row($table);
        $config['per_page'] = 50;
        $config['uri_segment'] = 3;
        //$config['suffix'] ='';
        
    //Styling Link for Pagination. 
        
        $config['full_tag_open']    = "<ul class='pagination'>";
        $config['full_tag_close']   = "</ul>";
        $config['num_tag_open']     = "<li>";
        $config['num_tag_close']    = "</li>";
        $config['cur_tag_open']     = "<li class='disabled active'><a href='#'>";
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
		$data['result'] = $this->DistributeLead->$function($config['per_page'],$page);
		$data['links']  = $this->pagination->create_links();
		return $data;
	}
	
  public function check()
  {
	  $this->load->model('LeadModel');
	  $this->LeadModel->count_rows('client');
  }
  public function show_assign_leads()
	{
        $sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
	    if($rolecheck=="")
				return redirect('Login');
				$this->load->model('LeadModel');
				$this->LeadModel->show_assign_leads();
		
		
	}
	public function assignlead()
	{
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
	    if($rolecheck=="")
				return redirect('Login');
			
		$data   = array();
		//$status=$_POST['status'];
        $this->load->model('LeadModel');
        $this->load->helper('url');
        //$this->load->library('acl');
        $data = $this->pagination('LeadModel','/Leads/assignlead/','client','assignlead','count_assignlead');
        $data['type']=$this->LeadModel->csv_source();
        //$data['result1'] = $this->LeadModel->assignlead();
		if($rolecheck=="admin")
		{	
			//echo "gur";
				$this->load->model('HeaderModel');
		        $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
			$data['count_msg']=$this->HeaderModel->count_msg();
			$this->load->view('admin/admin_header',$data);
			$this->load->view('leads/assignlead', $data);
			$this->load->view('admin/admin_footer');
		}
		if($rolecheck=="manager")
		{	
		    $this->load->model('HeaderModel');
		    $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		    $data['count_msg']=$this->HeaderModel->count_msg();
			$this->load->view('manager/manager_header',$data);
			$this->load->view('leads/assignlead', $data);
			$this->load->view('manager/manager_footer');
		}
		if($rolecheck=="employee")
		{	
		    $this->load->model('HeaderModel');
		    $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		    $data['count_msg']=$this->HeaderModel->count_msg();
			$this->load->view('employee/employee_header',$data);
			$this->load->view('leads/assignleadsEmp', $data);
			$this->load->view('employee/employee_footer');
		}
	
	}
	public function generate_sells_order()
	{
		$row=$this->session->userdata('my_session');	
		   if($row['role']!="employee")
	         return redirect('Login');
				$this->load->model('HeaderModel');
		        $data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		        $data['count_msg']=$this->HeaderModel->count_msg();
				$this->load->view('employee/employee_header',$data);
				$this->load->view('leads/generate_sell_order');
				$this->load->view('employee/employee_footer');
	}
	public function search_mobile()
	{
		
		
		$row=$this->session->userdata('my_session');	
		   if($row['role']!="employee")
	         return redirect('Login');
	          
	          $mobile=$_POST['mobile'];
	          if(strlen($mobile)==10 AND ctype_digit($mobile)==1)
	          {
				  $this->load->model('LeadModel');
				  $data['mydata']=$this->LeadModel->search_mobile($mobile);
				  if(!empty($data['mydata']))
				    {
						$data['services']=$this->LeadModel->show_services();
						$this->load->model('HeaderModel');
						$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
						$data['count_msg']=$this->HeaderModel->count_msg();
						$this->load->view('employee/employee_header',$data);
						$this->load->view('leads/form_sell_order',$data);
						$this->load->view('employee/employee_footer');
					}
					else {
						 $this->session->set_flashdata('error', 'Entered Mobile number does not exist.');
                         redirect(base_url().'Leads/generate_sells_order/');
					}
			  }
			  else
			  {
				   $this->session->set_flashdata('error', 'Please enter Valid 10 digit Mobile Number');
                   redirect(base_url().'Leads/generate_sells_order');
			  }

	}
	public function get_sell_order()
	{
		$row=$this->session->userdata('my_session');	
		   if($row['role']!="employee")
	         return redirect('Login');
	          $this->load->model('EmployeeModel');        
	}
	
	public function getPost()
	 {
		 if(!empty($_GET['role']))
		  {
			  $role=$_GET['role'];
			  if($role=="monthly")
			  $post = $this->EmployeeModel->fetch_amount();
			  
			  else if($role=="quaterly")
			  $post = $this->EmployeeModel->fetch_amount();
			  
			  else if($role=="halfyearly")
			  $post = $this->EmployeeModel->fetch_amount();
			  
			  else if($role=="yearly")
			  $post = $this->EmployeeModel->fetch_amount();
			  
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
			 redirect('RegisterUser', 'refresh');
		  }
	 }
	
	public function contact_details_availability()
{
    if($_POST['action'] == 'checkbox-select') {
         $checkbox = $_POST['id'];
         $checked = $_POST['checked'];
        // Your MySQL code here
        echo $checkbox;
    }
           echo 'Code ran';
}
	
	  public function make_sell_order()
	{
			$row=$this->session->userdata('my_session');	
		   if($row['role']!="employee")
	         return redirect('Login');
	        
	        $this->load->model('EmployeeModel');
	      	$this->load->model('ServiceModel');
	        $client_id=$_POST['client'];
	      //echo $client_id;
			$data['data']=$this->EmployeeModel->make_sell_order($client_id);
			$data['data1']=$this->ServiceModel->view_services($client_id);
			
			//print_r($data);
		    $this->load->model('HeaderModel');
			$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
			$data['count_msg']=$this->HeaderModel->count_msg();
			$this->load->view('employee/employee_header',$data);
			$this->load->view('employee/make_sell_order',$data);
			$this->load->view('employee/employee_footer');
	    
	}
	
	public function insert_sell_order()
	{
		
		$row=$this->session->userdata('my_session');	
		if($row['role']!="employee")
	        return redirect('Login');
		    $this->load->model('EmployeeModel');
		    		    $this->load->model('LeadModel');
		    		    date_default_timezone_set("Asia/Kolkata");
			$date_today= date("Y-m-d");
	    $net= $_POST['service_amount'] - $_POST['discount'];
	    echo $_POST['discount'];
	    echo $_POST['service_amount'];
	    $insert = array (
	       'client_id' =>$_POST['client_id'] ,
		   'service_amount' => $_POST['service_amount'],
		   'discount'  => $_POST['discount'],
		   'total_amount' => $net,
		   'payment_mode' =>$_POST['mode'],
		   'date' =>$_POST['date'],
		   'employee_id'=>$row['employee_id'],
		   'ename'=>$row['username']
		   
		   
		  
	   	);
	  $data['service_id']=$this->input->post('services');
	   	$this->EmployeeModel->save_sell_order($insert);
		  $this->LeadModel->active_client_services($row['employee_id']);
		  
		  $this->LeadModel->update_client_details();
		  $this->session->set_flashdata('details','Details Saved Sucessfully');   
		  
				return redirect('Clients/view_active_clients');		
	}
	 
		public function view_sell_order()
		{
		     /*$row=$this->session->userdata('my_session');	
		   if($row['role']!="")
	         return redirect('Login');*/
	         $sesVal=$this->session->userdata('my_session');
			$rolecheck=$sesVal['role'];
	    if($rolecheck=="")
				return redirect('Login');
	        
	       
	        $this->load->model('EmployeeModel');
	      	$this->load->model('ServiceModel');
	        $client_id=$_POST['client'];
	        
	        $data['data']=$this->EmployeeModel->make_sell_order($client_id);
			$data['data1']=$this->ServiceModel->view_services($client_id);
	        $data['data2']=$this->EmployeeModel->view_sell_order($client_id);
	        $this->load->model('HeaderModel');
			$data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
			$data['count_msg']=$this->HeaderModel->count_msg();
			$this->load->view('employee/employee_header',$data);
			$this->load->view('employee/view_sell_order',$data);
			$this->load->view('employee/employee_footer');  	
        }
        
        
        public function approve_sell_order()
	{
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
	    if($rolecheck=="")
				return redirect('Login');
			
		$data   = array();
		//$status=$_POST['status'];
        $this->load->model('LeadModel');
        $this->load->helper('url');
        //$this->load->library('acl');
        //$data = $this->pagination('LeadModel','/Leads/assignlead/','client','approve_sell_order','count_assignlead');
        
        $data['result'] = $this->LeadModel->approve_sell_order();
		if($rolecheck=="admin")
		{	
			//echo "gur";
				$this->load->model('HeaderModel');
		        $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
			$data['count_msg']=$this->HeaderModel->count_msg();
			$this->load->view('admin/admin_header',$data);
			$this->load->view('leads/approve_sell_order', $data);
			$this->load->view('admin/admin_footer');
		}
		if($rolecheck=="manager")
		{	
		    $this->load->model('HeaderModel');
		    $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		    $data['count_msg']=$this->HeaderModel->count_msg();
			$this->load->view('manager/manager_header',$data);
			$this->load->view('leads/approve_sell_order', $data);
			$this->load->view('manager/manager_footer');
		}
	
	
	}
	public function approve_client()
	{   
	 $sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
	    if($rolecheck=="")
				return redirect('Login');
				$this->load->model('LeadModel');
				$this->LeadModel->approve_client();
				  
			$this->session->set_flashdata('details','Approved Sucessfully');   
		  
				return redirect('Admin/admin_dashboard');		
	}
	public function view_client_details()
	{
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
	    if($rolecheck=="")
		return redirect('Login');
		$this->load->model('HeaderModel');
		        $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
			$data['count_msg']=$this->HeaderModel->count_msg();
		$this->load->model('LeadModel');
               if(!empty($_GET)) $client=base64_decode($_GET['client']);
		$data['mydata']=$this->LeadModel->view_client_details($client);
		//$data['data']=$this->LeadModel->view_client_details($client);
		//$data['data1']=$this->ServiceModel->view_services($client_id);
	        
		$data['services']=$this->LeadModel->view_client_services($client);
		$this->load->view('admin/admin_header',$data);
		
		$this->load->view('leads/view_client_details', $data);
		$this->load->view('admin/admin_footer');
	}
	
	public function edit_client_details()
	{
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
	    if($rolecheck=="")
		return redirect('Login');
		$this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
		$this->load->model('LeadModel');
		if(!empty($_GET)) $client=base64_decode($_GET['client']);

		$data['mydata']=$this->LeadModel->view_client_details($client);
		$data['services']=$this->LeadModel->view_client_services($client);
		$this->load->view('admin/admin_header',$data);		
		$this->load->view('leads/edit_client_details', $data);
		$this->load->view('admin/admin_footer');
    }
    public function edit_sell_order()
	{
	  $sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
	    if($rolecheck=="")
		return redirect('Login');
		
		$details= array(
		'first_name'=>$_POST['first_name'],
		'middle_name'=>$_POST['middle_name'],
		'last_name'=>$_POST['last_name'],
		'email'=>$_POST['email'],
		'follow_up_date'=>$_POST['follow_up_date']
		);
		$sell_order = array(
		'service_amount'=>$_POST['service_amount'],
		'discount'=>$_POST['discount'],
		'total_amount'=>$_POST['total_amount'],
		'payment_mode'=>$_POST['mode']
		);
		$this->load->model('LeadModel');
		$this->LeadModel->update_client_sell($details,$sell_order);
		return redirect('Leads/approve_sell_order');
	}
	public function delete_client_details()
	{
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
	    if($rolecheck=="")
		return redirect('Login');
		
		$this->load->model('LeadModel');
                if(!empty($_GET['client'])) $client=base64_decode($_GET['client']);
		$this->LeadModel->delete_client_sell($client);
		return redirect('Leads/approve_sell_order');
	}
	public function freeTrail()
   {
	   		     $row=$this->session->userdata('my_session');	
		if($row['role']== "")
	    	return redirect('Login');
	    	
	    
	    $this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
		$this->load->model('LeadModel');
        $data['freetrail']=$this->LeadModel->unapproved_freetrails($row['employee_id']);
        if($row['role']=="admin")
        {
        $this->load->view('admin/admin_header',$data);
		$this->load->view('leads/approve_free_trail', $data);
		$this->load->view('admin/admin_footer');
	    }
	    if($row['role']=="manager")
        {
		$this->load->view('manager/manager_header',$data);
		$this->load->view('leads/approve_free_trail', $data);
		$this->load->view('manager/manager_footer');

	    }	
   }
   
   public function stop_service()
   {
	   $sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
	    if($rolecheck=="")
				return redirect('Login');
				$this->load->model('LeadModel');
	           
	           $this->LeadModel->stop_service();
				  $this->session->set_flashdata('stop','Services Stopped');   
		       if($rolecheck=="admin" or $rolecheck=="manager")
			   {
				  if($_POST['t'] == "free")
				  return redirect('Leads/approve_freetrail');
			      else
			      return redirect('Clients/view_active_clients');
			   }
   }
   
   public function approve_freetrail()
   {
      $sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
	    if($rolecheck=="")
				return redirect('Login');
				$this->load->model('LeadModel');
				$this->LeadModel->approve_freetrail();
				  $this->session->set_flashdata('details','FreeTrail Approved Sucessfully');   
		       if($rolecheck=="admin")
				return redirect('Admin/admin_dashboard');
		       if($rolecheck=="manager")
				return redirect('Manager/manager_dashboard');
   }
   public function view_free_detials()
	{
			 $sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
	    if($rolecheck=="")
		return redirect('Login');
                $client_id=base64_decode($_GET['client']);
		$this->load->model('HeaderModel');
		        $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
			$data['count_msg']=$this->HeaderModel->count_msg();
		$this->load->model('LeadModel');
		$data['mydata']=$this->LeadModel->view_free_details($client_id);
		$data['data']=$this->LeadModel->view_client_details($client_id);
		//$data['data1']=$this->ServiceModel->view_services($client_id);
	        
		$data['services']=$this->LeadModel->view_client_services($client_id);
		$this->load->view('admin/admin_header',$data);
		
		$this->load->view('leads/view_free_detials', $data);
		$this->load->view('admin/admin_footer');
	}
	
	public function set_filter_csv()
    {
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
		if(!empty($_POST))
	    {
	        if(!is_null(get_cookie('csv_source'))) delete_cookie('csv_source');
	        
		    $this->input->set_cookie('csv_source', $_POST['csv_source'],'3000');
		    
		    return redirect('Leads/assignlead');
	    }
	    else return redirect(base_url().$rolecheck.'/viewLeads/');
	}

}


?>
