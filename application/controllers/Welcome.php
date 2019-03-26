<?php ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		
		$this->load->view('public/homepage');
		
	}
	public function index2()
	{
		$this->load->view('admin/admin_header');$this->load->view('leads/comment_history');$this->load->view('admin/admin_footer');
		
	}
	
	
	
}
?>
