<?php
class ResearcherModel extends CI_Model
{
	public function get_service()
	{
		$row=$this->db->query("select * from services");
		$row=$row->result();
		return $row;
	}
	public function get_user()
	{
		$mobile="";
		$oidVal = implode('" OR "', $this->input->post('services'));
	   // echo $oidVal;
	    $this->db->distinct();
		$this -> db -> select('client.client_id,client.first_name,client.mobile');
		$this -> db -> from('client,client_services,services'); 
		$where = 'client.client_id=client_services.client_id AND client_services.service_id=services.service_id AND services.service_name=("'.$oidVal.'")';
		$this->db->where($where);  
		$query = $this -> db -> get();
			if($query -> num_rows() >0)
			{
			foreach ($query->result() as $row) 
			{
				$mobile.=$row->mobile.",";
			}
		}
	    $link="http://sms.divineinfo.net/api/sendhttp.php?authkey=172205A1g3w1CUaw59a55ec7&mobiles=".$mobile."&message=".rawurlencode($_POST['TextMessage'])."&sender=IGRIND&route=4&country=91";
	   	$data= file_get_contents($link);
	}
	
	public function all_user()
	{
		$a=$_POST['TextMessage'];
		//echo $new;
		$mobile="";
		$link="";
		$this -> db -> select('*');
		$this -> db -> from('client'); 
		$query = $this -> db -> get();
			if($query -> num_rows() >0)
			{
				foreach ($query->result() as $row) 
				{
					$mobile.=$row->mobile.",";
				}
			}
			$link="http://sms.divineinfo.net/api/sendhttp.php?authkey=172205A1g3w1CUaw59a55ec7&mobiles=".$mobile."&message=".rawurlencode($_POST['TextMessage'])."&sender=IGRIND&route=4&country=91";
			$data= file_get_contents($link);
			
	}
	public function fetch_all_users()
	{
	    $row=$this->db->query("select employee_id from users");
	    return $row->result();
	}
	
	public function send_message($data)
    {   	    
	    $this->db->insert('timeline_message',$data);		   	    
	    $insert_id = $this->db->insert_id();
        return $insert_id;
    } 
	
	public function call_services($data)
   {
        $this->db->insert('service_call',$data);
   }
    
   public function send_details($mobile,$message)
   { //echo $mobile;
	   $link="http://sms.divineinfo.net/api/sendhttp.php?authkey=172205A1g3w1CUaw59a55ec7&mobiles=".$mobile."&message=".rawurlencode($message)."&sender=IGRIND&route=4&country=91";
	   $data= file_get_contents($link);
   }
   
   public function send_Service_SMS()
   {
	   $data = implode(',',$_POST['services']);$mobile="";
	   $this->db->select('*');
	   $this->db->from('client');
	   $this->db->join('client_services','client_services.client_id=client.client_id');
	   $this->db->join('services','services.service_id=client_services.service_id');
	   $this->db->where_in('client_services.service_id',$data);
	   $this->db->group_by('client.client_id');
	   $query = $this -> db -> get();
		if($query -> num_rows() >0)
		 {
		   foreach ($query->result() as $row) 
			{
				$mobile.=$row->mobile.",";
			}
		 }
	   $link="http://sms.divineinfo.net/api/sendhttp.php?authkey=172205A1g3w1CUaw59a55ec7&mobiles=".$mobile."&message=".rawurlencode($_POST['message'])."&sender=IGRIND&route=4&country=91";
	   $data= file_get_contents($link);
	}
}
?>
