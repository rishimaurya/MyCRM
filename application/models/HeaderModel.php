<?php

class HeaderModel extends CI_Model
{
	public function load_timeline($id)
	{
		$a=DATE("Y-m-d");
		$row=$this->db->query("SELECT * FROM timeline_message WHERE msg_date = '$a' and reciever_id='$id' ORDER BY message_id DESC");
		$this->a = $row->num_rows();
		$result=$row->result();
		return $result;
    }
    
    public function count_msg()
    {
        return $this->a;
    }
    public function fetch_message($limit,$start)
    {
        $row=$this->session->userdata('my_session');
        $id = $row['employee_id'];
        $row=$this->db->query("SELECT * FROM timeline_message WHERE reciever_id='$id' ORDER BY message_id DESC  LIMIT $start,$limit");
		return $row->result();
    }
    
    public function count_fetch_message()
    {
        $row=$this->session->userdata('my_session');
        $id = $row['employee_id'];
        $row=$this->db->query("SELECT * FROM timeline_message WHERE reciever_id='$id' ORDER BY message_id DESC");
		return $row->num_rows();
    }
    
    	public function count($id)
	{
		return $this->db->count_all("select count(*) from timeline_message where reciever_id='$id'");
	}
	
    public function fetch_message_distinct($id)
    {
        $row=$this->db->query("SELECT DISTINCT sender_id FROM timeline_message WHERE reciever_id='$id' ORDER BY message_id DESC");
		return $row->result();
    }
    
    public function fetch_limited_msg($id)
    {
        $row=$this->db->query("SELECT * FROM timeline_message WHERE reciever_id='$id' ORDER BY message_id DESC LIMIT 3");
        return $row->result();
    }
    
    public function fetch_calls()
    {
        $row = $this->db->query("SELECT DISTINCT message_id FROM `service_call` ORDER BY message_id DESC LIMIT 3");
       return $row->result();
    }
    
    public function fetch_message_calls($data)
   {
       $row = $this->db->query("SELECT *  FROM `timeline_message` where message_id in (".$data.") and msg_reply_id='0'order by message_id desc LIMIT 3 ");
       return $row->result();
   }
   
   public function load_full_chat($limit,$start)
   {
       $row = $this->db->query("SELECT *  FROM `timeline_message` GROUP BY message_text , sender_id  order by message_id desc LIMIT $start,$limit");
     //$this->a = $row->num_rows();
       return $row->result();
   }
   
   
   public function count_full_chat()
   {
       $row = $this->db->query("SELECT *  FROM `timeline_message` GROUP BY message_text , sender_id");
       return $row->num_rows();
       
   }
   public function welcome($id)
   {
       $row = $this->db->query("SELECT welcome_status FROM users where employee_id='$id'");
       
       return $row->result();
   }    
    
    public function update_welcome_status($id)
    {
       $this->db->query("update users SET welcome_status = 1 where employee_id='$id'"); 
    }
    
    public function delete_services()
    {
		date_default_timezone_set("Asia/Kolkata");
        $today=date('Y-m-d');
        $pre_date= date('Y-m-d', strtotime($today. ' - 1 days'));
		$query=$this->db->query("select distinct client_id as c from client_services where end_date<='$pre_date'");
		$this->db->query("delete from client_services where end_date<='".$pre_date."'");
		$res = $query->result();
        foreach($res as $a)
        {

	    	$this->db->query("update client set active='no' where client_id='$a->c'");
		}
	}
}	
