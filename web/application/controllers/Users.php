<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		$data = array();
		$data["result"] = array();
		/* $plain_text = 'This is a plain-text message!';
		$ciphertext = $this->encryption->encrypt($plain_text);
		$this->encryption->decrypt($ciphertext);
		exit; */
		
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,API_URL."count_users");
		curl_setopt($ch,CURLOPT_HTTPHEADER,array("Content-Type:application/json","api-key:".API_KEY.""));
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		$respCount = curl_exec($ch);
		$respCount = json_decode($respCount);
		/* echo "<pre>";
		print_r($respCount);
		echo "</pre>";
		exit; */
		
		$totalRows = !empty($respCount->success)?$respCount->data:0;
		//echo $totalRows;exit;
		$config['base_url'] = base_url().'users/index/';
		$config['total_rows'] = $totalRows;
		$config['per_page'] = 3;
		$config["uri_segment"] = 3;
		$config["use_page_numbers"] = TRUE;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
		$start = $config["per_page"] * ($page-1);
		$data["start"] = $start;
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,API_URL."users?start=".$start."&limit=".$config['per_page']);
		curl_setopt($ch,CURLOPT_HTTPHEADER,array("Content-Type:application/json","api-key:".API_KEY.""));
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		$respData = curl_exec($ch);
		$respData = json_decode($respData);

		/* echo "<pre>";
		print_r($respData);
		echo "</pre>";	
		exit; */
		if(!empty($respData->success)){
			$data["result"] = $respData->data;
		}

		$this->load->view("users/index",$data);
	}
	
	public function add(){
		$data = array();
		
		if($this->input->post("submit")){
		$this->form_validation->set_rules('name', 'Name', 'required',array('required' => 'Please enter name'));
		$this->form_validation->set_rules('gender', 'Gender', 'required',array('required' => 'Please select gender'));
		$this->form_validation->set_rules('address', 'Address', 'required',array('required' => 'Please enter address'));
		
		if ($this->form_validation->run() != FALSE){
			$name = $this->input->post("name");
			$gender = $this->input->post("gender");
			$address = $this->input->post("address");
			
			
			$ch = curl_init(API_URL."users/add");
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 ;Windows NT 6.1; WOW64; AppleWebKit/537.36 ;KHTML, like Gecko; Chrome/39.0.2171.95 Safari/537.36");
			
			$post_array = array();
			$post_array["name"]= $name;
			$post_array["gender"]= $gender;
			$post_array["address"]= $address;
			
			if(!empty($_FILES['photo']['tmp_name'])){
				$tmp_file = $_FILES['photo']['tmp_name'];
				$file_type = $_FILES['photo']['type'];
				$file_name = $_FILES['photo']['name'];
				$attached_file = new CURLFile($tmp_file,$file_type,$file_name);
				$post_array["file_to_import"]= $attached_file;
				
			}
			
				curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data","api-key:".API_KEY.""));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$formData = $post_array;
				curl_setopt($ch, CURLOPT_POSTFIELDS, $formData);
				$resp = curl_exec($ch);			
				curl_close($ch);
				$resp =  json_decode($resp);
				if(!empty($resp->success)){
						$this->session->set_flashdata('success_msg', 'User Added Successfully');
						redirect("/users/index");
				}
				else{
					$this->session->set_flashdata('error_msg', 'Error in adding new user, Please try again.');
				}
			}
		}
		

		$this->load->view("users/add",$data);
	}
	
	public function edit($id = null){
		$data = array();
		
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,API_URL."get_user/".$id);
		curl_setopt($ch,CURLOPT_HTTPHEADER,array("Content-Type:application/json","api-key:".API_KEY.""));
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		$user = curl_exec($ch);
		$user = json_decode($user);
		/* echo "<pre>";
		print_r($user);
		echo "</pre>";
		exit; */
		
		if(!empty($user->success) and !empty($user->data)){
			$data["user"] = $user;
			
			if($this->input->post("submit")){
				$this->form_validation->set_rules('name', 'Name', 'required',array('required' => 'Please enter name'));
				$this->form_validation->set_rules('gender', 'Gender', 'required',array('required' => 'Please select gender'));
				$this->form_validation->set_rules('address', 'Address', 'required',array('required' => 'Please enter address'));
				
				if ($this->form_validation->run() != FALSE){
					$name = $this->input->post("name");
					$gender = $this->input->post("gender");
					$address = $this->input->post("address");
					
					
					$ch = curl_init(API_URL."users/edit/".$id);
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 ;Windows NT 6.1; WOW64; AppleWebKit/537.36 ;KHTML, like Gecko; Chrome/39.0.2171.95 Safari/537.36");
					
					$post_array = array();
					$post_array["name"]= $name;
					$post_array["gender"]= $gender;
					$post_array["address"]= $address;
					
					if(!empty($_FILES['photo']['tmp_name'])){
						$tmp_file = $_FILES['photo']['tmp_name'];
						$file_type = $_FILES['photo']['type'];
						$file_name = $_FILES['photo']['name'];
						$attached_file = new CURLFile($tmp_file,$file_type,$file_name);
						$post_array["file_to_import"]= $attached_file;
					}
					
					curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data","api-key:".API_KEY.""));
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$formData = $post_array;
					curl_setopt($ch, CURLOPT_POSTFIELDS, $formData);
					$resp = curl_exec($ch);			
					curl_close($ch);
					$resp =  json_decode($resp);
					if(!empty($resp->success)){
							$this->session->set_flashdata('success_msg', 'User Updated Successfully');
							redirect("/users/index");
					}
					else{
						$this->session->set_flashdata('error_msg', 'Error in updating user, Please try again.');
					}
				}
			}
			else{
				$_POST["name"] = $user->data->name;
				$_POST["gender"] = $user->data->gender;
				$_POST["address"] = $user->data->address;
				/* print_r($_POST);
				exit; */
			}
		}
		else{
			$this->session->set_flashdata('error_msg', 'user not found!');
			redirect("/users/index");
		}
		
		
		$this->load->view("users/edit",$data);
	}
	
	
	public function delete($id = null){
		$data = array();
		
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,API_URL."get_user/".$id);
		curl_setopt($ch,CURLOPT_HTTPHEADER,array("Content-Type:application/json","api-key:".API_KEY.""));
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		$user = curl_exec($ch);
		$user = json_decode($user);
		/* echo "<pre>";
		print_r($user);
		echo "</pre>";
		exit; */
		
		if(!empty($user->success) and !empty($user->data)){
			
			
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL,API_URL."delete_user/".$id);
			curl_setopt($ch,CURLOPT_HTTPHEADER,array("Content-Type:application/json","api-key:".API_KEY.""));
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
			$resp = curl_exec($ch);
			$resp = json_decode($resp);
			if(!empty($resp->success)){
				$this->session->set_flashdata('success_msg', 'User Deleted Successfully');
				redirect("/users/index");
			}
			else{
				$this->session->set_flashdata('error_msg', 'Unable to delete user');
				redirect("/users/index");
			}
		}
		else{
			$this->session->set_flashdata('error_msg', 'user not found!');
			redirect("/users/index");
		}
		
	}
	
	/* public function addUserJson(){
		
		$logged_in = $this->session->userdata('admin_logged_in');
        $data = array();
		$cond = array();
		if(isset($_POST['submit'])){			
            $this->form_validation->set_rules('name', 'Name', 'required|callback__unique_name',array('required' => 'Please enter pass name'));
			
            if ($this->form_validation->run() != FALSE){
				$name = $this->input->post("name");

				$date_created = date("Y-m-d H:i:s");
				$date_created = strtotime($date_created);
				
				
				
				$pass_arr = array(
				"name"=>$name,				
				"created"=>$date_created,
				"modified"=>null,
				);
				
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, API_URL."admin/add_pass");
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($pass_arr));
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','x-access-token:'.$logged_in->token.'','api-key:'.API_KEY.''));
				//curl_setopt($ch, CURLOPT_HEADER, true);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$resp = curl_exec($ch);         
				$resp = json_decode($resp);
				//print_r($resp->success);
				if(!empty($resp->success)){

					$this->session->set_flashdata('success_msg', 'Pass Added Successfully');
					redirect("/admin/passes/add");
				}
				else{
                        $this->session->set_flashdata('error_msg', 'Error in adding new pass, Please try again.');
                    }
            }
        }
		$this->load->view('admin/passes/add',$data);
    } */
}
