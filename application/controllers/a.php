<?php ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');


class A extends CI_Controller {
	
	public function index()
	{
		ECHO 	password_hash('123456', PASSWORD_DEFAULT, ['cost' => 12]);
	}
}

?>
