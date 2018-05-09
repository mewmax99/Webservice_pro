<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recipe_Model extends CI_Model {
	public function Recipe_Data(){
		$result = $this->db->get('recipe');
		return $result->result_array();
	}
	public function Insert_Data($data){
		$this->db->insert('recipe', $data);

	}
	public function Get_All_Comment(){
		$result = $this->db->get('Comment');
		return $result->result_array();
	}
	public function Get_All_Res(){
		$result = $this->db->get('Comment_Res');
		return $result->result_array();
	}
	public function Get_All_Att(){
		$result = $this->db->get('Comment_Att');
		return $result->result_array();
	}
	public function Insert_Comment_Hotel($data){
		$this->db->insert('Comment', $data);
	}
	public function Insert_Comment_Res($data){
		$this->db->insert('Comment_Res', $data);
	}
	public function Insert_Comment_Att($data){
		$this->db->insert('Comment_Att', $data);
	}
	
}
