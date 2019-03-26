<?php

class AddDesignationModel extends CI_Model
{
	public function check($data)
	{
		
		 $row=$this->db->query("select designation from user_designation where designation='".$data."'");
		 return $row;
			
	}
	
	public function insert_designation($data)
	{			 
		     $this->db->query("insert into user_designation(designation) values('".$data->designation."')");	 
	}
	
    public function view()
    {
          $row=$this->db->query("select * from user_designation");
          return $row->result();
    }
    
    public function delete($designation_id)
	{
		$this->db->query("delete from user_designation where id=".$designation_id);
	}
	
	public function edit($id)
	{
	    $row=$this->db->query("select * from user_designation where id=".$id);
	    return $row->result();
	}
	
	public function update($data)
	{
	    $this->db->query("update user_designation set designation='".$data->designation."' where id=".$data->id);
	}
	
}
