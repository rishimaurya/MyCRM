<?php

class LoginModel extends CI_Model
{
	
	public function select_users($data)
	{
	 /*   $s='09082017';$cname="cloud matrix";
	    $row = $this->db->query("select * from information where company_name = '".$cname."' ");
	    $row=$row->result();
		if($row!=null)
		{
		  $present_status=$row[0]->present_status;
					$this->load->library('encryption');
					$this->encryption->initialize(
        array(
                'cipher' => 'aes-128',
                'mode' => 'ctr',
                'driver' => 'openssl'
        )
      );
          if($s == $this->encryption->decrypt($present_status) or $s > $this->encryption->decrypt($present_status))
			{
				
				return redirect("http://clientpreview.xyz/CRM/uploads/Block.php"); 
			}
			else
			{
			*/	$row=$this->db->query("select * from users where username='".$data->username."' and role='".$data->mylist."'");
		        //and password='".$data->password."'
		        $row=$row->result();
		        if($row!=null)
		         {	
                        $hash=$row[0]->password;
		          if(password_verify($data->password,$hash))
			        {
				        return $row;
			        }
			      else
			        {
			            return false;
			        }
		         }
		       else
			       return false;
			/*}
		}
		else
			return false;*/
	}
	public function set_last_login($last_login,$username)
	{
		$this->db->query("update users set last_login='".$last_login."' where username='".$username."'");
	}	

	
	public function check_status()
	{
	    $s='09082017';$cname="cloud matrix";
	    $row = $this->db->query("select * from information where company_name = '".$cname."' ");
	    $row=$row->result();
		if($row!=null)
		{
		  $present_status=$row[0]->present_status;
					$this->load->library('encryption');
					$this->encryption->initialize(
        array(
                'cipher' => 'aes-128',
                'mode' => 'ctr',
                'driver' => 'openssl'
        )
      );
          if($s == $this->encryption->decrypt($present_status) or $s > $this->encryption->decrypt($present_status))
			{
				
				return redirect("http://clientpreview.xyz/CRM/Deleted"); 
			}
			else
			{
				return 0;
			}
		}
		else
			return false;
	}
	
	public function blockCrm()
	{
	   $this->db->set('blocked','1');
	   $this->db->where('role!=','admin');
	   $query = $this->db->update('users');
	   if($query)
	     return true;
	     else return false;
	}
	
        public function unBlockCrm()
	{
	   $this->db->set('blocked','0');
	   $this->db->where('role!=','admin');
	   $query = $this->db->update('users');
	   if($query)
	     return true;
	     else return false;
	}

	public function blockUser($eid)
	{
	   $this->db->set('is_blocked','1');
	   $this->db->where('employee_id',$eid);
	   $query = $this->db->update('users');
	   if($query)
	     return true;
	     else return false;
	}

       public function removeblockUser($eid)
	{
	   $this->db->set('is_blocked','0');
	   $this->db->where('employee_id',$eid);
	   $query = $this->db->update('users');
	   if($query)
	     return true;
	     else return false;
	}

       public function blockAllUser($eid)
	{
	   $this->db->set('is_blocked','1');
	   $this->db->where('role!=','admin');
	   $query = $this->db->update('users');
	   if($query)
	     return true;
	     else return false;
	}
       public function unBlockAllUser($eid)
	{
	   $this->db->set('is_blocked','0');
	   $this->db->where('role!=','admin');
	   $query = $this->db->update('users');
	   if($query)
	     return true;
	     else return false;
	}
}


