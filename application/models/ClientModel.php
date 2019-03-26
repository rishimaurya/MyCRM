<?php

class ClientModel extends CI_Model
{
	public function get_active_clients($limit,$start)
	{
	date_default_timezone_set("Asia/Kolkata");
		$date_today= date("Y-m-d");
		$result=$this->db->query("SELECT client.client_id, client.first_name as first_name, client.last_name as last_name,users.first_name as fname, users.last_name as lname, client.email as email , client.mobile as mobile,client.follow_up_date as follow_up_date,client.status as status FROM client,users,lead_assigned_to  WHERE users.employee_id=lead_assigned_to.employee_id and client.client_id=lead_assigned_to.lead_id  and status='paid' and client.active='yes' and client.end_date > '".$date_today."' ");		
		//$result=$this->db->query("SELECT * FROM `client_services`,client  WHERE client_services.client_id = client.client_id and status='paid' and active='yes' and client_services.end_date = (select  client_services.end_date from client_services order by end_date DESC limit 1) group by client_services.client_id");		
		//print_r  ( $result->result());
		return $result = $result->result();
	
	}
	
	public function count_active_client($table,$start)
	{
		date_default_timezone_set("Asia/Kolkata");
		$date_today= date("Y-m-d");
		
		$result=$this->db->query("SELECT * FROM client,users,lead_assigned_to  WHERE users.employee_id=lead_assigned_to.employee_id and client.client_id=lead_assigned_to.lead_id  and status='paid' and client.active='yes' and client.end_date > '".$date_today."' ");		
		//print_r  ( $result->result());
		return $result = $result->num_rows();
	
	}
	
	public function get_expired_clients($limit,$start)
	{
	date_default_timezone_set("Asia/Kolkata");
		$date_today= date("Y-m-d");
		$result=$this->db->query("SELECT client.client_id, client.first_name as first_name, client.last_name as last_name,users.first_name as fname, users.last_name as lname, client.email as email , client.mobile as mobile,client.follow_up_date as follow_up_date,client.status as status FROM client,users,lead_assigned_to  WHERE users.employee_id=lead_assigned_to.employee_id and client.client_id=lead_assigned_to.lead_id  and status='paid' and client.active='no' and client.end_date < '".$date_today."' ");		
		return $result=$result->result();
	
	}
	
	public function count_expired_clients()
	{
	date_default_timezone_set("Asia/Kolkata");
		$date_today= date("Y-m-d");
		$result=$this->db->query("SELECT * FROM client,users,lead_assigned_to  WHERE users.employee_id=lead_assigned_to.employee_id and client.client_id=lead_assigned_to.lead_id  and status='paid' and client.active='no' and client.end_date < '".$date_today."' ");		
		return $result=$result->num_rows();
	
	}
	
	public function get_all_clients($limit,$start)
	{
		//$result=$this->db->query("select * from client where status='converted'");
	    $this->db->select('client.client_id, client.first_name as first_name, client.last_name as last_name,users.first_name as fname, users.last_name as lname, client.email as email , client.mobile as mobile,client.follow_up_date as follow_up_date,client.status as status');
	    $this->db->from('client,users,lead_assigned_to');
	    $where = "users.employee_id=lead_assigned_to.employee_id and client.client_id=lead_assigned_to.lead_id  and status='paid' ";		
	    $this->db->where($where);
	   // $this->db->where('status','paid');
	    $this->db->limit($limit,$start);
	    $query = $this->db->get();				
		return $result=$query->result();
	
	}
	
