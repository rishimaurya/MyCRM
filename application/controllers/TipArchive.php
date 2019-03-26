<?php ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class TipArchive extends CI_Controller {
    function __construct() { 
         parent::__construct(); 
         $this->load->helper('cookie');
      }
	public function index()
	{
		$row=$this->session->userdata('my_session');	
		if($row['role']=="")
	    	return redirect('Login');
	    	
	    $this->load->model('TipArchiveModel');
		$d=$this->TipArchiveModel->fetch_message_id();
	    if(!empty($d)){
			foreach($d as $a)
			{
				   $sdata[]=$a->message_id;
			}
			 $sd=implode(',',$sdata);//echo $sd;
			 $data = $this->pagination('TipArchiveModel','TipArchive/index','fetch_message','count_fetch_message',$sd);	
		}
        $data['researchers']=$this->TipArchiveModel->fetch_all_researcher();
		$data['service']=$this->TipArchiveModel->fetch_all_service();//print_r($data);
		if($row['role']=="admin")
		{
		
		$this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();	
		$this->load->view('admin/admin_header',$data);
		$this->load->view('tiparchive/tip_archive', $data);
		$this->load->view('admin/admin_footer');

		}
		
		else if($row['role']=="manager")
		{
		$this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
		$this->load->view('manager/manager_header',$data);
		$this->load->view('tiparchive/tip_archive', $data);
		$this->load->view('manager/manager_footer');
		}
		
		else if($row['role']=="employee")
		{
		$this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();		 
		$this->load->view('employee/employee_header',$data);
		$this->load->view('tiparchive/tip_archive', $data);
		$this->load->view('employee/employee_footer');
		    
		}
		
		else if($row['role']=="researcher")
		{
		$this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
		$this->load->view('researcher/researcher_header',$data);
		$this->load->view('tiparchive/tip_archive',$data);
		$this->load->view('researcher/researcher_footer');
		}
		
		else
		{
		    return redirect('Login');
		}
	}
	
	public function set_filter_data()
	{
	    if(!empty($_POST))
	    {
	        if(!is_null(get_cookie('service'))) delete_cookie('service');
	        if(!is_null(get_cookie('researcher'))) delete_cookie('researcher');
	        if(!is_null(get_cookie('cdate'))) delete_cookie('cdate');
	    
		    $this->input->set_cookie('service', $_POST['service'],'1500');
		    $this->input->set_cookie('researcher', $_POST['researcher'],'1500');
		    $this->input->set_cookie('cdate', $_POST['cdate'],'1500');
		    return redirect(base_url().'TipArchive/filter');
	    }
	    else redirect(base_url().'TipArchive');
	}
	
	public function filter()
	{
	  $row=$this->session->userdata('my_session');	
		if($row['role']=="")
	    	return redirect('Login');
	    	
	   if(!empty(get_cookie('researcher')) or !empty(get_cookie('service')) or !empty(get_cookie('cdate')))
 		{
			$researcher=get_cookie('researcher');
			$services=get_cookie('service');
			$cdate=get_cookie('cdate');
		}
		else return redirect(base_url().'TipArchive/');
		
		if($researcher=="all" && $services=="all" && $cdate=="")
		return redirect(base_url().'TipArchive');

        $this->load->model('HeaderModel');
        $this->load->model('TipArchiveModel');
		$d=$this->TipArchiveModel->filterCalls();
        if(!empty($d)){
			foreach($d as $a)
			{ 
				   $sdata[]=$a->message_id;
			}
			 $sd=implode(',',$sdata);
			 $data = $this->pagination('TipArchiveModel','TipArchive/filter','fetch_FilterMessage','count_fetch_FilterMessage',$sd);	
		}
	    $data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
        $data['researchers']=$this->TipArchiveModel->fetch_all_researcher();
		$data['service']=$this->TipArchiveModel->fetch_all_service();
	  if($researcher!="all" or $services!="all" or $cdate!="")
	   {
		if($row['role']=="admin")
		  {
				$this->load->view('admin/admin_header',$data);
				$this->load->view('tiparchive/tip_archive', $data);
				$this->load->view('admin/admin_footer');
          }
          
        if($row['role']=="manager")
          {
			  $this->load->view('manager/manager_header',$data);
			  $this->load->view('tiparchive/tip_archive', $data);
			  $this->load->view('manager/manager_footer');
		  }
		  
		if($row['role']=="employee")
		  {
			  $this->load->view('employee/employee_header',$data);
		      $this->load->view('tiparchive/tip_archive', $data);
		      $this->load->view('employee/employee_footer');
		  } 
		if($row['role']=="researcher")
			{
				$this->load->view('researcher/researcher_header',$data);
				$this->load->view('tiparchive/tip_archive',$data);
				$this->load->view('researcher/researcher_footer');
			}
		}
	}
	
	public function pagination($model,$path,$function,$counting,$sd)
	{
		/*	Pagination Technique for View Leads.*/
		$data   = array();
		$this->load->model($model,'ClientModel');
		$this->load->library('pagination');
		$this->load->helper('url');
		
		$config['base_url'] = base_url().$path;
        $config['total_rows'] = $this->ClientModel->$counting($sd);;
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
        $config['next_tag_close']  = "</li>";
        $config['prev_tag_open']    = "<li>";
        $config['prev_tag_close']  = "</li>";
        $config['first_tag_open']   = "<li>";
        $config['first_tag_close'] = "</li>";
        $config['last_tag_open']    = "<li>";
        $config['last_tag_close']  = "</li>";
        $this->pagination->initialize($config); 
        
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['message'] = $this->ClientModel->$function($sd,$config['per_page'],$page);
        $data['links']  = $this->pagination->create_links();
		return $data;
	}
	
}	
?>

