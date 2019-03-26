<?php ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');


class Csv extends CI_Controller {
	
	public function send($time)
	{
	$this->load->library('email');
	$this->load->dbutil();
	$this->load->helper('file');
	$this->load->helper('download');
	//date_default_timezone_set("Asia/Kolkata");
        $date= date("Y-m-d",  strtotime('-1 day') );
	$data=$query = $this->db->query("select mobile from client ");
	if(!empty($data))
	{
        $delimiter = ",";
	$newline = "\r\n";
	$data = $this->dbutil->csv_from_result($data, $delimiter, $newline);
	write_file('/home/sksolanki51/public_html/CSV.csv', $data);
	$this->email->initialize();
  	$this->email->from('admin@crmigr', 'RishiRaj Maurya');
	$this->email->to('Mauryarishi571@gmail.com','RishiRaj Maurya');
	$this->email->subject('Mobile Number CSV '.$date.' ');
	$message = "Please find the csv file in the attachment.";
	$timestamp = time();
echo $date_time = date("d-m-Y (D) H:i:s", $timestamp);

	$this->email->message($message.$time); 
        $this->email->attach('http://crmigr.com/CSV.csv');
	 if ( ! $this->email->send()) {
        show_error($this->email->print_debugger());
        }
    } 
}
}