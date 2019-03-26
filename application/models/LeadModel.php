<?php

class LeadModel extends CI_Model
{
	
	public function insert_users($data)
	{			 
		     $this->db->insert('client',$data);
		     // echo $this->db->insert_id();
		     return $this -> db -> insert_id();
			
	}
	
	public function insert_services($service,$s,$e)
	{
		$data=array();
		if($data)
		{
		foreach($service['service_id'] as $r)
		{
			$data[] = array(
			 'client_id' => $service['lead'],
			 'service_id' => $r,
			 'start_date' => $s,
			 'end_date' =>$e
			);
	    
	    
		}
		$this->db->insert_batch('client_services',$data);
		}
		else
		return;
		
	}
	
	 public function check_duplicate($mob)
              {
	            $query = $this->db->query("SELECT mobile FROM `client` WHERE mobile='$mob'");
 	            return $query->num_rows(); 
              }
              
              
	public function active_client_services($id)
	{
		$tnums=$_POST['nums'];$i=1;
		while($i < $tnums)
		{
			if(isset($_POST['services'.$i]))
			{
				if($_POST['services'.$i]==='1')
				{
					$data[] = array(
						'client_id' =>$_POST['client_id'],
						'service_id' =>$_POST['ser_id'.$i],
						'start_date' =>$_POST['start_date'],
						'end_date' =>$_POST['end_date'],
						'employee_id' =>$id
							);
				}
			}
			$i++;
		}
		$query = $this->db->insert_batch('client_services',$data);
		if($query)
		{
			return true;
		}
		else return false;
	}
	
	
	public function get_leads($limit,$start) {
       
		
        $query = $this->db->limit($limit,$start);
        $this->db->order_by('client_id','DESC');
        $query = $this->db->get('client');
        //$query = $this->db->query("Select * from client order by client_id DESC  LIMIT $start,$limit ");
                
        /*("select * from client where disposed='no' order by follow_up_date");*/
        return $result = $query->result();
    }
	
