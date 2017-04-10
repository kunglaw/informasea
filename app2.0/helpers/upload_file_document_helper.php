<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 



if(!function_exists('view_attachment'))
{
	function view_attachment()
	{
		$CI =& get_instance();
	
			
	}
}

if(!function_exists("upload_document_pelaut"))
{
	function upload_document_pelaut($attachment, $username, $type_document)
	{
		$CI =& get_instance();
		
		// database bisa dipersingkat
		// kalau bisa dipindahkan ke model masing - masing 
		
        if(!empty($attachment["name"]))
		{
			
			$config['upload_path'] = img_path("document/$username/doc/$type_document");
			
			$config['allowed_types'] = 'pdf|jpg|png';
			$config['max_size']	  = '1000'; // kb
			$config['file_name']	 = $attachment['name'];
			// $config['max_width']  = '1024';
			// $config['max_height']  = '768';
			$CI->load->library('upload', $config);
	
			//Perform upload.
			$lamp 	= array();
			$pesan 	= "";
			$filenya = $config['upload_path']."/".$attachment['name'];
			if(is_file($filenya)) unlink($filenya);

			if($CI->upload->do_upload("attachment", $attachment['name']))
			{
				$pesan = "sukses";
				$lamp = $CI->upload->data();
			} else {
				$pesan = "gagal";
				$lamp = $CI->upload->display_errors(); 
			}
		}		
		return array('data' => $lamp, 'pesan' => $pesan);
	}
	
	function upload_coc_pelaut($attachment, $username)
	{
		$CI =& get_instance();
		
		// database bisa dipersingkat
		// kalau bisa dipindahkan ke model masing - masing 
		
        if(!empty($attachment["name"]))
		{
			
			$config['upload_path'] = img_path("document/$username/coc");
			
			$config['allowed_types']  = 'pdf|jpg|png';
			$config['max_size']	   = '1000'; // kb
			$config['file_name']	  = $attachment['name'];
			// $config['max_width']   = '1024';
			// $config['max_height']  = '768';
			$CI->load->library('upload', $config);
	
			//Perform upload.
			$lamp 	= array();
			$pesan 	= "";
			$filenya = $config['upload_path']."/".$attachment['name'];
			if(is_file($filenya)) unlink($filenya);

			if($CI->upload->do_upload("attachment", $attachment['name']))
			{
				$pesan = "sukses";
				$lamp = $CI->upload->data();
			} else {
				$pesan = "gagal";
				$lamp = $CI->upload->display_errors(); 
			}
		}		
		return array('data' => $lamp, 'pesan' => $pesan);
	}
	
	function upload_prof_pelaut($attachment, $username)
	{
		$CI =& get_instance();
		
		// database bisa dipersingkat
		// kalau bisa dipindahkan ke model masing - masing 
		
        if(!empty($attachment["name"]))
		{
			
			$config['upload_path'] = img_path("document/$username/proficiency");
			
			$config['allowed_types']  = 'jpg|png|pdf';
			$config['max_size']	   = '1000'; // kb
			$config['file_name']	  = $attachment['name'];
			// $config['max_width']   = '1024';
			// $config['max_height']  = '768';
			$CI->load->library('upload', $config);
	
			//Perform upload.
			$lamp 	= array();
			$pesan 	= "";
			$filenya = $config['upload_path']."/".$attachment['name'];
			if(is_file($filenya)) unlink($filenya);

			if($CI->upload->do_upload("attachment", $attachment['name']))
			{
				$pesan = "sukses";
				$lamp = $CI->upload->data();
			} else {
				$pesan = "gagal";
				$lamp = $CI->upload->display_errors(); 
			}
		}		
		return array('data' => $lamp, 'pesan' => $pesan);
	}
}