	public function get_active_clients_for_emp($limit,$start)
	{
		date_default_timezone_set("Asia/Kolkata");
		$date_today= date("Y-m-d");
	
		$sesVal=$this->session->userdata('my_session');
		$employee_id=$sesVal['employee_id'];
		$result=$this->db->query("SELECT * FROM client,lead_assigned_to  WHERE client.client_id=lead_assigned_to.lead_id and status='paid' and active='yes' and lead_assigned_to.employee_id=$employee_id  and client.end_date > '".$date_today."' ");		
		//print_r  ( $result->result());
		return $result = $result->result();
	
		/*date_default_timezone_set("Asia/Kolkata");
		$date_today= date("Y-m-d");
		$sesVal=$this->session->userdata('my_session');
		$employee_id=$sesVal['employee_id'];
		$result=$this->db->query("select * from lead_assigned_to,client where lead_id=client_id  and (status='paid') AND 
		(follow_up_date > '".$date_today."' )and employee_id=".$employee_id." LIMIT $start,$limit ");		
		return $result=$result->result();*/
	
	}
	
	public function count_get_active_clients_for_emp($limit,$start)
	{
		date_default_timezone_set("Asia/Kolkata");
		$date_today= date("Y-m-d");
	
		$sesVal=$this->session->userdata('my_session');
		$employee_id=$sesVal['employee_id'];
		$result=$this->db->query("SELECT * FROM client,lead_assigned_to  WHERE client.client_id=lead_assigned_to.lead_id and status='paid' and active='yes' and lead_assigned_to.employee_id=$employee_id  and client.end_date > '".$date_today."'");		
		//print_r  ( $result->result());
		return $result = $result->num_rows();
	
		/*date_default_timezone_set("Asia/Kolkata");
		$date_today= date("Y-m-d");
		$sesVal=$this->session->userdata('my_session');
		$employee_id=$sesVal['employee_id'];
		$result=$this->db->query("select * from lead_assigned_to,client where lead_id=client_id  and (status='paid') AND
		(follow_up_date > '".$date_today."' )and employee_id=".$employee_id."");		
		return $result=$result->num_rows();
	*/
	}
	
	public function get_expired_clients_for_emp($limit,$start)
	{
		
		date_default_timezone_set("Asia/Kolkata");
		$date_today= date("Y-m-d");
		$sesVal=$this->session->userdata('my_session');
		$employee_id=$sesVal['employee_id'];
		$result=$this->db->query("SELECT * FROM client,lead_assigned_to  WHERE client.client_id=lead_assigned_to.lead_id and status='paid' and active='no' and lead_assigned_to.employee_id=$employee_id  and client.end_date < '".$date_today."'");	
		return $result=$result->result();
	
	}
	
	public function count_get_expired_clients_for_emp($limit,$start)
	{
		date_default_timezone_set("Asia/Kolkata");
		$date_today= date("Y-m-d");
		$sesVal=$this->session->userdata('my_session');
		$employee_id=$sesVal['employee_id'];
		$result=$this->db->query("SELECT * FROM client,lead_assigned_to  WHERE client.client_id=lead_assigned_to.lead_id and status='paid' and active='no' and lead_assigned_to.employee_id=$employee_id and client.end_date < '".$date_today."'");		
		return $result=$result->num_rows();
	
	}
	
	public function get_all_clients_for_emp($limit,$start)
	{
		$sesVal=$this->session->userdata('my_session');
		$employee_id=$sesVal['employee_id'];
		$result=$this->db->query("select * from lead_assigned_to,client where lead_id=client_id and status='paid' and employee_id=".$employee_id." LIMIT $start,$limit ");		
		return $result=$result->result();
	
	}
	
   public function count_get_all_clients_for_emp($limit,$start)
	{
		$sesVal=$this->session->userdata('my_session');
		$employee_id=$sesVal['employee_id'];
		$result=$this->db->query("select * from lead_assigned_to,client where lead_id=client_id and status='paid' and employee_id=".$employee_id." ");		
		return $result=$result->num_rows();
	
	}
	
	public function count_rows($table,$active)
	{
		$this->db->from($table);
		if(!empty($active))
		{
			$this->db->where('active',$active);
		}
		$this->db->where('status','paid');
	    $query = $this->db->count_all_results();
		return $query;
	}
}	
