<?php

class TimelineModel extends CI_Model
{
    public function fetch_users()
    {
	    $row=$this->db->query("select distinct role from users");
		 return $row->result();	
    }
    
    public function fetch_all_users()
    {
	   $row=$this->db->query("select * from users");	
	   return $row->result();
    }
    
    public function send_message($data)
    {   	    
	    $this->db->insert('timeline_message',$data);		   	    
	}
	
	 public function fetch_message($id)
    {
	    $row = $this->db->query("select * from timeline_message where reciever_id=$id and status = 0 ORDER BY message_id DESC");	
	    return $row->result();
	}
	
	public function update($id)
	{
	    $row = $this->db->query("update timeline_message SET status=1 where reciever_id=$id");
	}	
     public function general_details()
    {
	  $row = $this->db->query("select * from website_details");
	  return $row->result();
	}
	
	public function insert_detail($website)
	{	
	    $this->db->query("update website_details SET website_detail='$website' where id=1");
	}
	
	public function insert_bank($data)
	{
	     $this->db->insert('bank_details',$data); 
	}
	
	public function bank_details()
    {
	   $row = $this->db->query("select * from bank_details");
	  return $row->result();	
    }
    
   public function fetch_bank($id)
   {
	   $row = $this->db->query("select * from bank_details where id='$id'");
	  return $row->result();
   }
   public function update_bank($id,$bank,$account)
   {
	    $this->db->query("update bank_details SET bank_name='$bank' , account_no='$account' where id='$id'");
   }
   public function delete_bank($id)
   {
     $this->db->query("delete from bank_details where id='$id'");
   }
   public function website_details()
   {
	   $row = $this->db->query("select * from website_details");
	  return $row->result();	
   }
}
