<?php

	class index extends CI_Controller{
		
		function __construct(){
			
			parent::__construct();
		}	
		function index(){
			
			$this->load->view('show/login');			
		}
		function login(){
			
			if(isset($_POST["username"])){
				$username=$_POST['username'];
				$password=$_POST['password'];			
				//Resourse Address
				$url = "http://ci-server.design2house.com/index.php/index/login/"; //เป็นที่อยู่ของ API address		
				// data
				$data['username'] = $username;
				$data['password'] = $password;
				$data['ip'] = $_SERVER['REMOTE_ADDR'];
				//Sends Request To Resourse		
				$client = curl_init();
				//curl_setopt($client, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($client, CURLOPT_HEADER, 0);
				//curl_setopt($client, CURLOPT_POST,1); // method ที่เราจะส่ง เป็น get หรือ post
				curl_setopt($client, CURLOPT_CUSTOMREQUEST, 'POST');
				curl_setopt($client, CURLOPT_POSTFIELDS,$data); // paremeter สำหรับส่งไปยังไฟล์ ที่กำหนด
				curl_setopt($client, CURLOPT_URL,$url);
				curl_setopt($client, CURLOPT_RETURNTRANSFER,1);			
				//Get Response To Resourse
				$response=curl_exec($client);// ผลการ execute กลับมาเป็น ข้อมูลใน url ที่เรา ส่งคำร้องขอไป
				$re['content'] = $response;
				$this->load->view('show/response',$re);
				echo "<br/>";
				curl_close ($client);			
			}
		}
	}