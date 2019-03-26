<?php

class Upload extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
        }

        public function index()
        {
                $this->load->view('upload', array('error' => ' ' ));
        }

        public function do_upload()
        {
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'csv';
                $config['max_size']             = 0;
                $config['file_name']            = "csv.csv";
                $config['overwrite']           = TRUE;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        $this->load->view('upload', $error);
                }
                else
                {
				//	$this->load->model('UploadModel');
					//$this->UploadModel->import_csv($_POST);
                        //$data = array('upload_data' => $this->upload->data());

                        //$this->load->view('success', $data);
                        return redirect('../uploads/csv.php');
                }
        }
}
?>
