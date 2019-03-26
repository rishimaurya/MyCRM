<?php ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Encryption extends CI_Controller {
 
 public function index()
 {
     $this->load->library('encryption');
     $this->encryption->initialize(
        array(
                'cipher' => 'aes-256',
                'mode' => 'ctr',
                'driver' => 'openssl'
        )
      );
      $plain_text = '16082017';
     echo  $ciphertext = $this->encryption->encrypt($plain_text);
     echo $this->encryption->decrypt($ciphertext);
 }
    
}
?>
