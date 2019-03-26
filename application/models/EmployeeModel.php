<?php

class EmployeeModel extends CI_Model
{
	
	
	public function get_emp_leads($limit,$start)
	{
		$row1=$this->session->userdata('my_session');	
		$result=$this->db->query("select client.first_name,client.status,client.middle_name,client.last_name,
		gender,email,address,profession,client.mobile,client.client_id,follow_up_date,client.color_bit from 
		lead_assigned_to,client where client.client_id=lead_assigned_to.lead_id and client.disposed='no' and
		lead_assigned_to.employee_id='".$row1['employee_id']."' order by client_id DESC LIMIT $start,$limit  ");
        $result1=$result->result();
		return $result1;
    }
    
    public function get_emp_todays_leads($limit,$start)
    {
		date_default_timezone_set("Asia/Kolkata");
		$date=DATE('Y-m-d');
	   	$row1=$this->session->userdata('my_session');	
		$result=$this->db->query("select client.first_name,client.status,client.middle_name,client.last_name,
		gender,email,address,profession,client.mobile,client.client_id,follow_up_date,client.color_bit from 
		lead_assigned_to,client where client.client_id=lead_assigned_to.lead_id and client.disposed='no' and lead_assigned_to.date='".$date."'and
		lead_assigned_to.employee_id='".$row1['employee_id']."' order by color_bit ASC LIMIT $start,$limit  ");
        $result1=$result->result();
		return $result1;
	}	    
      public function selectServices()
	{
		$this->db->select('*');
		$this->db->from('services');
		$query = $this->db->get();
		return $query->result();
	}

    
    public function count_emp()
	{
		$row1=$this->session->userdata('my_session');	
		$this->db->select('*');
		$this->db->from('lead_assigned_to');
		$this->db->join('client','client.client_id = lead_assigned_to.lead_id');
		$this->db->where('disposed','no');
		$this->db->where('employee_id',$row1['employee_id']);
		/*$result=$this->db->query("select client.first_name,client.status,client.middle_name,client.last_name,
		gender,email,address,profession,client.mobile,client.client_id,follow_up_date from 
		lead_assigned_to,client where client.client_id=lead_assigned_to.lead_id and client.disposed='no' and
		lead_assigned_to.employee_id=".$row1['employee_id'] );*/
        $result=$this->db->count_all_results();
		return $result;
    }
    
    public function count_todays_leads()
    {
		date_default_timezone_set("Asia/Kolkata");
		$date=DATE('Y-m-d');
	   $row1=$this->session->userdata('my_session');	
		$this->db->select('*');
		$this->db->from('lead_assigned_to');
		$this->db->join('client','client.client_id = lead_assigned_to.lead_id');
		$this->db->where('disposed','no');
		$this->db->where('employee_id',$row1['employee_id']);
		$this->db->where('lead_assigned_to.date',$date);
		
		/*$result=$this->db->query("select client.first_name,client.status,client.middle_name,client.last_name,
		gender,email,address,profession,client.mobile,client.client_id,follow_up_date from 
		lead_assigned_to,client where client.client_id=lead_assigned_to.lead_id and client.disposed='no' and
		lead_assigned_to.employee_id=".$row1['employee_id'] );*/
        $result=$this->db->count_all_results();
		return $result;
	
	}
    
	public function get_todays_followup($limit,$start)
	{
		date_default_timezone_set("Asia/Kolkata");
		$date_today= date("Y-m-d");
		$row1=$this->session->userdata('my_session');	
		$result=$this->db->query("select  client.first_name,client.status,client.middle_name,client.last_name,
		client.mobile,client.client_id,gender,email,profession,address,mobile,follow_up_date  from client,lead_assigned_to where client.client_id=lead_assigned_to.lead_id and follow_up_date='".$date_today."' 
		 and lead_assigned_to.employee_id=".$row1['employee_id']." order by follow_up_date LIMIT $start,$limit");		
		return $result=$result->result();
	}
	
	public function count_follow_up_date_emp($limit)
	{
		date_default_timezone_set("Asia/Kolkata");
		$date_today= date("Y-m-d");
		$row1=$this->session->userdata('my_session');	
		$result=$this->db->query("select client.first_name,client.status,client.middle_name,client.last_name,
		client.mobile,client.client_id,gender,email,profession,address,mobile,follow_up_date 
		from client,lead_assigned_to where client.client_id=lead_assigned_to.lead_id and follow_up_date='".$date_today."' 
		 and lead_assigned_to.employee_id=".$row1['employee_id']." order by follow_up_date ");		
		return $result=$result->num_rows();
	}
	
	public function get_employee_list($limit,$start)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->limit($limit,$start);
		$row=$this->db->get()->result();
		return $row;
		
		
    }
	public function get_employee($employee_id)
	{
		$row=$this->db->query("select * from users where employee_id=".$employee_id);
		$row=$row->result();
		return $row;
	}
	public function update_employee($data)
	{
		$this->db->query("update users set  username='".$data->username."',first_name='".$data->first_name."',middle_name='".$data->middle_name."',last_name='".$data->last_name."', father_name='".$data->father_name."',address='".$data->address."',role='".$data->role."',subpost='".$data->subpost."',email='".$data->email."',mobile='".$data->mobile."' where employee_id=".$data->employee_id);
	}
	public function delete_employee($employee_id)
	{
		$this->db->query("update client set assigned='no' where client_id in (select lead_id from lead_assigned_to where employee_id=".$employee_id." )");
		$this->db->query("delete from lead_assigned_to where employee_id='".$employee_id."'");
		$this->db->query("delete from users where employee_id=".$employee_id);
	}
	
	public function count($table)
	{
		return $this->db->count_all($table);
	}
	
	public function get_designation($employee_id)	
    {
		$row=$this->db->query("select * from user_designation");
		return $row->result();
    }
    
    public function get_post()
    {
        $row=$this->db->query("select * from user_designation");
		return $row->result();
    }
    
    public function get_employee_data($user)
    {
        $row=$this->db->query("select * from users where employee_id= $user ");
		return $row->result();
    }
 public function lead_emp_record($employeeid)
    {
        $row=$this->db->query("select * from users where employee_id= $employeeid ");
		return $row->result();
    }

    
    public function get_remark($id,$clientid)
	{
	    $row=$this->db->query("select users.first_name as fname,users.middle_name as mname,users.last_name as lname,users.username,
		client.first_name,client.status,client.middle_name,client.last_name,client.mobile,comment,comment_history.date from 
		users,comment_history,client where users.employee_id=comment_history.employee_id and 
		client.client_id=comment_history.client_id and comment_history.employee_id=$id and comment_history.client_id=$clientid order  by date desc");
	   //	$row=$this->db->query("select * from comment_history where employee_id=$id and client_id=$clientid order by date desc");
		$row=$row->result();
		return $row;
	}
	
	public function resetPassword($user_id,$new_pswd)
	{ //echo $new_pswd.$user_id;
	      $row = $this->db->query("update users set password='".$new_pswd."' where employee_id='".$user_id."'");
			if($row)
			{
				return true;
			}
				
			else
			{
				
			   return false;
			}
		
		
		
	}
public function target_assigned($data)
{
//echo $user_id.$target;
// $this->db->query("insert into target (employee_id,target_assign,start_date,end_date) values ('".$user_id."','"$target."','".$start_date."','".$end_date."')");
$this->db->insert('target',$data);
}
public function target_emp($employeeid,$limit,$start)
{
	
		$row=$this->db->query("select * from target where employee_id=".$employeeid." order by end_date desc LIMIT $start,$limit");
		$row=$row->result();
		return $row;
}

  public function count_target_emp($employeeid)
   {
	    $row=$this->db->query("select * from target where employee_id='".$employeeid."' order by end_date desc ");
		$row=$row->num_rows();
		return $row;
  }
  public function get_target_data($target_id)
    {
        $row=$this->db->query("select * from target where target_id= $target_id ");
		return $row->result();
    }
    public function target_achieve($data)
    {
		$this->db->insert('target_ach',$data);
	}
	public function target_history($target_id)
	{
		$row=$this->db->query("select * from target_ach, target where target.target_id=target_ach.target_id and target_ach.target_id= $target_id ");
		//print_r ($row);
		return $row->result();
		
	}
	public function get_target_total($target_id)
	{
		$row=$this->db->query("select * ,sum(target_ach.target_achieve) as total from target,target_ach where target.target_id=target_ach.target_id and target_ach.target_id= $target_id ");
		//print_r ($row);
		return $row->result();
	}
	public function make_sell_order($client_id)
	{
		$row=$this->db->query("select * from client where client_id= $client_id ");
		return $row->result();
	}
	
	public function save_sell_order($data)
	{
		$this->db->insert('client_sell_order',$data);		
	}
	
	public function view_sell_order($client_id)
	{
		$row=$this->db->query("select * from client_sell_order where client_id= $client_id ");
		return $row->result();
	}
	
       public function getUserp()
       {    $e_id= $_POST['employee_id'];
         $query=$this->db->query("select * from users where employee_id='".$e_id."' ");
          return $query->result();
       }
	
	public function check_username($user)
	{
	   $query=$this->db->query("select * from users where username='".$user."'");
	   return $query->num_rows();
	}
}
