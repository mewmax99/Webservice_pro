<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barry extends CI_Controller {
	public function index()
	{
		$this->load->view('Homepage');
	}
	public function Coppy(){
		$this->load->model('Recipe_Model');
		$data['comment'] = $this->Recipe_Model->Get_All_Comment();
		$this->load->view('Hotel_View',$data);
	}
	public function Restaurant_View(){
		$this->load->view('Res_View');
	}
	public function Attractions_View(){
		$this->load->view('Att_View');
	}
	public function Recipe(){
		$this->load->model('Recipe_Model');
		$data['recipe'] = $this->Recipe_Model->Recipe_Data();
		$this->load->view('Recipe_View',$data);
	}
	public function Recipe_Get_Data(){
		$this->load->model('Recipe_Model');
		$data['recipe'] = $this->Account_model->Recipe_Data();
		$this->load->view('Recipe_View',$data);

	}
	public function Upload(){
		 $image = addslashes($_FILES['images']['tmp_name']);
         $image = file_get_contents($image);
         $image = base64_encode($image);
         $data = array(
            're_name' => $this->input->post('re_name'),
            're_ingre' => $this->input->post('re_ingre'),
            're_solu' => $this->input->post('re_solu'),        
            're_image' => $image
          );
          $this->load->model('Recipe_Model');
          $this->Recipe_Model->Insert_Data($data);
          //redirect('Barry/Upload_V');
	}
	public function Upload_V(){
		$this->load->view('Upload_View');
	}
	public function Recipe2(){
		$this->load->view('Recipe_View');
	}
	public function Insert_Comment(){

	}
}
