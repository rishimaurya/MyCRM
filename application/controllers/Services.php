<?php ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller {

	public function index()
	{
		$row=$this->session->userdata('my_session');	
		if($row['role']!="admin")
			return redirect('Login');
		
		$this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
		$this->load->view('admin/admin_header',$data);
		$this->load->view('services/add_new_service');
		$this->load->view('admin/admin_footer');	
	}
	public function insert()
	{
		$row=$this->session->userdata('my_session');	
		if($row['role']!="admin")
			return redirect('Login');
		
		$service_name=$_POST['service_name'];
		$service_amount=$_POST['service_amount'];
		$quaterly_amount=$_POST['quaterly_amount'];
		$halfyearly_amount=$_POST['halfyearly_amount'];
		$yearly_amount=$_POST['yearly_amount'];
		
		$this->load->model('ServiceModel');
		$this->ServiceModel->insert($service_name, $service_amount,$quaterly_amount,$halfyearly_amount,$yearly_amount);
		return redirect('Services/view');
		
	}
	public function view()
	{
		$row=$this->session->userdata('my_session');	
		if($row['role']!="admin")
			return redirect('Login');
		/*	Pagination Technique for View Leads.*/
		$data   = array();
		$this->load->model('ServiceModel');
		$this->load->library('pagination');
		$this->load->helper('url');
		//$this->load->library('acl');
		
		$config['base_url'] = base_url().'/Services/view/';
        $config['total_rows'] = $this->ServiceModel->count('services');;
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
        $config['next_tag_close']  = "</li>";
        $config['prev_tag_open']    = "<li>";
        $config['prev_tag_close']  = "</li>";
        $config['first_tag_open']   = "<li>";
        $config['first_tag_close'] = "</li>";
        $config['last_tag_open']    = "<li>";
        $config['last_tag_close']  = "</li>";
        $this->pagination->initialize($config); 
        
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data['result'] = $this->ServiceModel->view($config['per_page'],$page);
		$data['links']  = $this->pagination->create_links();
	    
	    $this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
		$this->load->view('admin/admin_header',$data);
		$this->load->view('services/view',$data);
		$this->load->view('admin/admin_footer');
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
		
		$service_id=$_POST['service_id'];
		$this->load->model('ServiceModel');
		$this->ServiceModel->delete($service_id);
		return redirect('Services/view');

		
	}
	public function view_client_services()
	{
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
	    if($rolecheck=="")
				return redirect('Login');
		if((!isset($_POST['client'])) AND (!isset($_GET['client'])))
		{	
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
			  $client_id=$_POST['client'];
			}else $client_id=base64_decode($_GET['client']);
			$this->load->model('ServiceModel');
			$row=$this->ServiceModel->view_client_services($client_id);
			$row['result']=$row;
			if($rolecheck=="admin")
			{
				$this->load->model('HeaderModel');
		        $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		        $data['count_msg']=$this->HeaderModel->count_msg();
		        $this->load->view('admin/admin_header',$data);
				$this->load->view('services/view_client_services',$row);
				$this->load->view('admin/admin_footer');
			}	
			if($rolecheck=="manager")
			{
                $this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
				$this->load->view('manager/manager_header',$data);
				$this->load->view('services/view_client_services',$row);
				$this->load->view('manager/manager_footer');
			}	
			if($rolecheck=="employee")
			{
			    $this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
				$this->load->view('employee/employee_header',$data);
				$this->load->view('services/view_client_services',$row);
				$this->load->view('employee/employee_footer');
			}	
		}
	}
	public function delete_client_services()
	{
		$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
	    if($rolecheck=="")
				return redirect('Login');
			
		$this->client_id=$_POST['client_id'];
		$this->service_id=$_POST['service_id'];		
		$this->load->model('ServiceModel');
		$this->ServiceModel->delete_client_services($this);
		
		$client_id=$this->client_id;
		$this->load->model('ServiceModel');
		$row=$this->ServiceModel->view_client_services($client_id);
		$row['result']=$row;
		if($rolecheck=="admin")
		{
			$this->load->model('HeaderModel');
		    $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		    $data['count_msg']=$this->HeaderModel->count_msg();
		    $this->load->view('admin/admin_header',$data);
			$this->load->view('services/view_client_services',$row);
			$this->load->view('admin/admin_footer');
		}	
		if($rolecheck=="manager")
		{
		    $this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
			$this->load->view('manager/manager_header',$data);
			$this->load->view('services/view_client_services',$row);
			$this->load->view('manager/manager_footer');
		}	
		if($rolecheck=="employee")
		{
		    $this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
			$this->load->view('employee/employee_header',$data);
			$this->load->view('services/view_client_services',$row);
			$this->load->view('employee/employee_footer');
		}
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

			$this->load->model('ServiceModel');
			$data=$this->ServiceModel->edit($_POST['service_id']);
			$data['service']=$data[0];
			
			if($rolecheck=="admin")
			{
				$this->load->model('HeaderModel');
		        $data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		        $data['count_msg']=$this->HeaderModel->count_msg();
		        $this->load->view('admin/admin_header',$data);
				$this->load->view('services/update',$data);
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
		
		$this->id=$_POST['service_id'];
		$this->service=$_POST['service'];
		$this->service_amoun=$_POST['service_amoun'];
		$this->quaterly_amount=$_POST['quaterly_amount'];
		$this->halfyearly_amount=$_POST['halfyearly_amount'];
		$this->yearly_amount=$_POST['yearly_amount'];
		$this->load->model('ServiceModel');
		$this->ServiceModel->update($this);
	    $this->session->set_flashdata('update','Service updated Sucessfully');
		return redirect('Services/view');
    }
}
?>
