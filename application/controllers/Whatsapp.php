<?php ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');


class Whatsapp extends CI_Controller {
    
   public function index()
   {
	 	$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
		if($rolecheck!="admin")
			return redirect('Login');
		
		$this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
	    $data['count_msg']=$this->HeaderModel->count_msg();
		$data['all_messages']=$this->HeaderModel->fetch_message_distinct($sesVal['employee_id']);
		$this->load->view('admin/whatsapp_header',$data);
     	$this->load->view('whatsapp',$data);
		$this->load->view('admin/whatsapp_footer');
   }
   
   public function fetch_msg()
	{
	   $row=$this->session->userdata('my_session');
	   $this->load->model('TimelineModel');
	   $data['message']=$this->TimelineModel->fetch_message($row['employee_id']);
	   $data['update']= $this->TimelineModel->update($row['employee_id']);
	   $this->load->view('admin/fetch',$data);
	}
    
}
?>
