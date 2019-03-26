<?php

class ServiceModel extends CI_Model
{
	
	public function insert($service_name,$service_amount,$quaterly_amount,$halfyearly_amount,$yearly_amount)
	{
		$this->db->query("insert into services(service_name,service_amount,quaterly_amount,halfyearly_amount,yearly_amount) values 
		('".$service_name."','".$service_amount."','".$quaterly_amount."','".$halfyearly_amount."','".$yearly_amount."')");
	}
	
	public function count($table)
	{
	    return $this->db->count_all($table);
	    
	}
	
	public function view($limit,$start)
	{
		$row=$this->db->query("select * from services LIMIT $start,$limit ");
		
		$row=$row->result();
		return $row;
	}
	
	public function delete($service_id)
	{
		$this->db->query("delete from services where service_id=".$service_id);
	}
	
	public function insert_client_services($id,$service_id,$client_id,$s,$e)
	{
		$this->db->query("delete from client_services where client_id='$client_id'");
		foreach($service_id as $sid)
		 {
			//$this->db->query("select * from  client_services values('".$client_id."','".$sid."')");
			
			$this->db->query("insert into client_services (client_id,service_id,start_date,end_date,employee_id) values('$client_id','$sid','$s','$e','$id')");
	         
	     }
	}
	
	public function view_client_services($client_id)
	{
		$row=$this->db->query("select client_services.service_id,client_services.client_id,client.first_name,client.last_name,client.mobile,services.service_name  from client_services,services,client where client.client_id=".$client_id." and client_services.client_id=".$client_id." and client_services.service_id=services.service_id" );
		$row=$row->result();
		return $row;
	}
	
	public function view_services($client_id)
	{
		$row=$this->db->query("SELECT * FROM `client_services`,services WHERE services.service_id=client_services.service_id and client_services.client_id=$client_id" );
		$row=$row->result();
		return $row;
	}
	public function delete_client_services($data)
	{
		$this->db->query("delete from client_services where client_id=".$data->client_id." and service_id=".$data->service_id);
	}
	
	public function edit($id)
	{
	    $row=$this->db->query("select * from services where service_id=".$id);
	    return $row->result();
	}
	
	public function update($data)
	{
	    $this->db->query("update services set service_name='".$data->service."',service_amount='".$data->service_amoun."',quaterly_amount='".$data->quaterly_amount."',halfyearly_amount='".$data->halfyearly_amount."',yearly_amount='".$data->yearly_amount."'  where service_id=".$data->id);
	}
	public function set_call_status($emp_id,$client_id,$status,$date)
	{
			$this->db->query("insert into count_calls (employee_id,client_id,call_status,date) values('$emp_id','$client_id','$status','$date')");
    }
}
