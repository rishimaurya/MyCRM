<?php ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');


class Clients extends CI_Controller {
	
	public function view_active_clients()
	{
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
		$data   = array();
        $this->load->model('ClientModel');
        $this->load->helper('url');
        //$this->load->library('acl');
        if($rolecheck=="")
			return redirect('Login');
        if($rolecheck=="admin")
		{	$data = $this->pagination('ClientModel','/Clients/view_active_clients/','client','get_active_clients','yes','count_active_client');
			//$data['result'] = $this->ClientModel->get_active_clients();
			$this->load->model('HeaderModel');
		    $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		    $data['count_msg']=$this->HeaderModel->count_msg();
		    $this->load->view('admin/admin_header',$data);
		    $this->load->view('clients/activeclient_view',$data);
			$this->load->view('admin/admin_footer');
		}
		if($rolecheck=="manager")
		{	$data = $this->pagination('ClientModel','/Clients/view_active_clients/','client','get_active_clients','yes','count_active_client');
			//$data['result'] = $this->ClientModel->get_active_clients();
			$this->load->model('HeaderModel');
		    $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		    $data['count_msg']=$this->HeaderModel->count_msg();
			$this->load->view('manager/manager_header',$data);
			$this->load->view('clients/activeclient_view', $data);
			$this->load->view('manager/manager_footer');
		}
		if($rolecheck=="employee")
		{	$data = $this->pagination('ClientModel','/Clients/view_active_clients/','client','get_active_clients_for_emp','yes','count_get_active_clients_for_emp');
		    //$data['result'] = $this->ClientModel->get_active_clients_for_emp();
			$this->load->model('HeaderModel');//print_r($data);
		    $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		    $data['count_msg']=$this->HeaderModel->count_msg();
			$this->load->view('employee/employee_header',$data);
			$this->load->view('clients/view_clients_emp', $data);
			$this->load->view('employee/employee_footer');
		}
	}
	public function view_expired_clients()
	{
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
		if($rolecheck=="")
			return redirect('Login');
		
		$data   = array();
        $this->load->model('ClientModel');
        $this->load->helper('url');
        //$this->load->library('acl');
       
        if($rolecheck=="admin")
		{	 
			$data = $this->pagination('ClientModel','/Clients/view_expired_clients/','client','get_expired_clients','no','count_expired_clients');
			//$data['result'] = $this->ClientModel->get_expired_clients();
			$this->load->model('HeaderModel');
		    $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		    $data['count_msg']=$this->HeaderModel->count_msg();
		    $this->load->view('admin/admin_header',$data);
		    $this->load->view('clients/view_clients', $data);
			$this->load->view('admin/admin_footer');
		}
		if($rolecheck=="manager")
		{	
			$data = $this->pagination('ClientModel','/Clients/view_expired_clients/','client','get_expired_clients','no','count_expired_clients');
			//$data['result'] = $this->ClientModel->get_expired_clients();
			$this->load->model('HeaderModel');
		    $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		    $data['count_msg']=$this->HeaderModel->count_msg();
			$this->load->view('manager/manager_header',$data);
			$this->load->view('clients/view_clients', $data);
			$this->load->view('manager/manager_footer');
		}
		if($rolecheck=="employee")
		{	
		    $data = $this->pagination('ClientModel','/Clients/view_expired_clients/','client','get_expired_clients_for_emp','yes','count_get_expired_clients_for_emp');
		    //$data['result'] = $this->ClientModel->get_expired_clients_for_emp();
			$this->load->model('HeaderModel');
		    $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		    $data['count_msg']=$this->HeaderModel->count_msg();
			$this->load->view('employee/employee_header',$data);
			$this->load->view('clients/view_clients_emp', $data);
			$this->load->view('employee/employee_footer');
		}
		
	}
	public function view_all_clients()
	{
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
		$data   = array();
        $this->load->model('ClientModel');
        $this->load->helper('url');
        //$this->load->library('acl');
        if($rolecheck=="")
			return redirect('Login');
        if($rolecheck=="admin")
		{	$data = $this->pagination('ClientModel','/Clients/view_all_clients/','client','get_all_clients','','count_rows');
			//$data['result'] = $this->ClientModel->get_all_clients();
			$this->load->model('HeaderModel');
		    $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		    $data['count_msg']=$this->HeaderModel->count_msg();
		    $this->load->view('admin/admin_header',$data);
			$this->load->view('clients/view_clients', $data);
			$this->load->view('admin/admin_footer');
		}
		if($rolecheck=="manager")
		{	$data = $this->pagination('ClientModel','/Clients/view_all_clients/','client','get_all_clients','','count_rows');
			//$data['result'] = $this->ClientModel->get_all_clients();
			$this->load->model('HeaderModel');
		    $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		    $data['count_msg']=$this->HeaderModel->count_msg();
			$this->load->view('manager/manager_header',$data);
			$this->load->view('clients/view_clients', $data);
			$this->load->view('manager/manager_footer');
		}
		if($rolecheck=="employee")
		{	
		    $data = $this->pagination('ClientModel','/Clients/view_all_clients/','client','get_all_clients_for_emp','yes','count_get_all_clients_for_emp');
		    //$data['result'] = $this->ClientModel->get_all_clients_for_emp();
			$this->load->model('HeaderModel');
		    $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		    $data['count_msg']=$this->HeaderModel->count_msg();
			$this->load->view('employee/employee_header',$data);
			$this->load->view('clients/view_clients_emp', $data);
			$this->load->view('employee/employee_footer');
		}
		
		
	}
	
	public function pagination($model,$path,$table,$function,$active,$counting)
	{
		/*	Pagination Technique for View Leads.*/
		$data   = array();
		$this->load->model($model,'ClientModel');
		$this->load->library('pagination');
		$this->load->helper('url');
		
		$config['base_url'] = base_url().$path;
        $config['total_rows'] = $this->ClientModel->$counting($table,$active);
        $config['per_page'] = 20;
        $config['uri_segment'] = 3;
        //$config['suffix'] ='';
        
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
        $data['result'] = $this->ClientModel->$function($config['per_page'],$page);
		$data['links']  = $this->pagination->create_links();
		return $data;
	}
	
	

}
?>
