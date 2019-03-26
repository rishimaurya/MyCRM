<?php
class Welcome_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insertCSV($data)
    {
              $query =  $this->db->insert_batch('client_copy', $data);
              if($query)
              {
                        // $flush = $this->db->query("TRUNCATE TABLE client_copy"); 
                        // if($flush)
                        //  {
                             return 1;
                        //  }
                        //  else return TRUE;
              } 
              else return false;
    }
    
    public function trigger()
    {
              $query =  $this->db->query('INSERT INTO client(client.first_name,client.middle_name,client.last_name,client.gender,client.email,client.mobile,client.status,client.address,client.profession,client.follow_up_date,client.active,client.assigned,client.disposed,client.leadsource,client.callback,client.leadstatus,client.response,client.traderprofile,client.traderexp,client.description,client.csv_source,client.date) SELECT client_copy.first_name,client_copy.middle_name,client_copy.last_name,client_copy.gender,client_copy.email,client_copy.mobile,client_copy.status,client_copy.address,client_copy.profession,client_copy.follow_up_date,client_copy.active,client_copy.assigned,client_copy.disposed,client_copy.leadsource,client_copy.callback,client_copy.leadstatus,client_copy.response,client_copy.traderprofile,client_copy.traderexp,client_copy.description,client_copy.csv_source,client_copy.follow_up_date FROM client_copy WHERE NOT EXISTS(SELECT * FROM client WHERE (client_copy.mobile=client.mobile) )');
              if($query)
              {
                  $this->db->query('Truncate table client_copy');
                        return TRUE;
              } 
              else return false;
    }

   public function service_id($data)
   {
	   print_r($data);
	 /*  $this->db->select('*');
	   $this->db->from('services');
	   $this->db->where('service_name in','('.$data.')');
	   $query = $this->db->get();
	   return $query->result();*/
   }
   
   public function insert_service($data)
    {
       //print_r($data);
       $this->db->insert('client_services', $data);
       return True;
    }
   

    public function view_data(){
        $query=$this->db->query("select * from client");
        return $query->result_array();
    }
    
 /*   public function fetch_all()
    {
       date_default_timezone_set("Asia/Kolkata");
       $date= date("Y-m-d");
       $this->db->select('mobile');
       $this->db->from('client');
       $this->db->where('date',$date);
       $data = $this->db->get();
       return $data->result();
    }*/
}
