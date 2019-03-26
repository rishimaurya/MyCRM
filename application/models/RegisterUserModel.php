<?php

class RegisterUserModel extends CI_Model
{
	public function check($data)
	{
		
		 $row=$this->db->query("select username from users where username='".$data."'");
		 return $row;	 
	}
	
	public function fetch_designation()
	{
		 $row=$this->db->query("select * from user_designation");
		 return $row->result();
    }
	
	public function insert_users($data)
	{			 
		     $this->db->query("insert into users(username,password,role,subpost,first_name,middle_name,last_name,dob,doj,gender,email,mobile) values('".$data->username."','".$data->password."','".$data->role."','".$data->subpost."','".$data->first_name."','".$data->middle_name."','".$data->last_name."','".$data->dob."','".$data->doj."','".$data->gender."','".$data->email."','".$data->mobile."')");	 
	}
	
}
