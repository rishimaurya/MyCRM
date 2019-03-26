<?php ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');


class Details extends CI_Controller {

   public function index()
   {
	    $row=$this->session->userdata('my_session');	
		
	    	
		$this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($row['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
		$this->load->model('TimelineModel');
	    $data['details']=$this->TimelineModel->bank_details();
	    $data['website_details']=$this->TimelineModel->website_details();
	    if($row['role'] == "admin")
	   {
	    $this->load->view('admin/admin_header',$data);
		$this->load->view('general/sendDetails',$data);
		$this->load->view('admin/admin_footer');
	   }
	   else if($row['role']=="manager")
	   {
	    $this->load->view('manager/manager_header',$data);
		$this->load->view('general/sendDetails',$data);
		$this->load->view('manager/manager_footer');
	   }
	   else if($row['role']=="researcher")
	   {
	    $this->load->view('researcher/researcher_header',$data);
		$this->load->view('general/sendDetails',$data);
		$this->load->view('researcher/researcher_footer');
	   }
	    else if($row['role']=="employee")
	   {
	    $this->load->view('employee/employee_header',$data);
		$this->load->view('general/sendDetails',$data);
		$this->load->view('employee/employee_footer');
	   }
   }
   
   public function send_details()
   {
	   if(!empty($_POST))
	   {
		   $this->load->model('ResearcherModel');
		   $this->ResearcherModel->send_details($_POST['mobile_no'],$_POST['message']);
		    $this->session->set_flashdata('insert','Message Send Sucessfully');
		    return redirect(base_url().'Details');
	   }
   } 
}
?>
