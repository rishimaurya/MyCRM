<?php

class Update extends CI_Model
{
	public function update_admin($data)
	{
		$row=$this->session->userdata('my_session');
		$this->db->query("update users set first_name='".$data->first_name."', last_name='".$data->last_name."',
		middle_name='".$data->middle_name."' , father_name='".$data->father_name."', mobile='".$data->mobile."',
		 address='".$data->address."', dob='".$data->dob."', email='".$data->email."' where username='".$row['username']."' ");	
	}
	public function updatePassword($data)
	{
		$row1=$this->session->userdata('my_session');
		$row=$this->db->query("select password from users where username='".$row1['username']."'");
		
		$row=$row->result();
		if($row!=null)
		{	
		  
		  $hash=$row[0]->password;
					
		
		  if(password_verify($data->old_pswd,$hash))
			{
				$this->db->query("update users set password='".$data->new_pswd."' where username='".$row1['username']."'");
				return true;
			}
				
			else
			{
				
			   return false;
			}
		}
		else
			return false;
		
		
	}
	
	
	
}