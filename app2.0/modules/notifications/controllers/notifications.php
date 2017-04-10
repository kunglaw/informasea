<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

	class Notifications extends MX_Controller {

		function __construct(){
			parent::__construct();
			$this->load->model('notifications_model');
			$this->load->model('users/user_model');
		}

		function index(){

		

		$data['head']	 = "head";
		$data['title']	= "Notifications";	
		$data['css']	  = "css"; //css tambahan, di head
		$data['meta']	 = "meta"; // meta tambahan, di head
		$data['js_top']   = "js_top"; // js tambahan, di head
		
		//include
		//$data['navbar']   = "";
		$data['template'] = "template";
		$data['footer']   = "footer";
		$data['js_under'] = "js_under"; 
			
			$data['notif'] =  $this->notifications_model->get_notif_all();
			$user = $this->session->userdata('username');
			$str = "UPDATE notification_tr SET read_user = 1 WHERE to_user = '$user'";
			$q = $this->db->query($str);
			$this->load->view('index',$data);
		}


 function list_notif(){
		if($this->input->is_ajax_request()){

		$notification_image = [
		'ic_notif_friendrequest.png',
		'ic_notif_uncomplete.png',
		'ic_notif_interview.png'
		];

		$user  = $this->session->userdata('username');
		$str = "SELECT * FROM notification_tr WHERE to_user = '$user'
		ORDER BY id_notification  DESC LIMIT 5";
		$f = $this->db->query($str);
		$notification_content = $f->result_array();

		foreach($notification_content as $nat) {
                         $now = new Datetime(date('Y-m-d H:i:s'));
            $tgl = new Datetime($nat['datetime']." ".$nat['waktu_notif']);
            $a = $now->diff($tgl);
            if($a->y ==0 AND $a->m == 0){
            if($a->d == 0){
              
                    if($a->h == 0){
                 
                        if($a->i == 0){
                            $waktu = $a->s ." seconds ago";
                        } else{
                           $waktu = $a->i ." minutes ago";
                        }

                    }else {
                        $waktu =  $a->h ." hours ago";
                    }
            } else if($a->d == 1){
                $waktu =  "Yesterday";
            } else {
                $waktu =  $a->d ." days ago";
            }
             } else if($a->y != 0) {
                $waktu = $a->y ." years ago";
             } else if($a->y == 0 AND $a->m != 0){
                $waktu =  $a->m ." month ago";
             }


  if($nat['type'] == "Request Friend"){
                $img = $notification_image[0];
              } else if($nat['type'] == "Resume Uncomplete" OR $nat['type'] == "Expired certificate"){
                $img = $notification_image[1];
              } else if($nat['type'] == "hire crew"){
                $img = $notification_image[2];
              }

if($nat['read_user'] != 0){
echo '<a onclick="baca_notif('.$nat[id_notification].')" class="bacanotif">
<li class="notification-item" onclick="baca_notif('.$nat[id_notification].')"> 
<div class="media">
<a class="pull-left">
    	<img class ="media-object" src='.asset_url().'/img/'.$img.'>
</a>
<div class="media-body gayanotif">
    <a onclick="baca_notif('.$nat[id_notification].')">
<p><b>'.$nat[nama_pengirim].'</b> '.$nat[description] .'</p>
      	
<span class="subtitle"> '.$waktu.' 	</span></a>
</div> 	</div> </a> </li>';	
} else {
	echo '
<a onclick="baca_notif('.$nat[id_notification].')" class="bacanotif">
<li class="notification-item" style="background:#f0f0f0" onclick="baca_notif('.$nat[id_notification].')"> 
<div class="media">
<a class="pull-left">
    	<img class ="media-object" src='.asset_url().'/img/'.$img.'>
</a>
<div class="media-body gayanotif">
    <a onclick="baca_notif('.$nat[id_notification].')">
<p><b>'.$nat[nama_pengirim].'</b> '.$nat[description] .'</p>
      	
<span class="subtitle"> '.$waktu.' 	</span></a>
</div> 	</div> </a> </li>';
}

}


} else {
	header('location:'.base_url('custom404'));
}


}


	function baca_notif(){
		if($this->input->is_ajax_request()){
		$id = $this->input->get('id_notif');
		$str = "SELECT * FROM notification_tr WHERE id_notification = '$id'";
		$q = $this->db->query($str);
		$f = $q->row_array();
		echo $f['url'];

			$fz = "UPDATE notification_tr SET read_user = 1 WHERE id_notification = '$id'";
			$qz = $this->db->query($fz);
}else{
	header('location:'.base_url('custom404'));
}
	
	}



	function cek_notif(){
		if($this->input->is_ajax_request()){

		$user = $this->session->userdata('username');
		$str = "SELECT * FROM notification_tr WHERE to_user = '$user' AND 
		read_user = 0";
		$q   = $this->db->query($str);
		$j 	 = $q->num_rows();
		$js = $q->row_array();

			if($j >= 0){
			echo $j."|".@$js['from_user']."|".$js['description']."|".$js['sending_notif'];
				}


			} else {
				header("location:".base_url('custom404'));
			}


			}

			function status(){
				if($this->input->is_ajax_request()){
						$user = $this->session->userdata('username');
				$id = $this->input->post('id_notif');
				echo $pesan = "UPDATE notification_tr SET sending_notif = 1 WHERE id_notification = '$id'";
				$b = $this->db->query($pesan);
			} else {
				header('location:'.base_url('custom404'));
			}
			
			}


	}