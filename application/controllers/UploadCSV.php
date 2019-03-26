<?php ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Uploadcsv extends CI_Controller {

public function __construct()
{
    parent::__construct();
    $this->load->helper('url');                    
    $this->load->model('Welcome_model');
}

public function index()
{
	$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
	
	if($rolecheck=="")
		return redirect('Login');
	
	if($rolecheck=="admin")	
	{	
	//	$this->data['view_data']= $this->Welcome_model->view_data();
		$this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
		$this->load->view('admin/admin_header',$data);
		$this->load->view('excelimport');
		$this->load->view('admin/admin_footer');
	}
	if($rolecheck=="manager")	
	{	
		//$this->data['view_data']= $this->Welcome_model->view_data();
		//$this->data['view_data']= $this->Welcome_model->view_data();
		$this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
		$this->load->view('manager/manager_header',$data);
		$this->load->view('excelimport');
		$this->load->view('manager/manager_footer');
	}
	if($rolecheck=="employee")	
	{	
		
		$this->load->model('HeaderModel');
		$data['timeline_message']=$this->HeaderModel->load_timeline($sesVal['employee_id']);
		$data['count_msg']=$this->HeaderModel->count_msg();
		$this->load->view('employee/employee_header',$data);
		$this->load->view('excelimport');
		$this->load->view('employee/employee_footer');
	}
}

public function importbulkemail(){
	$sesVal=$this->session->userdata('my_session');
		$rolecheck=$sesVal['role'];
	if($rolecheck=="")
		return redirect('Login');
	
    $this->load->view('excelimport');
}

public function import()
{
	$sesVal=$this->session->userdata('my_session');
	$rolecheck=$sesVal['role'];
	if($rolecheck=="")
		return redirect('Login');
	
 if(isset($_POST["import"]))
  {
	  $source = $_POST['csv_source'];$x=0;
      $filename=$_FILES["file"]["tmp_name"];
      if($_FILES["file"]["size"] > 0)
        {
          $file = fopen($filename, "r");
		  $count=0;$z=1;
           while (($importdata = fgetcsv($file, 10000, ",")) !== FALSE)
           {
			    if(!empty($importdata))
					  {
						  //  if(ctype_digit($importdata[0])==1 AND (strlen($importdata[0])==10 or strlen($importdata[0])==12) )
						  //  {
								$data[] = array(
									  'csv_source' => $source,
									  'mobile' => $importdata[0],
									  'follow_up_date' => date('Y-m-d')
									  
									  );
								  $z++;
				// 			}
							
						  if($z==2)
						  {
							  $result = $this->Welcome_model->insertCSV($data);
							  if($result) { $x=1; }
							  unset($data);
							  
							  $z=1;  
						  }
						    
					  }
					 //else break;
		   }
		  if(!empty($data))
		  {
			  $result = $this->Welcome_model->insertCSV($data);
			  if($result) { $x=1; }
			  unset($data);
			 
		  }
           fclose($file);
            $this->Welcome_model->trigger();
           
        }else
        {
			$this->session->set_flashdata('message', 'Select a Valid file.');
            redirect(base_url().'UploadCSV/');
        }
        if($x==1)
        {
			$this->session->set_flashdata('message', 'Data are imported successfully..');
            redirect(base_url().'UploadCSV/');
		}
        else{
             $this->session->set_flashdata('message', 'Something went wrong..');
             redirect(base_url().'UploadCSV/');
          }
  }
}

}
?>