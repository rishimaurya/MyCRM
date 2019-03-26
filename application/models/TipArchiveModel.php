<?php

class TipArchiveModel extends CI_Model
{
	
   public function fetch_all_researcher()
   {
      $row = $this->db->query("select first_name,last_name,employee_id from users,service_call where users.employee_id=service_call.researcher_id or role='researcher' group by employee_id");
      return $row->result();
   }
   
   public function fetch_all_service()
   {
      $row = $this->db->query("select * from services");
      return $row->result();       
   }
   
   public function fetch_message_id()
   {
       $row = $this->db->query("SELECT DISTINCT message_id FROM `service_call`");
      
       return $row->result();
   }
   
   public function count_fetch_message($data)
   {
       $row = $this->db->query("SELECT *  FROM `timeline_message` where message_id in (".$data.") and call_id='1' ");
       return $row->num_rows();
   }
   
   public function fetch_message($data,$limit,$start)
   {
       $row = $this->db->query("SELECT *  FROM `timeline_message` where message_id in (".$data.") and call_id='1' order by message_id desc LIMIT $start,$limit ");
       return $row->result();
   }
   
   public function fetch_FilterMessage($data,$limit,$start)
   {
       $row = $this->db->query("SELECT *  FROM `timeline_message` where message_id in (".$data.") and call_id='1' order by message_id desc LIMIT $start,$limit ");
       return $row->result();
   }
   
   public function count_fetch_FilterMessage($data)
   {
       $row = $this->db->query("SELECT *  FROM `timeline_message` where message_id in (".$data.") and call_id='1' ");
       return $row->num_rows();
   }
   
   /*public function selected_researcher($researcher)
   {
       $row = $this->db->query("SELECT DISTINCT message_id FROM `service_call` where researcher_id='".$researcher."'");
       return $row->result();
   }
   
   public function selected_service($service)
   {
       $row = $this->db->query("SELECT DISTINCT message_id FROM `service_call` where service_id='".$service."'");
       return $row->result();       
   }
   public function selected_both($service,$researcher)
   {
       
       $row = $this->db->query("SELECT DISTINCT message_id FROM `service_call` WHERE service_id='".$service."' and researcher_id='".$researcher."' ");
       return $row->result();
   }
   */
   public function filterCalls()
   {
	   $this->db->select('service_call.message_id');
	   $this->db->from('service_call');
	   if( get_cookie('cdate')!="" )
		{
		     $this->db->join('timeline_message','timeline_message.message_id = service_call.message_id');
		     $this->db->where('timeline_message.msg_date',get_cookie('cdate'));
		}
	   if( get_cookie('service')!="all" && get_cookie('researcher')=="all")
		{
		     $this->db->where('service_id',get_cookie('service'));
		}
		if( get_cookie('service')=="all" && get_cookie('researcher')!="all")
		{
		     $this->db->where('researcher_id',get_cookie('researcher'));
		}
		if( get_cookie('service')!="all" && get_cookie('researcher')!="all")
		{
		     $this->db->where('researcher_id',get_cookie('researcher'));
		     $this->db->where('service_id',get_cookie('service'));
		}
	   $this->db->group_by('service_call.message_id');
	   $query  = $this->db->get();
	   return $query->result();
   }
}
