<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

	class Notifications_model extends CI_Model {

		
			function get_notif_all(){
				$username = $this->session->userdata('username');
				$str = "SELECT * FROM notification_tr WHERE to_user = '$username' ORDER BY datetime DESC";
				$q = $this->db->query($str);
				$f = $q->result_array();
				return $f;
			}

			function detail_seatizen($username){
				$str = "SELECT * FROM pelaut_ms WHERE username = '$username'";
				$q = $this->db->query($str);
				$f = $q->row_array();
				return $f;
			}


			function request_friend($username,$to,$action){

				$a = $this->detail_seatizen($username);
				//$nama_pengirim = $a['nama_depan']." ".$a['nama_belakang'];

				if($action == "Add Friend"){

					$log = array(
						'title_notif' => 'Add Friend',
						'description' => 'Want be your Friend',
						'nama_pengirim' => $username,
						'type' => 'Request Friend',
						'from_user' => $username,
						'to_user' => $to,
						'datetime' => date('Y-m-d'),
						'waktu_notif' => date('H:i:s'),
						'ip_address' => $_SERVER['REMOTE_ADDR'],
						'url' => 'profile/'.$username.'/resume'
						);

				} else if($action == "Confirm"){

					$log = array(
						'title_notif' => 'Confirm Friend',
						'description' => 'has accepted you as friend',
						'nama_pengirim' => $username,
						'type' => 'Request Friend',
						'from_user' => $username,
						'to_user' => $to,
						'datetime' => date('Y-m-d'),
						'waktu_notif' => date('H:i:s'),
						'ip_address' => $_SERVER['REMOTE_ADDR'],
						'url' => 'profile/'.$to.'/friends'
						);

				}
 
					$this->db->insert("notification_tr",$log);
					

			}


			function resume_uncomplete($username){

					$this->load->model('profile_resume_model');
					$now = date('Y-m-d');
					$a = $this->profile_resume_model->cek_lengkap_resume($this->session->userdata('id_user'));

					$str = "SELECT * FROM notification_tr WHERE to_user = '$username' AND datetime = '$now' AND title_notif = 'Resume uncomplete'";
					$q = $this->db->query($str);

					if($q->num_rows == 0){ 
					if(empty($a)){
	$not = array(
					'title_notif' => 'Resume uncomplete',
					'description' => 'Your resume incomplete, please update it soon',
					'type' => 'Resume Uncomplete',
					'from_user' => 'Admin Informasea',
					'to_user' => $username,
					'datetime' => date('Y-m-d'),
					'waktu_notif' => date('H:i:s'),
					'ip_address' => $_SERVER['REMOTE_ADDR'],
					'url' => 'seaman/resume'
					);



				$this->db->insert("notification_tr",$not);


					} 
				} else{

				}
			


			}

			function expired_certificate($username){
			
				$now = date('Y-m-d');
				$this->load->model('profile_resume_model');
				$expired = $this->profile_resume_model->expired_certificate($this->session->userdata('id_user'));
					$str = "SELECT * FROM notification_tr WHERE to_user = '$username'  AND title_notif = 'Expired Certificate'";
					$q = $this->db->query($str);
				if($q->num_rows == 0) { 

				if($expired != 0){


							if(!empty($username)){

					$not = array(
						'title_notif' => 'Expired Certificate',
						'description' => $expired.' Certificate has expired ',
						'type' => 'Expired certificate',
						'from_user' => 'Admin Informasea',
						'to_user' => $username,
						'datetime' =>date('Y-m-d'),
						'waktu_notif' => date('H:i:s'),
						'ip_address' => $_SERVER['REMOTE_ADDR'],
						'url' => 'seaman/resume'
						);


					$this->db->insert("notification_tr",$not);

				}
				}
			} else{
				$date = date('Y-m-d');
				$wka = date('H:i:s');
				$not = "UPDATE notification_tr SET 
				description = '$expired Certificate has expired',
				datetime ='$date',
				waktu_notif = '$wka' WHERE to_user = '$username' AND title_notif = 'Expired Certificate'";
				$q = $this->db->query($not); 


			}
			
			}


			

			function applied_vacantsea($username,$to,$id_vacantsea){
			
				$a = $this->detail_seatizen($username);
				$nama_pengirim = $a['nama_depan']." ".$a['nama_belakang'];

				$this->load->model("vacantsea/vacantsea_model", "vacant");

				$dtVacant = $this->vacant->get_vacantsea_id($id_vacantsea);

				if(!empty($username) AND !empty($to)){
					$not = array(
						'title_notif' => 'Applied Vacantsea',
						'description' => 'Was applied as '.$dtVacant['vacantsea'],
						'type' => 'Applied Vacantsea',
						'nama_pengirim' => $nama_pengirim,
						'from_user' => $username,
						'to_user' => $to,
						'datetime' => date('Y-m-d'),
						'waktu_notif' => date('H:i:s'),
						'ip_address' => $_SERVER['REMOTE_ADDR'],
						'url' => 'hire_crew/applicant_list/'.$id_vacantsea
						);

					$this->db->insert('notification_tr',$not);
				}

			}


	}