	public function get_disposed_leads($limit,$start)
	{
		$this->db->select('*');
        $this->db->from('client');
		$this->db->where('disposed','yes');
		$this->db->limit($limit,$start);
        $query = $this->db->get();
        return $result = $query->result();
	}
	public function edit($data,$employee_id)
	{
		$this->client=$this->db->query("select * from client where client_id=".$data->client_id);
		$this->client_services=$this->db->query("select service_id from client_services where client_id=".$data->client_id);
		$this->services=$this->db->query("select * from services");
		$this->comment=$this->db->query("select * from comment_history where client_id='".$data->client_id."' and employee_id='".$employee_id."'");
		return $this;
	}
	public function edit_disposed_leads($data)
	{
		$row=$this->db->query("select * from client where disposed='yes' and client_id=".$data->client_id);
		return $row;
	}
	public function update_leads($data,$date_today)
	{
		$row1=$this->session->userdata('my_session');
		$this->db->query("update client set first_name='".$data->first_name."', last_name='".$data->last_name."',
		middle_name='".$data->middle_name."' , mobile='".$data->mobile."', email='".$data->email."', status='".$data->status."', follow_up_date='".$data->follow_up_date."', leadsource='".$data->leadsource."', gender='".$data->gender."',start_date='".$data->start_date."',end_date='".$data->end_date."',investment='".$data->investment."',color_bit='".$data->color_bit."' where client_id=".$data->client_id);
		//For comments table
		if($data->comment!="")
		{	
			$query=$this->db->query("select * from comment_history where client_id=".$data->client_id);
			if($query->num_rows() == 0)
			{
			   	
			   $this->db->query("insert into comment_history(client_id,employee_id,date,comment) 
			   values('".$data->client_id."','".$row1['employee_id']."','".$date_today."','".$data->comment."')");
		    }
		    else
		    {
			   $this->db->query("update comment_history set employee_id='".$row1['employee_id']."' , date='".$date_today."', comment='".$data->comment."' where client_id=".$data->client_id );
			}
		}
	    
	}
	
	
	public function csv_source()
	{
		$query=$this->db->query("select distinct csv_source from client");
		return $query->result();
    }

	
	public function delete_leads($data)
	{
		//$row=$this->db->query("select * from client where client_id=".$data->client_id);
		//$row=$row->result();
		//$this->db->insert('disposed_leads',$row[0]);
		$this->db->query("update client set disposed='yes',status='no status',assigned='no' where client_id=".$data->client_id);
                $this->db->query("delete from lead_assigned_to where lead_id=".$data->client_id);
	}
	public function delete_disposed_leads($data)
	{
		
		$this->db->query("delete from client where client_id=".$data->client_id);
	
	}
	
	public function get_leads_by_date($limit,$start)
	{
		$this->db->where('follow_up_date',get_cookie('follow_up_date'));//echo get_cookie('follow_up_date');
		$query = $this->db->limit($limit,$start);
        $query = $this->db->get('client');
                
        return $result = $query->result();
	}
	public function get_leads_by_status($limit,$start)
	{
		$this->db->select('*');
		$this->db->from('client');
		$this->db->where('status',get_cookie('status'));
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		return $result=$query->result();
	}
	
	public function get_leads_by_startDate($limit,$start)
	{
		$this->db->select('*');
		$this->db->from('client');
		if( ( get_cookie('status')=="paid" OR  get_cookie('status')=="freetrial") )
		{
			$status = get_cookie('status');
			$this->db->where('status',$status);
		}
		$this->db->where('start_date',get_cookie('sdate'));
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		return $result=$query->result();
	}
	
	public function get_leads_by_endDate($limit,$start)
	{
		$this->db->select('*');
		$this->db->from('client');
		$this->db->where('end_date',get_cookie('end_date'));
		if(( get_cookie('status')=="paid" OR  get_cookie('status')=="freetrial") )
		{
			$status = get_cookie('status');
			$this->db->where('status',$status);
		}
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		return $result=$query->result();
	}

    public function get_leads_by_Start_endDate($limit,$start)
	{
		$this->db->select('*');
		$this->db->from('client');
		if(( get_cookie('status')=="paid" OR  get_cookie('status')=="freetrial") )
		{
			$status = get_cookie('status');
			$this->db->where('status',$status);
		}
		$where="(start_date >='".get_cookie('sdate')."' AND end_date <='".get_cookie('end_date')."')";
		$this->db->where($where);
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		return $result=$query->result();
	}
	
    public function count_get_leads_by_Start_endDate($limit)
	{
		$this->db->select('*');
		$this->db->from('client');
		if ( get_cookie('status')=="paid" OR  get_cookie('status')=="freetrial" )
		{
			$status = get_cookie('status');
			$this->db->where('status',$status);
		}
		$where="(start_date >='".get_cookie('sdate')."' AND end_date <='".get_cookie('end_date')."')";
		$this->db->where($where);
		$query = $this->db->get();
		return $result=$query->num_rows();
	}
	
	public function get_leads_by_Services($limit,$start)
	{
		$service=get_cookie('services');
		$result = $this->db->query("Select * from client,client_services where client.client_id = client_services.client_id and client_services.service_id='".$service."' LIMIT $start,$limit");
        return $result = $query->result();
		 
	}
	
	public function count_get_leads_by_Services($limit)
	{
		$service=get_cookie('services');		
		$result = $this->db->query("Select * from client,client_services where client.client_id = client_services.client_id and client_services.service_id='".$service."' ");
        return $result = $query->num_rows();
		 
	}
	
	public function get_leads_by_status_date($limit,$start)
	{
		$this->db->where('status',get_cookie('status'));
		$this->db->where('follow_up_date',get_cookie('follow_up_date'));
		$query = $this->db->limit($limit,$start);
        $query = $this->db->get('client');
                
        return $result = $query->result();
		 
	}
	
	public function get_todays_followup($limit,$start)
	{
		date_default_timezone_set("Asia/Kolkata");
		$date_today= date("Y-m-d");
			
		$this->db->select('client.client_id, client.first_name as first_name, client.last_name as last_name,users.first_name as fname, users.last_name as lname, client.email as email , client.mobile as mobile,client.follow_up_date as follow_up_date,client.status as status ');
        $this->db->from('client, users,lead_assigned_to');
       // $this->db->where('follow_up_date',$date_today);
        $where = "users.employee_id=lead_assigned_to.employee_id and client.client_id=lead_assigned_to.lead_id and client.follow_up_date='$date_today' ";		
	    $this->db->where($where);
        $this->db->order_by('follow_up_date');
        $this->db->limit($limit,$start);
        $query = $this->db->get();
		/*query("select * from client where follow_up_date='".$date_today."' order by follow_up_date");*/		
		return $result=$query->result();
	
	}
	
	public function get_comment_history($limit,$start)
	{
		$row=$this->db->query("select users.first_name as fname,users.middle_name as mname,users.last_name as lname,users.username,
		client.first_name,client.status,client.middle_name,client.last_name,client.mobile,comment,comment_history.date from 
		users,comment_history,client where users.employee_id=comment_history.employee_id and 
		client.client_id=comment_history.client_id order by date desc LIMIT $start,$limit");
		$row=$row->result();
		return $row;
	}
	
	public function count_get_comment_history()
	{
		$row=$this->db->query("select users.first_name as fname,users.middle_name as mname,users.last_name as lname,users.username,
		client.first_name,client.status,client.middle_name,client.last_name,client.mobile,comment,comment_history.date from 
		users,comment_history,client where users.employee_id=comment_history.employee_id and 
		client.client_id=comment_history.client_id order by date desc");
		$row=$row->num_rows();
		return $row;
	}
	
	public function get_comment_history_emp($limit,$start)
	{
		$row1=$this->session->userdata('my_session');
		$emp_id=$row1['employee_id'];
		$row=$this->db->query("select users.first_name as fname,users.middle_name as mname,users.last_name as lname,users.username,
		client.first_name,client.status,client.middle_name,client.last_name,client.mobile,comment,comment_history.date from 
		users,comment_history,client where users.employee_id=comment_history.employee_id and 
		client.client_id=comment_history.client_id and users.employee_id=$emp_id order by date desc LIMIT $start,$limit");
		$row=$row->result();
		return $row;
	}
	
	public function count_get_comment_history_emp()
	{
		$row1=$this->session->userdata('my_session');
		$emp_id=$row1['employee_id'];
		$row=$this->db->query("select users.first_name as fname,users.middle_name as mname,users.last_name as lname,users.username,
		client.first_name,client.status,client.middle_name,client.last_name,client.mobile,comment,comment_history.date from 
		users,comment_history,client where users.employee_id=comment_history.employee_id and 
		client.client_id=comment_history.client_id and users.employee_id=$emp_id order by date desc");
		$row=$row->num_rows();
		return $row;
	}
	
	
	public function get_remark($id)
	{
	    /*	$row=$this->db->query("select users.first_name as fname,users.middle_name as mname,users.last_name as lname,users.username,
		client.first_name,client.status,client.middle_name,client.last_name,client.mobile,comment,comment_history.date from 
		users,comment_history,client where  users.employee_id=comment_history.employee_id and 
		client.client_id=comment_history.client_id and employee_id=$id order by date desc");
		$row=$row->result();
		return $row;*/
	}
	public function update_dispose_to_client($data)
	{
		$this->db->query("update client set disposed='no' where client_id=".$this->client_id);
	}
	public function get_leads_by_status_date_emp($limit,$start)
	{
		$row1=$this->session->userdata('my_session');
		$result=$this->db->query("select * from lead_assigned_to,client where lead_assigned_to.lead_id=client.client_id and 
		lead_assigned_to.employee_id=".$row1['employee_id']." and status='".get_cookie('status')."' and follow_up_date='".get_cookie('follow_up_date')."' LIMIT $start,$limit ");
		$result=$result->result();
		return $result; 
		
	}
	
	public function count_get_leads_by_status_date_emp($table)
	{
		$row1=$this->session->userdata('my_session');
		$result=$this->db->query("select * from lead_assigned_to,client where lead_assigned_to.lead_id=client.client_id and 
		lead_assigned_to.employee_id=".$row1['employee_id']." and status='".get_cookie('status')."' and follow_up_date='".get_cookie('follow_up_date')."' ");
		$result=$result->num_rows();
		return $result; 
		
	}
	
	
	public function get_leads_by_date_emp($limit,$start)
	{
		$row1=$this->session->userdata('my_session');
		$result=$this->db->query("select * from lead_assigned_to,client where lead_assigned_to.lead_id=client.client_id and 
		lead_assigned_to.employee_id=".$row1['employee_id']."  and follow_up_date='".get_cookie('follow_up_date')."' LIMIT $start,$limit" );
		$result=$result->result();
		return $result; 
	}
	
    public function count_get_leads_by_date_emp($table)
	{
		$row1=$this->session->userdata('my_session');
		$result=$this->db->query("select * from lead_assigned_to,client where lead_assigned_to.lead_id=client.client_id and 
		lead_assigned_to.employee_id=".$row1['employee_id']."  and follow_up_date='".get_cookie('follow_up_date')."'");
		$result=$result->num_rows();
		return $result; 
	}
	
	public function get_leads_by_status_emp($limit,$start)
	{
		$row1=$this->session->userdata('my_session');
		$result=$this->db->query("select * from lead_assigned_to,client where lead_assigned_to.lead_id=client.client_id and 
		lead_assigned_to.employee_id=".$row1['employee_id']." and status='".get_cookie('status')."' LIMIT $start,$limit ");
		$result=$result->result();
		return $result; 
	}
	public function get_leads_by_Services_emp($limit,$start)
	{
		$row1=$this->session->userdata('my_session');
		$result=$this->db->query("select * from lead_assigned_to,client,client_services where client.client_id=client_services.client_id and lead_assigned_to.lead_id=client.client_id and 
		lead_assigned_to.employee_id=".$row1['employee_id']." and service_id='".get_cookie('services')."' LIMIT $start,$limit ");
		$result=$result->result();
		return $result; 
	}
	public function count_get_leads_by_Services_emp($limit)
	{
		$row1=$this->session->userdata('my_session');
		$result=$this->db->query("select * from lead_assigned_to,client,client_services where client.client_id=client_services.client_id and lead_assigned_to.lead_id=client.client_id and 
		lead_assigned_to.employee_id=".$row1['employee_id']." and service_id='".get_cookie('services')."'");
		$result=$result->num_rows();
		return $result; 
	}
	
	public function count_get_leads_by_status_emp($limit)
	{
		$row1=$this->session->userdata('my_session');
		$result=$this->db->query("select * from lead_assigned_to,client where lead_assigned_to.lead_id=client.client_id and 
		lead_assigned_to.employee_id=".$row1['employee_id']." and status='".get_cookie('status')."'");
		$result=$result->num_rows();
		return $result; 
	}
	
	public function get_leads_by_Startdate_emp($limit,$start)
	{
		$row1=$this->session->userdata('my_session');
		$result=$this->db->query("select * from lead_assigned_to,client where lead_assigned_to.lead_id=client.client_id and 
		lead_assigned_to.employee_id=".$row1['employee_id']."  and start_date='".get_cookie('sdate')."' LIMIT $start,$limit" );
		$result=$result->result();
		return $result; 
	}
	
	public function count_get_leads_by_Startdate_emp($limit)
	{
		$row1=$this->session->userdata('my_session');
		$result=$this->db->query("select * from lead_assigned_to,client where lead_assigned_to.lead_id=client.client_id and 
		lead_assigned_to.employee_id=".$row1['employee_id']."  and start_date='".get_cookie('sdate')."' " );
		$result=$result->num_rows();
		return $result; 
	}
	
	public function get_leads_by_Enddate_emp($limit,$start)
	{
		$row1=$this->session->userdata('my_session');
		$result=$this->db->query("select * from lead_assigned_to,client where lead_assigned_to.lead_id=client.client_id and 
		lead_assigned_to.employee_id=".$row1['employee_id']."  and end_date='".get_cookie('end_date')."' LIMIT $start,$limit" );
		$result=$result->result();
		return $result; 
	}
	
	public function count_get_leads_by_Enddate_emp($limit)
	{
		$row1=$this->session->userdata('my_session');
		$result=$this->db->query("select * from lead_assigned_to,client where lead_assigned_to.lead_id=client.client_id and 
		lead_assigned_to.employee_id=".$row1['employee_id']."  and end_date='".get_cookie('end_date')."'" );
		$result=$result->num_rows();
		return $result; 
	}
	
	public function get_leads_by_Start_EndDate_emp($limit,$start)
	{
		$row1=$this->session->userdata('my_session');
		if(( get_cookie('status')=="paid" OR  get_cookie('status')=="freetrial") )
		{
			$status = get_cookie('status');
		}
		$result=$this->db->query("select * from lead_assigned_to,client where lead_assigned_to.lead_id=client.client_id and 
		lead_assigned_to.employee_id=".$row1['employee_id']." and status='".$status."' and start_date >='".get_cookie('sdate')."' and
		 end_date <='".get_cookie('end_date')."' LIMIT $start,$limit" );
		$result=$result->result();
		return $result; 
	}
	
	public function count_get_leads_by_Start_EndDate_emp($limit)
	{
		$row1=$this->session->userdata('my_session');
		if(( get_cookie('status')=="paid" OR  get_cookie('status')=="freetrial") )
		{
			$status = get_cookie('status');
		}
		$result=$this->db->query("select * from lead_assigned_to,client where lead_assigned_to.lead_id=client.client_id and 
		lead_assigned_to.employee_id=".$row1['employee_id']." and status='".$status."' and start_date >='".get_cookie('sdate')."' and
		 end_date <='".get_cookie('end_date')."' " );
		$result=$result->num_rows();
		return $result; 
	}
	
	public function mobile_track($mobile)
	{
		
			$row1=$this->db->query("select users.first_name as fname,users.middle_name as mname,users.last_name as lname,users.username,client.first_name,client.middle_name,client.last_name,client.mobile, users.mobile as mob, client.client_id from client,lead_assigned_to,users where lead_assigned_to.employee_id=users.employee_id  and client.client_id=lead_assigned_to.lead_id and  client.mobile='".$mobile."'");
			$row1=$row1->result();

		  	    
		  	if($row1)
			{
				return $row1;
			}
			else
		   {   
             $query = $this->db->query("select first_name,middle_name,last_name,mobile, client_id from client where mobile = $mobile ");
             if($query)
                return $query->result();
			    
			  else 
			    return false;
			}
		
	}
	
	public function show_services()
	{
		 $this -> db -> select('*');
		 $this -> db -> from('services');
		 $query = $this -> db -> get();
		 if($query -> num_rows() > 0)
		 {
		    return $query->result();
		 }
		 else
		 {
			return false;
		 }
	}	
	
	public function count($table)
	{
		return $this->db->count_all($table);
	}
	
	public function searchemployee()
	{
		$this -> db -> select('*');
        $this -> db -> from('users'); 
             //  $this -> db -> where('user_status',1);
        $where = 'role="employee" AND (username LIKE "%'.$_POST['employee'].'%" OR mobile LIKE "%'.$_POST['employee'].'%");';
        $this->db->where($where); 
        $query = $this -> db -> get();
        echo '<ul id="country-list">';
        //echo '<select multiple name="student">';
        if($query -> num_rows() >=1)
            {
                foreach ($query->result() as $row) 
                    {
                          ?>
                            <li id="#country-list" onClick="selectemployee('<?php echo $row->username."/".$row->mobile; ?>');"><?php echo $row->username."/".$row->mobile; ?></li>
                      <?php
                    }
            }
             echo "</ul>";
	}
	
	public function searchlead()
	{
		$this -> db -> select('*');
        $this -> db -> from('client'); 
             //  $this -> db -> where('user_status',1);
        $where = 'assigned="no" AND(first_name LIKE "%'.$_POST['searchlead'].'%" OR mobile LIKE "%'.$_POST['searchlead'].'%");';
        $this->db->where($where); 
        $query = $this -> db -> get();
        echo '<ul id="country-list1">';
        //echo '<select multiple name="student">';
        if($query -> num_rows() >=1)
        {
            foreach ($query->result() as $row) 
                {
                       ?>
                        <li id="#country-list1" onClick="selectlead('<?php echo $row->first_name."/".$row->mobile; ?>');"><?php echo $row->first_name."/".$row->mobile; ?></li>
                      <?php
                }
        }
             echo "</ul>";
	}
	
	public function massign_lead()
	{

/*            $Sub=explode("/",$_POST['searchlead']); 
            $this -> db -> select('*');
            $this -> db -> from('client'); 
            $this -> db -> where('first_name',$Sub[0]);
            $this -> db -> where('mobile',$Sub[1]);
            $query = $this -> db -> get();
        if($query -> num_rows() ==1)
            {
                foreach ($query->result() as $row) 
                    {
                        $ClientId=$row->client_id;
                    }
            }
*/
         date_default_timezone_set("Asia/Kolkata");
		 $date_today= date("Y-m-d");
               $Sub1=explode("/",$_POST['employee']); 
               $this -> db -> select('*');
            $this -> db -> from('users'); 
            $this -> db -> where('username',$Sub1[0]);
            $this -> db -> where('mobile',$Sub1[1]);
            $query = $this -> db -> get();
            if($query -> num_rows() ==1)
                {
                    foreach ($query->result() as $row) 
                        {
                            $EmployeeId=$row->employee_id;
                        }
                }
            //Assign student to tutor
            $data = array(
                 'employee_id' => $EmployeeId,
                 'lead_id' => $_POST['client'],
                 'date' => $date_today
                        );
            $this->db->insert('lead_assigned_to', $data);
            $this->db->query("update client set assigned='yes',disposed='no' where client_id='".$_POST['client']."'");
                       
	}
	
	public function past_freetrial($limit,$start)
	{
		date_default_timezone_set("Asia/Kolkata");
		$date_today= date("Y-m-d");
		$this->db->select('client.client_id, client.first_name as first_name, client.last_name as last_name,users.first_name as fname, users.last_name as lname, client.email as email , client.mobile as mobile,client.follow_up_date as follow_up_date,client.status as status ');
        $this->db->from('client, users,lead_assigned_to');
        $where = "users.employee_id=lead_assigned_to.employee_id and client.client_id=lead_assigned_to.lead_id  and status='freetrial' and client.active='no' and ( end_date < '".$date_today."' ) ";		
	    $this->db->where($where);
		$this->db->limit($limit,$start);
        $query = $this->db->get();
        return $result = $query->result();
	}
	
	
	public function past_freetrial_count()
	{
		date_default_timezone_set("Asia/Kolkata");
		$date_today= date("Y-m-d");
	   $this->db->select('client.client_id, client.first_name as first_name, client.last_name as last_name,users.first_name as fname, users.last_name as lname, client.email as email , client.mobile as mobile,client.follow_up_date as follow_up_date,client.status as status ');
        $this->db->from('client, users,lead_assigned_to');
        $where = "users.employee_id=lead_assigned_to.employee_id and client.client_id=lead_assigned_to.lead_id  and status='freetrial' and client.active='no' and (end_date < '".$date_today."')";	
		$this->db->where($where);
		$query = $this->db->count_all_results();
        return $query;
	}
	
		
	public function active_freetrial($limit,$start)
	{
		date_default_timezone_set("Asia/Kolkata");
		$date_today= date("Y-m-d");
		
	$query=$this->db->query("SELECT client.client_id, client.first_name as first_name, client.last_name as last_name,users.first_name as fname, users.last_name as lname, client.email as email , client.mobile as mobile,client.follow_up_date as follow_up_date,client.status as status FROM client,users,lead_assigned_to  WHERE users.employee_id=lead_assigned_to.employee_id and client.client_id=lead_assigned_to.lead_id  and status='freetrial' and client.active='yes' and client.end_date >'".$date_today."'");
		
	/*$this->db->select('client.client_id, client.first_name as first_name, client.last_name as last_name,users.first_name as fname, users.last_name as lname, client.email as email , client.mobile as mobile,client.follow_up_date as follow_up_date,client.status as status ');
        $this->db->from('client, users,lead_assigned_to');
        $where = 'users.employee_id=lead_assigned_to.employee_id and client.client_id=lead_assigned_to.lead_id  and client.status="freetrial" and client.active="yes" AND (start_date LIKE "%'.$date_today.'%" and end_date > "'.$date_today.'" )';
		$this->db->where($where);
		$this->db->limit($limit,$start);
        $query = $this->db->get();*/
        return $result = $query->result();
	}
	
	public function active_freetrial_count()
	{
		date_default_timezone_set("Asia/Kolkata");
		$date_today= date("Y-m-d");
		
			$query=$this->db->query("SELECT client.client_id, client.first_name as first_name, client.last_name as last_name,users.first_name as fname, users.last_name as lname, client.email as email , client.mobile as mobile,client.follow_up_date as follow_up_date,client.status as status FROM client,users,lead_assigned_to  WHERE users.employee_id=lead_assigned_to.employee_id and client.client_id=lead_assigned_to.lead_id  and status='freetrial' and client.active='yes' and client.end_date >'".$date_today."'");       
			 return $query->num_rows();
        
	}
	
	public function active_freetrial_emp($limit,$start)
	{
		date_default_timezone_set("Asia/Kolkata");
		$date_today= date("Y-m-d");
		$row1=$this->session->userdata('my_session');
		
		$this->db->select('*');
        $this->db->from('client,lead_assigned_to');
        $where = 'lead_assigned_to.lead_id=client.client_id AND client.status="freetrial"  and client.active="yes" AND (client.start_date  LIKE "%'.$date_today.'%" and client.end_date >= "'.$date_today.'" ) AND 
        (lead_assigned_to.employee_id='.$row1['employee_id'].' )';
		$this->db->where($where);
		$this->db->limit($limit,$start);
        $query = $this->db->get();
        return $result = $query->result();
        
	}
	
	public function active_freetrial_emp_count($limit)
	{
		date_default_timezone_set("Asia/Kolkata");
		$date_today= date("Y-m-d");
		$row1=$this->session->userdata('my_session');
		
		$this->db->select('*');
        $this->db->from('client,lead_assigned_to');
        $where = 'lead_assigned_to.lead_id=client.client_id AND status="freetrial" and active="yes" AND (start_date  LIKE "%'.$date_today.'%" and end_date > "'.$date_today.'" ) AND 
        (lead_assigned_to.employee_id='.$row1['employee_id'].' )';
		$this->db->where($where);
		$query = $this->db->get();
        return $result = $query->num_rows();
    
	}
	
	public function past_freetrial_emp($limit,$start)
	{
		date_default_timezone_set("Asia/Kolkata");
		$date_today= date("Y-m-d");
		$row1=$this->session->userdata('my_session');
		
		$this->db->select('*');
        $this->db->from('client,lead_assigned_to');
        $where = 'lead_assigned_to.lead_id=client.client_id AND status="freetrial" and active="no" AND (end_date="'.$date_today.'" or end_date < "'.$date_today.'" ) AND lead_assigned_to.employee_id='.$row1['employee_id'].'';
		$this->db->where($where);
		$this->db->limit($limit,$start);
        $query = $this->db->get();
        return $result = $query->result();
        
	}
	
	public function past_freetrial_emp_count($limit)
	{
		date_default_timezone_set("Asia/Kolkata");
		$date_today= date("Y-m-d");
		$row1=$this->session->userdata('my_session');
		
		$this->db->select('*');
        $this->db->from('client,lead_assigned_to');
        $where = 'lead_assigned_to.lead_id=client.client_id AND status="freetrial" and active="no" AND (end_date="'.$date_today.'" or end_date < "'.$date_today.'" ) AND lead_assigned_to.employee_id='.$row1['employee_id'].'';
		$this->db->where($where);
		$query = $this->db->get();
        return $result = $query->num_rows();
        
	}
	
	public function count_follow_date_rows()
	{
	    $date = date("y-m-d");
	    $this->db->from('client');
		$this->db->where('follow_up_date',$date);
		$query = $this->db->count_all_results();
		return $query;
	}
	
	public function count_disposed_rows()
	{
	    $this->db->from('client');
		$this->db->where('disposed','yes');
		$query = $this->db->count_all_results();
		return $query;
	}
	
	public function count_rows($table)
	{
		$this->db->from($table);
		if( get_cookie('status')!="all")
		{
			$this->db->where('status',get_cookie('status'));
		}
		if(get_cookie('follow_up_date')!="")
		{
			$this->db->where('follow_up_date',get_cookie('follow_up_date'));
		}
		if(get_cookie('sdate')!="" )
		{
			$this->db->where('start_date',get_cookie('sdate'));
		}
		if(get_cookie('end_date')!="")
		{
			$this->db->where('end_date',get_cookie('end_date'));
		}
	    $query = $this->db->count_all_results();
		return $query;
	}
		public function show_assign_leads()
	{
		$Sub1=explode("/",$_POST['employee']);
		if(!empty($Sub1[1])){
		if(ctype_digit($Sub1[1])==1)
		{ 
			$this -> db -> select('*');
			$this -> db -> from('users'); 
			$this -> db -> where('username',$Sub1[0]);
			$this -> db -> where('mobile',$Sub1[1]);
			$query = $this -> db -> get();
			if($query -> num_rows() ==1)
			{
				foreach ($query->result() as $row) 
				{
					$EmployeeId=$row->employee_id;
				}
			}
		$date=DATE('Y-m-d');
		foreach($this->input->post('checkbox') as $value)
		{
		$data= array(
		'employee_id' =>$EmployeeId,
		'lead_id' => $value,
		'date'=>$date
		);
                $this->session->set_flashdata('success','Lead Distributed Sucessfully.');	
		$this->db->insert('lead_assigned_to', $data);
		$this->db->query("update client set assigned='yes',disposed='no' where client_id='".$value."'");
		}
		return redirect('/Leads/show_distributed_leads','refresh');
                }else{
                $this->session->set_flashdata('delete','Please Give Right Input.');
                   return redirect('/Leads/assignlead','refresh');
                }
                }else{
                $this->session->set_flashdata('delete','Please Give Right Input.');
                  return redirect('/Leads/assignlead','refresh');
                }
                
		
	}
	
	public function multiDisposing()
	{
		
		foreach($this->input->post('checkbox') as $value)
		{
		   $this->db->query("update client set disposed='yes',status='no status',assigned='no' where client_id=".$value);
           $this->db->query("delete from lead_assigned_to where lead_id=".$value );
		}
		
	}
	/*public function show_assign_leads()
	{
		$Sub1=explode("/",$_POST['employee']);
		if(!empty($Sub1[1])){
		if(ctype_digit($Sub1[1])==1)
		{ 
			$this -> db -> select('*');
			$this -> db -> from('users'); 
			$this -> db -> where('username',$Sub1[0]);
			$this -> db -> where('mobile',$Sub1[1]);
			$query = $this -> db -> get();
			if($query -> num_rows() ==1)
			{
				foreach ($query->result() as $row) 
				{
					$EmployeeId=$row->employee_id;
				}
			}
		$date=DATE('Y-m-d');
		foreach($this->input->post('checkbox') as $value)
		{
		$data= array(
		'employee_id' =>$EmployeeId,
		'lead_id' => $value,
		'date'=>$date
		);
                $this->db->insert('lead_assigned_to', $data);
		$this->db->query("update client set assigned='yes' where client_id='".$value."'");
                $this->session->set_flashdata('success','Lead Distributed Sucessfully.');	
		}//print_r($data);
		return redirect('/Leads/show_distributed_leads','refresh');
                }else{
                $this->session->set_flashdata('delete','Please Give Right Input.');
                   return redirect('/Leads/assignlead','refresh');
                }
                }else{
                $this->session->set_flashdata('delete','Please Give Right Input.');
                  return redirect('/Leads/assignlead','refresh');
                }
                
		
	}*/
	public function assignlead($limit,$start)
	{
		$this->db->select('*');
		$this->db->from('client');
		if( get_cookie('csv_source')!='all' and get_cookie('csv_source')!='' )
		{
		    $this->db->where('csv_source',get_cookie('csv_source'));
		}
		$this->db->where('assigned','no');
		$this->db->limit($limit,$start);
		$result = $this->db->get();
		return $result1=$result->result();
	}
	
	public function count_assignlead()
	{
		$this->db->select('*');
		$this->db->from('client');
		if( get_cookie('csv_source')!='all' and get_cookie('csv_source')!='' )
		{
		    $this->db->where('csv_source',get_cookie('csv_source'));
		}
		$this->db->where('assigned','no');
		$result = $this->db->get();
		return $result1=$result->num_rows();
	}
	public function count_lead($date_today)
	{
		
		// echo"<pre>"; print_r($result1->result()); 
	    /*$this->db->select("COUNT(lead_id) AS TotalLead");
        $this->db->from("lead_assigned_to");
        $where = 'date='.$date_today;
		$this->db->where($where);
       $query = $this->db->get();
       */
       $query=$this->db->query("select COUNT(lead_id) AS TotalLead from lead_assigned_to where date='$date_today' ");
        
        if($query->num_rows() > 0)
        { 
         $res = $query->row_array();
         $total=$res['TotalLead'];
         return $total;	
	 }
		//return $result1=$result1->result();
	}
	public function count_freetrial()
	{
		$date=DATE('Y-m-d');
		// echo"<pre>"; print_r($result1->result()); 
		$this->db->select("COUNT(client_id) AS Totalfreetrial");
        $this->db->from("client");
       // $this -> db -> where('status','freetrial');
        //$this -> db -> where('start_date',$date);        
         $where = ' status="freetrial" and active="yes" and start_date="'.$date.'"';
		$this->db->where($where);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        { 
         $res = $query->row_array();
         $total=$res['Totalfreetrial'];
         return $total;	
	 }
		//return $result1=$result1->result();
	}
	public function count_client()
	{
		$date=DATE('Y-m-d');
		// echo"<pre>"; print_r($result1->result()); 
		/*$this->db->select("COUNT(client_id) AS Totalclient");
        $this->db->from("client");
        $this -> db -> where('status','paid');
        $query = $this->db->get();
        */
        $query=$this->db->query("SELECT COUNT(client.client_id) as Totalclient FROM client WHERE client.start_date='$date' and status='paid' and active='yes'");
         if($query->num_rows() > 0)
        { 
         $res = $query->row_array();
         $total=$res['Totalclient'];
         return $total;	
	 }
		//return $result1=$result1->result();
	}
	
	public function count_unapprove_client()
	{
		$date=DATE('Y-m-d');
		// echo"<pre>"; print_r($result1->result()); 
		/*$this->db->select("COUNT(client_id) AS Totalclient");
        $this->db->from("client");
        $this -> db -> where('status','paid');
        $query = $this->db->get();
        */
        $query=$this->db->query("SELECT COUNT(client.client_id) as Totalclientunap FROM client,client_sell_order WHERE   client.client_id=client_sell_order.client_id and client.start_date='$date' and status='paid' and active='no'");
         if($query->num_rows() > 0)
        { 
         $res = $query->row_array();
         $total=$res['Totalclientunap'];
         return $total;	
	 }
		//return $result1=$result1->result();
	}
	public function count_unapprove_client_emp($id)
	{
		$date=DATE('Y-m-d');
		// echo"<pre>"; print_r($result1->result()); 
		/*$this->db->select("COUNT(client_id) AS Totalclient");
        $this->db->from("client");
        $this -> db -> where('status','paid');
        $query = $this->db->get();
        */
        $query=$this->db->query("SELECT COUNT(client.client_id) as Totalclientunapemp FROM client, lead_assigned_to,client_sell_order WHERE  client.client_id=lead_assigned_to.lead_id  and client.client_id=client_sell_order.client_id and client.start_date='$date' and status='paid' and active='no' and lead_assigned_to.employee_id=$id ");
         if($query->num_rows() > 0)
        { 
         $res = $query->row_array();
         $total=$res['Totalclientunapemp'];
         return $total;	
	 }
		//return $result1=$result1->result();
	}
	public function count_unapprove_free()
	{
		$date=DATE('Y-m-d');
		// echo"<pre>"; print_r($result1->result()); 
		/*$this->db->select("COUNT(client_id) AS Totalclient");
        $this->db->from("client");
        $this -> db -> where('status','paid');
        $query = $this->db->get();
        */
        $query=$this->db->query("SELECT COUNT(client.client_id) as Totalfreeunap FROM client WHERE  client.start_date='$date' and status='freetrial' and active='no'");
         if($query->num_rows() > 0)
        { 
         $res = $query->row_array();
         $total=$res['Totalfreeunap'];
         return $total;	
	 }
		//return $result1=$result1->result();
	}
	public function count_unapprove_free_emp($id)
	{
		$date=DATE('Y-m-d');
		// echo"<pre>"; print_r($result1->result()); 
		/*$this->db->select("COUNT(client_id) AS Totalclient");
        $this->db->from("client");
        $this -> db -> where('status','paid');
        $query = $this->db->get();
        */
        $query=$this->db->query("SELECT COUNT(client.client_id) as Totalfreeunapemp FROM client, lead_assigned_to WHERE  client.client_id=lead_assigned_to.lead_id and client.start_date='$date' and status='freetrial' and active='no' and lead_assigned_to.employee_id=$id ");
         if($query->num_rows() > 0)
        { 
         $res = $query->row_array();
         $total=$res['Totalfreeunapemp'];
         return $total;	
	 }
		//return $result1=$result1->result();
	}
		public function count_lead_emp($id,$date_today)
	{
		/*$date=DATE('Y-m-d');	
	   $row=$this->db->query("SELECT count(lead_id) FROM `lead_assigned_to` WHERE DATE(date) = '$date' or employee_id = $id ");
	   $a=$row->num_rows();
	   return $a;*/
		
		
		$this->db->select("COUNT(lead_id) AS TotalLeademp");
        $this->db->from("lead_assigned_to");
       $where = 'employee_id='.$id.' and  date="'.$date_today.'"';
		$this->db->where($where);
       $query = $this->db->get();
     
        if($query->num_rows() > 0)
        { 
         $res = $query->row_array();
         $total=$res['TotalLeademp'];
         return $total;	
	 }
		//return $result1=$result1->result();
	}
	public function count_freetrial_emp($employeeid,$date_today)
	{
		$date=DATE('Y-m-d');
		
			$this->db->select('COUNT(lead_id) AS Totalfreetrialemp');
        $this->db->from('client,lead_assigned_to');
        $where = 'lead_assigned_to.lead_id=client.client_id AND status="freetrial" and active="yes" AND ( lead_assigned_to.employee_id='.$employeeid.' ) and start_date="'.$date_today.'"';
		$this->db->where($where);
		$query = $this->db->get();
        if($query->num_rows() > 0)
        { 
         $res = $query->row_array();
         $total=$res['Totalfreetrialemp'];
         return $total;	
	 }
		//return $result1=$result1->result();
	}
	public function count_client_emp($employeeid,$date_today)
	{
		
		// echo"<pre>"; print_r($result1->result()); 
			$this->db->select('COUNT(lead_id) AS Totalclientemp');
        $this->db->from('client,lead_assigned_to');
        $where = 'lead_assigned_to.lead_id=client.client_id  AND status="paid" AND active="yes"and( lead_assigned_to.employee_id='.$employeeid.' ) and client.start_date="'.$date_today.'"';
		$this->db->where($where);
		$query = $this->db->get();
	/*	$this->db->select("COUNT(client_id) AS Totalclientemp");
        $this->db->from("client","users");
        $this -> db -> where('client.status','Converted');
         $this -> db -> where('users.employee_id',$employeeid);
        $query = $this->db->get();*/
        if($query->num_rows() > 0)
        { 
         $res = $query->row_array();
         $total=$res['Totalclientemp'];
         return $total;	
	 }
		//return $result1=$result1->result();
	}
    
    public function count_total_calls($id)
    { 
	$date=DATE('Y-m-d');	
	   $row=$this->db->query("SELECT DISTINCT client_id FROM `count_calls` WHERE date = '$date' and employee_id = '$id' and call_status='1' ");
	   $a=$row->num_rows();
	   return $a;

	}
	public function count_total_calls_all($id)
	{
	    $date=DATE('Y-m-d');	
		$row=$this->db->query("SELECT DISTINCT client_id FROM `count_calls` WHERE date = '$date'  and call_status='1' ");
		$a=$row->num_rows();
	    return $a;
    }	
	
	public function get_chart_data() {
		
		        $a=DATE('Y-m');
        $start=$a."-01"; 
        $end= $a."-31";
		//$this -> db -> select('users.username as user , sum(client_sell_order.total_amount) as res');
		//$this -> db -> from('users,client_sell_order');
		 //$this->db->where('client_sell_order.date BETWEEN "$start" and "$end"');
		 //$where='(client_sell_order.employee_id=users.employee_id) GROUP by client_sell_order.employee_id ORDER by SUM(client_sell_order.total_amount) DESC';
	    
		$query=$this->db->query("select users.username as user , sum(client_sell_order.total_amount) as res from users,client_sell_order where (client_sell_order.employee_id=users.employee_id) and client_sell_order.active_status='1' and client_sell_order.date BETWEEN '$start' and '$end' GROUP by users.employee_id  ORDER by SUM(client_sell_order.total_amount) Desc limit 5 "); 
		 //$this->db->where($where);

        //$query = $this->db->get();
         
        $results['chart_data'] = $query->result();
        return $results;
    }
    public function count_target_assign($id)
    {
		
		/*$this -> db -> select('target_assign as ta');
		$this -> db -> from('target');
		 $where='(employee_id='.$id.')ORDER by end_date desc';
		 $this->db->where($where);
		 $this->db->limit(1);
        $query = $this->db->get();
       */
        $a=DATE('Y-m');
        $start=$a."-01"; 
        $end= $a."-31";
        $query=$this->db->query("SELECT  target_assign as ta FROM `target` WHERE employee_id = $id and start_date BETWEEN '$start' and '$end' and end_date BETWEEN '$start' and '$end'");
        if($query->num_rows() > 0)
        { 
         $res = $query->row_array();
         $total=$res['ta'];
         return $total;	
	 }
 }
   public function count_target_assign_all($id)
    {
        $a=DATE('Y-m');
        $start=$a."-01"; 
        $end= $a."-31";
        $query=$this->db->query("SELECT  target_assign as ta FROM `target` WHERE start_date BETWEEN '$start' and '$end' and end_date BETWEEN '$start' and '$end'");
        if($query->num_rows() > 0)
        { 
         $res = $query->row_array();
         $total=$res['ta'];
         return $total;	
	 }
 }
 
	 public function count_target_achive($id)
    {
		
	/*	$this -> db -> select('total_amount as ta1');
		$this -> db -> from('client_sell_order');
		//$where='(employee_id='.$id.') gou';
		 $this->db->where('employee_id',$id);
		 $this->db->limit(1);
        $query = $this->db->get();
      */ 
        $a=DATE('Y-m');
        $start=$a."-01"; 
        $end= $a."-31";
      $query=$this->db->query("SELECT SUM(total_amount) as ta1 FROM `client_sell_order` WHERE employee_id = $id and date BETWEEN '$start' and '$end'");
       if($query->num_rows() > 0)
        { 
         $res = $query->row_array();
         $total=$res['ta1'];
         return $total;	
	 }
		
	}
	
	public function count_target_achive_all($id)
    {

        $a=DATE('Y-m');
        $start=$a."-01"; 
        $end= $a."-31";
      $query=$this->db->query("SELECT SUM(total_amount) as ta1 FROM `client_sell_order` WHERE date BETWEEN '$start' and '$end'");
       if($query->num_rows() > 0)
        { 
         $res = $query->row_array();
         $total=$res['ta1'];
         return $total;	
	   }
	}
	public function search_mobile($mobile)
	{
		$row=$this->db->query("SELECT * from client  WHERE mobile=$mobile");
		$row=$row->result();
		return $row;
	}
    public function update_client_details()
    {
		$data= array(
		'first_name' =>$_POST['first_name'],
		'last_name' =>$_POST['last_name'],
		'middle_name' =>$_POST['middle_name'],
		'email' =>$_POST['email'],
		'status' =>$_POST['status'],
		'follow_up_date' =>$_POST['follow_up_date'],
		'start_date' =>$_POST['start_date'],
		'end_date' =>$_POST['end_date'],
		'color_bit' => '1'
                 );	
		$this->db->where('client_id', $_POST['client_id']);
		$this->db->update('client', $data);
		
	}
	public function approve_sell_order()
	{
		$query=$this->db->query("SELECT * FROM `client`,client_sell_order,client_services WHERE client.client_id=client_sell_order.client_id and client.client_id=client_services.client_id and client_sell_order.client_id=client_services.client_id and client.active='no' GROUP by client_services.client_id");		
		//print_r  ( $result->result());
		return $query->result();
		/*$this->db->select('*');
        $this->db->from('client,client_sell_order,client_services');
        $where = 'client.client_id=client_sell_order.client_id and client.client_id=client_services.client_id and client_sell_order.client_id=client_services.client_id GROUP by client_services.client_id';
		$this->db->where($where);
		//$this->db->limit($limit,$start);
        $query = $this->db->get();
        return $result = $query->result();*/
        
	}
	public function approve_client()
	{
		//echo "guru";
		foreach($_POST['checkbox'] as $value)
		{
			$data=array(
			'active' =>'yes'
			);
			$this->db->where('client_id', $value);
			$this->db->update('client', $data);
			$this->db->query("update client_sell_order set active_status='1' where client_id='".$value."'");
		}
	}
	public function view_client_details($client)
	{
		/*$this->db->select('*');
        $this->db->from('client,client_sell_order');
        $where = "client_sell_order.client_id=client.client_id  and client_sell_order.client_id='".$client."'";
		$this->db->where($where);
		$this->db->order_by('client_sell_order.id','DESC');
		$this->db->limit('1');
		$query = $this->db->get();
        return $result = $query->result();
	   */
	   $query=$this->db->query("select * from client,client_sell_order where client_sell_order.client_id=client.client_id and client_sell_order.client_id='".$client."'");
	   return $query->result();
	}
	 public function update_client_sell($client,$sell)
	 {
		    $this->db->where('client_id', $_POST['client_id']);
			$this->db->update('client', $client);
			$this->db->where('id', $_POST['id']);
			$this->db->update('client_sell_order', $sell);
	 }
	 public function delete_client_sell($client)
	 {
		 $this->db->query("Update client set status='no status' where client_id='".$client."'");
		 $this->db->query("delete from client_sell_order where client_id='".$client."'");
	 }
	 public function view_free_details($client)
	 {
		 $this->db->select('*');
        $this->db->from('client');
        $where = "client_id='".$client."'";
		$this->db->where($where);
		$query = $this->db->get();
        return $result = $query->result();
	}
	
	public function stop_service()
	{
	    foreach($_POST['checkbox'] as $value)
		{
			$data=array(
			'active' =>'no',
			'start_date'=>'0000-00-00',
			'end_date'=>'0000-00-00',
			);
			$this->db->where('client_id', $value);
			$this->db->update('client', $data);
		}
		foreach($_POST['checkbox'] as $value)
		{
			$this->db->query("delete from client_services where client_id='$value'");
	    }
	}	
	
	public function view_client_services($client)
	{
		$this->db->select('*');
        $this->db->from('client_services,services');
        $where = 'client_services.service_id=services.service_id ';
		$this->db->where($where);
		$this->db->where('client_services.client_id',$client);
		$query = $this->db->get();
        return $result = $query->result();
	}
	
	public function selectServices()
	{
		$this->db->select('*');
		$this->db->from('services');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function unapproved_freetrails()
	{
	   $row=$this->db->query("select distinct client.client_id ,client.first_name as first_name, client.last_name as last_name, users.first_name as fname , users.last_name as lname, client.email as email ,client.mobile as mobile  from client,client_services,users where client_services.employee_id=users.employee_id and client.client_id=client_services.client_id and  status='freetrial' and client.active='no'");
	   return $row->result();
	}
	public function approve_freetrail()
	{
	   foreach($_POST['checkbox'] as $value)
		{
			$data=array(
			'active' =>'yes'
			);
			$this->db->where('client_id', $value);
			$this->db->update('client', $data);
		}	
	}
	public function add_calls($id,$client_id,$status)
	{
	  $date=DATE('Y-m-d');	
	  $this->db->query("insert into count_calls (employee_id,client_id,call_status,date) values('$id','$client_id','$status','$date')");
	}
    
    	public function get_Leads_by_filter($limit,$start)
	{
		$this->db->select('*');
		$this->db->from('client');
		if( get_cookie('status')!="all" )
		{
			$this->db->where('client.status',get_cookie('status'));
		}
		if( get_cookie('services')!="all" )
		{
			$this->db->join('client_services','client_services.client_id=client.client_id');
			$this->db->where('client_services.service_id',get_cookie('services'));
		}
		if( get_cookie('follow_up_date')!="" )
		{
			$this->db->where('client.follow_up_date',get_cookie('follow_up_date'));
		}
		if( get_cookie('sdate')!="" and get_cookie('end_date')=="" and get_cookie('services')=="all" )
		{
			//$this->db->join('client_services','client_services.client_id=client.client_id');
			$this->db->where('client.start_date',get_cookie('sdate'));
		}
		if( get_cookie('sdate')!="" and get_cookie('end_date')=="" and get_cookie('services')!="all" )
		{
			$this->db->where('client.start_date',get_cookie('sdate'));
		}
		
		if( get_cookie('sdate')=="" and get_cookie('end_date')!="" and get_cookie('services')=="all" )
		{
			//$this->db->join('client_services','client_services.client_id=client.client_id');
			$this->db->where('client.end_date',get_cookie('end_date'));
		}
		if( get_cookie('sdate')=="" and get_cookie('end_date')!="" and get_cookie('services')!="all" )
		{
			$this->db->where('client.end_date',get_cookie('end_date'));
		}
		
		if( get_cookie('sdate')!="" and get_cookie('end_date')!="" and get_cookie('services')=="all" )
		{
			//$this->db->join('client_services','client_services.client_id=client.client_id');
			$this->db->where("client.start_date >= '".get_cookie('sdate')."' and client.end_date <= '".get_cookie('end_date')."'");
		}
		if( get_cookie('sdate')!="" and get_cookie('end_date')!="" and get_cookie('services')!="all" )
		{
			$this->db->where("client.start_date >= '".get_cookie('sdate')."' and client.end_date <= '".get_cookie('end_date')."'");
		}
		if( get_cookie('called')!="all" )
		{
		     $this->db->where('client.color_bit',get_cookie('called'));
		}
		$this->db->limit($limit,$start);
		$this->db->group_by('client.client_id');
		$result = $this->db->get();
		return $result->result();
	}
	
	public function count_get_Leads_by_filter($limit)
	{
		$this->db->select('*');
		$this->db->from('client');
		if( get_cookie('status')!="all" )
		{
			$this->db->where('client.status',get_cookie('status'));
		}
		if( get_cookie('services')!="all" )
		{
			$this->db->join('client_services','client_services.client_id=client.client_id');
			$this->db->where('client_services.service_id',get_cookie('services'));
		}
		if( get_cookie('follow_up_date')!="" )
		{
			$this->db->where('client.follow_up_date',get_cookie('follow_up_date'));
		}
		if( get_cookie('sdate')!="" and get_cookie('end_date')=="" and get_cookie('services')=="all" )
		{
			//$this->db->join('client_services','client_services.client_id=client.client_id');
			$this->db->where('client.start_date',get_cookie('sdate'));
		}
		if( get_cookie('sdate')!="" and get_cookie('end_date')=="" and get_cookie('services')!="all" )
		{
			$this->db->where('client.start_date',get_cookie('sdate'));
		}
		
		if( get_cookie('sdate')=="" and get_cookie('end_date')!="" and get_cookie('services')=="all" )
		{
			//$this->db->join('client_services','client_services.client_id=client.client_id');
			$this->db->where('client.end_date',get_cookie('end_date'));
		}
		if( get_cookie('sdate')=="" and get_cookie('end_date')!="" and get_cookie('services')!="all" )
		{
			$this->db->where('client.end_date',get_cookie('end_date'));
		}
		
		if( get_cookie('sdate')!="" and get_cookie('end_date')!="" and get_cookie('services')=="all" )
		{
			//$this->db->join('client_services','client_services.client_id=client.client_id');
			$this->db->where("client.start_date >= '".get_cookie('sdate')."' and client.end_date <= '".get_cookie('end_date')."'");
		}
		if( get_cookie('sdate')!="" and get_cookie('end_date')!="" and get_cookie('services')!="all" )
		{
			$this->db->where("client.start_date >= '".get_cookie('sdate')."' and client.end_date <= '".get_cookie('end_date')."'");
		}
		if( get_cookie('called')!="all" )
		{
		     $this->db->where('client.color_bit',get_cookie('called'));
		}
		$this->db->group_by('client.client_id');
		$result = $this->db->get();
		return $result->num_rows();
	}
	
	public function get_Leads_by_filter_emp($limit,$start)
	{
		$row=$this->session->userdata('my_session');
		$this->db->select('*');
		$this->db->from('client');
		$this->db->join('lead_assigned_to','lead_assigned_to.lead_id=client.client_id');
		$this->db->where('lead_assigned_to.employee_id',$row['employee_id']);
		if( get_cookie('status')!="all" )
		{
			$this->db->where('client.status',get_cookie('status'));
		}
		if( get_cookie('services')!="all" )
		{
			$this->db->join('client_services','client_services.client_id=client.client_id');
			$this->db->where('client_services.service_id',get_cookie('services'));
		}
		if( get_cookie('follow_up_date')!="" )
		{
			$this->db->where('client.follow_up_date',get_cookie('follow_up_date'));
		}
		if( get_cookie('sdate')!="" and get_cookie('end_date')=="" and get_cookie('services')=="all" )
		{
			//$this->db->join('client_services','client_services.client_id=client.client_id');
			$this->db->where('client.start_date',get_cookie('sdate'));
		}
		if( get_cookie('sdate')!="" and get_cookie('end_date')=="" and get_cookie('services')!="all" )
		{
			$this->db->where('client.start_date',get_cookie('sdate'));
		}
		
		if( get_cookie('sdate')=="" and get_cookie('end_date')!="" and get_cookie('services')=="all" )
		{
			//$this->db->join('client_services','client_services.client_id=client.client_id');
			$this->db->where('client.end_date',get_cookie('end_date'));
		}
		if( get_cookie('sdate')=="" and get_cookie('end_date')!="" and get_cookie('services')!="all" )
		{
			$this->db->where('client.end_date',get_cookie('end_date'));
		}
		
		if( get_cookie('sdate')!="" and get_cookie('end_date')!="" and get_cookie('services')=="all" )
		{
			//$this->db->join('client_services','client_services.client_id=client.client_id');
			$this->db->where("client.start_date >= '".get_cookie('sdate')."' and client.end_date <= '".get_cookie('end_date')."'");
		}
		if( get_cookie('sdate')!="" and get_cookie('end_date')!="" and get_cookie('services')!="all" )
		{
			$this->db->where("client.start_date >= '".get_cookie('sdate')."' and client.end_date <= '".get_cookie('end_date')."'");
		}
		if( get_cookie('called')!="all" )
		{
		     $this->db->where('client.color_bit',get_cookie('called'));
		}
		$this->db->limit($limit,$start);
		$this->db->group_by('client.client_id');
		$result = $this->db->get();
		return $result->result();
	}
	
	public function count_get_Leads_by_filter_emp($limit)
	{
		$row=$this->session->userdata('my_session');
		$this->db->select('*');
		$this->db->from('client');
		$this->db->join('lead_assigned_to','lead_assigned_to.lead_id=client.client_id');
		$this->db->where('lead_assigned_to.employee_id',$row['employee_id']);
		if( get_cookie('status')!="all" )
		{
			$this->db->where('client.status',get_cookie('status'));
		}
		if( get_cookie('services')!="all" )
		{
			$this->db->join('client_services','client_services.client_id=client.client_id');
			$this->db->where('client_services.service_id',get_cookie('services'));
		}
		if( get_cookie('follow_up_date')!="" )
		{
			$this->db->where('client.follow_up_date',get_cookie('follow_up_date'));
		}
		if( get_cookie('sdate')!="" and get_cookie('end_date')=="" and get_cookie('services')=="all" )
		{
			//$this->db->join('client_services','client_services.client_id=client.client_id');
			$this->db->where('client.start_date',get_cookie('sdate'));
		}
		if( get_cookie('sdate')!="" and get_cookie('end_date')=="" and get_cookie('services')!="all" )
		{
			$this->db->where('client.start_date',get_cookie('sdate'));
		}
		
		if( get_cookie('sdate')=="" and get_cookie('end_date')!="" and get_cookie('services')=="all" )
		{
			//$this->db->join('client_services','client_services.client_id=client.client_id');
			$this->db->where('client.end_date',get_cookie('end_date'));
		}
		if( get_cookie('sdate')=="" and get_cookie('end_date')!="" and get_cookie('services')!="all" )
		{
			$this->db->where('client.end_date',get_cookie('end_date'));
		}
		
		if( get_cookie('sdate')!="" and get_cookie('end_date')!="" and get_cookie('services')=="all" )
		{
			//$this->db->join('client_services','client_services.client_id=client.client_id');
			$this->db->where("client.start_date >= '".get_cookie('sdate')."' and client.end_date <= '".get_cookie('end_date')."'");
		}
		if( get_cookie('sdate')!="" and get_cookie('end_date')!="" and get_cookie('services')!="all" )
		{
			$this->db->where("client.start_date >= '".get_cookie('sdate')."' and client.end_date <= '".get_cookie('end_date')."'");
		}
		if( get_cookie('called')!="all" )
		{
		     $this->db->where('client.color_bit',get_cookie('called'));
		}
		$this->db->group_by('client.client_id');
		$result = $this->db->get();
		return $result->num_rows();
	
     }
     public function check_assigned($id)
     {
		$query = $this->db->query("SELECT employee_id as emp FROM lead_assigned_to where lead_id='$id'");
		if($query)
		{
		    $res = $query->row_array();
		    $query1 = $this->db->query("SELECT username,mobile  FROM users where employee_id='".$res['emp']."'"); 
            return $query1->result();
	    }
	 }
	 
	 public function delete_assigned_lead($id)
	 {
	   $query = $this->db->query("delete from lead_assigned_to where lead_id='".$id."'");	 
	 }	
}
