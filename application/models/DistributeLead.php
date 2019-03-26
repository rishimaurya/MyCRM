<?php

class DistributeLead extends CI_Model
{
	
	public function get_count()
	{
		//$data= new stdClass();
		$client_count=$this->db->query("select count(*) as client_no from client where assigned='no'");
		$emp_count=$this->db->query("select count(*) as emp_no from users where role='employee'");
		
	
		
		$client_count=$client_count->result();
		$emp_count=$emp_count->result();
		$count['client_count']=$client_count[0]->client_no;
		$count['emp_count']=$emp_count[0]->emp_no;
		
		
		
		return $count;
		
	}
	public function get_client_id()
	{
		$client_id=$this->db->query("select client_id from client where assigned='no'");
		
		$client_id=$client_id->result();
		
		return $client_id;
	}
	public function get_emp_id()
	{
		
		$emp_id=$this->db->query("select employee_id from users where role='employee'");
		
		$emp_id=$emp_id->result();
		return $emp_id;
		
	}
	
	public function assigned_to($data)
	{
		$this->db->insert_batch('lead_assigned_to',$data);
		//$this->db->query("insert into lead_assigned_to values(".$emp_id.",".$client_id.")");
		//$this->db->query("update client set assigned='yes' where client_id=".$client_id);
	}
	public function show_assigned_leads($limit,$start)
	{
		$this->db->select('users.first_name as fname,users.middle_name as mname,users.last_name as lname,users.username,client.first_name,client.middle_name,client.last_name,client.status,client.mobile,client.client_id,client.disposed');
		$this->db->from('lead_assigned_to');
		$this->db->join('users','users.employee_id = lead_assigned_to.employee_id');
		$this->db->join('client','client.client_id = lead_assigned_to.lead_id');
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	public function show_assigned_leadsEmp($limit,$start)
	{
	   $sesVal=$this->session->userdata('my_session');
		$this->db->select('users.first_name as fname,users.middle_name as mname,users.last_name as lname,users.username,client.first_name,client.middle_name,client.last_name,client.status,client.mobile,client.client_id,client.disposed');
		$this->db->from('lead_assigned_to');
		$this->db->join('users','users.employee_id = lead_assigned_to.employee_id');
		$this->db->join('client','client.client_id = lead_assigned_to.lead_id');
		$this->db->where('lead_assigned_to.employee_id',$sesVal['employee_id']);
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	public function count_show_assigned_leadsEmp($limit)
	{
	   $sesVal=$this->session->userdata('my_session');
		$this->db->select('users.first_name as fname,users.middle_name as mname,users.last_name as lname,users.username,client.first_name,client.middle_name,client.last_name,client.status,client.mobile,client.client_id,client.disposed');
		$this->db->from('lead_assigned_to');
		$this->db->join('users','users.employee_id = lead_assigned_to.employee_id');
		$this->db->join('client','client.client_id = lead_assigned_to.lead_id');
		$this->db->where('lead_assigned_to.employee_id',$sesVal['employee_id']);
		$query = $this->db->get();
		$result = $query->num_rows();
		return $result;
	}
	public function unassign_lead($client_id)
	{
		$this->db->query("delete from lead_assigned_to where lead_id=".$client_id);
		$this->db->query("update client set assigned='no' where client_id=".$client_id);
	}
	public function unassign_all_leads()
	{
		$this->db->query("update client set assigned='no'");
		$this->db->query("truncate table lead_assigned_to");
		
	}
	
	public function count_follow_date_rows($table)
	{
	    $date = date("y-m-d");
	    $this->db->from('client');
		$this->db->where('follow_up_date',$date);
		$query = $this->db->count_all_results();
		return $query;
	}
	
	public function count($table)
	{
		return $this->db->count_all($table);
	}
	
}
