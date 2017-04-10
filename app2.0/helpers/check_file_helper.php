<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

if(!function_exists("check_profile_seaman"))
{
	function check_profile_seaman($username)
	{
		$CI =& get_instance();
		
		// database bisa dipersingkat
		// kalau bisa dipindahkan ke model masing - masing 
		
		$str = "select * from photo_pelaut_tr WHERE username = '$username' AND ( profile_pic = 1 AND cover = 0 AND resume = 0 ) ";
		$q = $CI->db->query($str);
		$f = $q->row_array();
		
		// check gambar salah
		/* $ss = explode(".",$f['nama_gambar']);
		$thumb = $ss[0]."_thumb.".$ss[1];
		$small = $ss[0].$ss[1];*/

		if($f == null) $url = DEFAULT_IMG_PROFILE_SEAMAN;
		else
		{
			$img = pathinfo($f['nama_gambar']);
			$thumb = $img['filename']."_thumb.".$img['extension'];
			$small = $img['filename'].".".$img['extension'];
			
			$path_thumb = img_path("photo/$username/profile_pic/$thumb");
			$url_thumb  = img_url("photo/$username/profile_pic/$thumb");
			
			$path_small = img_path("photo/$username/profile_pic/$small");
			$url_small  = img_url("photo/$username/profile_pic/$small");
			
			$size = get_headers($url_thumb, 1);
			
			
			if(!empty($f) && file_exists($path_thumb) && $size["Content-Length"] > 0)
			{
				$url = $url_thumb;
				
			}
			else
			{
				
				if(check_img_resume($username) != DEFAULT_IMG_RESUME_SEAMAN)
				{
					$url = check_img_resume($username);
				}
				else
				{
					$url = DEFAULT_IMG_PROFILE_SEAMAN;
				}
			}		
		}
		return $url;
	}
}

if(!function_exists("check_img_resume"))
{
	function check_img_resume($username)
	{
		$CI =& get_instance();
		
		$str = "SELECT * FROM photo_pelaut_tr WHERE username = '$username' AND (resume = 1 AND cover = 0 AND profile_pic = 0)";
		$q = $CI->db->query($str);
		$f = $q->row_array();
		
		$img = pathinfo($f['nama_gambar']);
		$thumb = $img['filename']."_thumb.".$img['extension'];
		
		$path_thumb = img_path("photo/$username/resume/$thumb");
		$url_thumb  = img_url("photo/$username/resume/$thumb");
		
		if(!empty($f) && file_exists($path_thumb))
		{
			$url = $url_thumb;
		}
		else
		{
			$url = DEFAULT_IMG_RESUME_SEAMAN;
		}
		
		return $url;		
		
	}
}

if(!function_exists("check_img_seaman_sosmed"))
{
	function check_img_seaman_sosmed($username)
	{
		$CI =& get_instance();
		
		// database bisa dipersingkat
		// kalau bisa dipindahkan ke model masing - masing 
		
		$str = "select * from photo_pelaut_tr WHERE username = '$username' AND ( profile_pic = 1 AND cover = 0 AND resume = 0 ) ";
		$q = $CI->db->query($str);
		$f = $q->row_array();
		
		// check gambar salah
		/* $ss = explode(".",$f['nama_gambar']);
		$thumb = $ss[0]."_thumb.".$ss[1];
		$small = $ss[0].$ss[1];*/

		if($f == null) $url = DEFAULT_IMG_LOGO_SEAMAN_PNG;
		else
		{
			$img = pathinfo($f['nama_gambar']);
			$thumb = $img['filename']."_thumb.".$img['extension'];
			$small = $img['filename'].".".$img['extension'];
			
			$path_thumb = img_path("photo/$username/profile_pic/$thumb");
			$url_thumb  = img_url("photo/$username/profile_pic/$thumb");
			
			$path_small = img_path("photo/$username/profile_pic/$small");
			$url_small  = img_url("photo/$username/profile_pic/$small");
			
			if(!empty($f) && file_exists($path_thumb))
			{
				$url = $url_thumb;
				
			}
			else
			{
				
				if(check_img_resume($username) != DEFAULT_IMG_RESUME_SEAMAN)
				{
					$url = check_img_resume($username);
				}
				else
				{
					$url = DEFAULT_IMG_LOGO_SEAMAN_PNG."";
				}
			}		
		}
		return $url;
		
		
	}
	
}

/* ============================ CREW =================================================== */

if(!function_exists('check_resume_crew'))
{
	
	function check_resume_crew_thumb($username_company,$value)
	{
		$CI =& get_instance();
		
		/*
			agak rumit
		*/
		
		$straa = "SELECT pelaut_id,username from pelaut_ms where pelaut_id = '$value' "; 
		$qaa   = $CI->db->query($straa);
		$faa   = $qaa->row_array(); 
		
		$str = "SELECT * FROM photo_crew WHERE username = '$faa[username]' ";
		$q = $CI->db->query($str);
		$f = $q->row_array();
		
		$username      = $username_company;
		$username_crew = $f['username'];
		
		//$ss = explode(".",$f['nama_gambar']);
		//$thumb = $ss[0]."_thumb.".$ss[1];
		$img = pathinfo($f['nama_gambar']);
		$thumb = $img['filename']."_thumb.".$img['extension'];
		
		$path_thumb = pathup("company/photo/$username/resume/$username_crew/$thumb");
		$url_thumb  = img_url("company/photo/$username/resume/$username_crew/$thumb");
		
		if(!empty($f) && file_exists($path_thumb))
		{
			$url = $url_thumb;
		}
		else
		{
			$url = DEFAULT_IMG_RESUME_CREW;
		}
		
		return $url;
		
		
	}
	
}

if(!function_exists('check_resume_crew'))
{
	
	function check_resume_crew($username_company,$value)
	{
		$CI =& get_instance();
		
		/*
			agak rumit
		*/
		
		$straa = "SELECT pelaut_id,username from pelaut_ms where pelaut_id = '$value' "; echo "<br>";
		$qaa   = $CI->db->query($straa);
		$faa   = $qaa->row_array(); 
		
		$str = "SELECT * FROM photo_crew WHERE username = '$faa[username]' "; echo "<br>";
		$q = $CI->db->query($str);
		$f = $q->row_array();
		
		$username      = $username_company;
		$username_crew = $f['username'];
		
		$path_thumb = pathup("company/photo/$username/resume/$username_crew/$f[nama_gambar]");
		$url_thumb  = img_url("company/photo/$username/resume/$username_crew/$f[nama_gambar]");
		
		if(!empty($f) && file_exists($path_thumb))
		{
			$url = $url_thumb;
		}
		else
		{
			$url = DEFAULT_IMG_RESUME_CREW;
		}
		
		return $url;
		
		
	}
	
}


/* ============================ END CREW =============================================== */

/* ============================ LOGO AGENTSEA ========================================== */

if(!function_exists("check_logo_agentsea_sosmed"))
{
	function check_logo_agentsea_sosmed($username)
	{
		$CI =& get_instance();
		
		$str = "SELECT * FROM photo_perusahaan_tr WHERE  username = '$username'   AND (profile_pic = 1 AND cover = 0)";
		$q   = $CI->db->query($str);
		$f   = $q->row_array();
		
		//$ss = explode(".",$f['nama_gambar']);
		//$thumb = $ss[0]."_thumb.".$ss[1];
		$img = pathinfo($f['nama_gambar']);
		$thumb = $img['filename']."_thumb.".$img['extension'];
		
		$path_thumb = img_path("company/photo/$username/logo/$thumb");
		$url_thumb  = img_url("company/photo/$username/logo/$thumb");
		
		if(!empty($f) && file_exists($path_thumb))
		{
			$url = $url_thumb;
		}
		else
		{
			$url = DEFAULT_IMG_LOGO_AGENTSEA_PNG;
		}
		
		return $url;
		
		
	}
}

if(!function_exists("check_img_timeline"))
{
	function check_img_timeline($id_timeline)
	{
		$CI =& get_instance();
		
		$str = "SELECT * FROM timeline WHERE  id_timeline = '$id_timeline'";
		$q   = $CI->db->query($str);
		$f   = $q->row_array();
		// echo "<br>";
		//$ss = explode(".",$f['nama_gambar']);
		//$thumb = $ss[0]."_thumb.".$ss[1];
		$img = pathinfo($f['photo']);
		$thumb = $img['filename']."_thumb.".$img['extension'];
		
		$path_thumb = img_path("timeline/$f[username]/big/$f[photo]");
		// echo "<br>";
		$url_thumb  = img_url("timeline/$f[username]/big/$f[photo]");
		
		if(!empty($f) && file_exists($path_thumb))
		{
			$url = $url_thumb;
		}
		else
		{
			$url = DEFAULT_IMG_LOGO_AGENTSEA_PNG;
		}
		
		return $url;
		
		
	}
}

if(!function_exists("check_logo_agentsea"))
{
	
	function check_logo_agentsea($username)
	{
		$CI =& get_instance();
		
		$str = "SELECT * FROM photo_perusahaan_tr WHERE  username = '$username' AND (profile_pic = 1 AND cover = 0 AND profile_manager = 0)";
		$q   = $CI->db->query($str);
		$f   = $q->row_array();
		
		//$ss = explode(".",$f['nama_gambar']);
		//$thumb = $ss[0].".".$ss[1];
		
		$path_thumb = pathup("company/photo/$username/logo/$f[nama_gambar]");
		$url_thumb  = img_url("company/photo/$username/logo/$f[nama_gambar]");
		
		if(!empty($f) && file_exists($path_thumb))
		{
			$url = $url_thumb;
		}
		else
		{
				
			$url = DEFAULT_IMG_LOGO_AGENTSEA;
		}
		
		return $url;
		
		
	}	
}

if(!function_exists("check_logo_agentsea_thumb"))
{
	
	function check_logo_agentsea_thumb($username)
	{
		$CI =& get_instance();
		
		$str = "SELECT * FROM photo_perusahaan_tr WHERE  username = '$username' AND (profile_pic = 1 AND cover = 0 AND profile_manager = 0)";
		$q   = $CI->db->query($str);
		$f   = $q->row_array();
		
		// check gambar salah
		/* $ss = explode(".",$f['nama_gambar']);
		$thumb = $ss[0]."_thumb.".$ss[1];
		$small = $ss[0].$ss[1];*/
		
		$img = pathinfo($f['nama_gambar']);
		$thumb = $img['filename']."_thumb.".$img['extension'];
		
		$path_thumb = pathup("company/photo/$username/logo/$thumb");
		$url_thumb  = img_url("company/photo/$username/logo/$thumb");
		
		if(!empty($f) && file_exists($path_thumb))
		{
			$url = $url_thumb;
		}
		else
		{
				
			$url = DEFAULT_IMG_LOGO_AGENTSEA;
		}
		
		return $url;
		
		
	}	
}

if(!function_exists("check_logo_agentsea_small"))
{
	
	function check_logo_agentsea_small($username)
	{
		$CI =& get_instance();
		
		$str = "SELECT * FROM photo_perusahaan_tr WHERE  username = '$username' AND (profile_pic = 1 AND cover = 0 AND profile_manager = 0)";
		$q   = $CI->db->query($str);
		$f   = $q->row_array();
		
		//explode
		//$ss = explode(".",$f['nama_gambar']);
		//$small = $ss[0]."_small.".$ss[1];
		$img = pathinfo($f['nama_gambar']);
		$thumb = $img['filename']."_thumb.".$img['extension'];
		
		$path_thumb = pathup("company/photo/$username/logo/$small");
		$url_thumb  = img_url("company/photo/$username/logo/$small");
		
		if(!empty($f) && file_exists($path_thumb))
		{
			$url = $url_thumb;
		}
		else
		{
				
			$url = DEFAULT_IMG_LOGO_AGENTSEA;
		}
		
		return $url;
		
		
	}	
}

/* =============================================== END LOGO AGENTSEA ================================== */

if(!function_exists('check_profile_manager'))
{
	function check_profile_manager($username)
	{
		$CI =& get_instance();
		
		$str = "SELECT * FROM photo_perusahaan_tr WHERE  username = '$username'   AND (profile_pic = 0 AND cover = 0 AND profile_manager = 1)";
		$q   = $CI->db->query($str);
		$f   = $q->row_array();
		
		$path_thumb = pathup("company/photo/$username/profil_pic/$f[nama_gambar]");
		$url_thumb  = img_url("company/photo/$username/profil_pic/$f[nama_gambar]");
		
		if(!empty($f) && file_exists($path_thumb))
		{
			$url = $url_thumb;
		}
		else
		{
			$url = DEFAULT_IMG_PROFILE_MANAGER;
		}
		
		return $url;
		
	}
}

if(!function_exists('check_profile_manager_thumb'))
{
	function check_profile_manager_thumb($username)
	{
		$CI =& get_instance();
		
		$str = "SELECT * FROM photo_perusahaan_tr WHERE  username = '$username' AND (profile_pic = 0 AND cover = 0 AND profile_manager = 1)";
		$q   = $CI->db->query($str);
		$f   = $q->row_array();
		
		//$ss = explode(".",$f['nama_gambar']);
		//$thumb = $ss[0]."_thumb.".$ss[1];
		$img = pathinfo($f['nama_gambar']);
		$thumb = $img['filename']."_thumb.".$img['extension'];
		
		$path_thumb = pathup("company/photo/$username/profil_pic/$thumb");
		$url_thumb  = img_url("company/photo/$username/profil_pic/$thumb");
		
		if(!empty($f) && file_exists($path_thumb))
		{
			$url = $url_thumb;
		}
		else
		{
			$url = DEFAULT_IMG_PROFILE_MANAGER;
		}
		
		return $url;
		
	}
}

if(!function_exists('check_profile_agent'))
{
	function check_profile_agent($username)
	{
		$CI =& get_instance();	
		
	}
}



if(!function_exists("check_cover_agentsea"))
{
	function check_cover_agentsea($username)
	{
		$CI =& get_instance();
		
		$str = "SELECT * FROM photo_perusahaan_tr WHERE username = '$username' AND (cover = 1 AND profile_pic = 0)";	
		$q   = $CI->db->query($str);
		$f   = $q->row_array();
		
		//$ss = explode(".",$f['nama_gambar']);
		//$thumb = $ss[0]."_thumb.".$ss[1];
		$img = pathinfo($f['nama_gambar']);
		$thumb = $img['filename']."_thumb.".$img['extension'];
		
		$path_thumb = img_path("company/photo/$username/cover/$thumb");
		$url_thumb  = img_url("company/photo/$username/cover/$thumb");
		
		if(!empty($f) && file_exists($path_thumb))
		{
			$url = $url_thumb;
		}
		else
		{
			$url = DEFAULT_IMG_COVER_AGENT;
		}
		
		return $url;
		 
		
	}
	
}

if(!function_exists("check_cover_seaman"))
{
	function check_cover_seaman($username)
	{
		$CI =& get_instance();
		
		$str = "SELECT * FROM photo_pelaut_tr WHERE username = '$username' AND (cover = 1 AND profile_pic = 0 AND resume = 0)";	
		$q   = $CI->db->query($str);
		$f   = $q->row_array();
		
		//$ss = explode(".",$f['nama_gambar']);
		//$thumb = $ss[0]."_thumb.".$ss[1];
		if($f == null) $url = DEFAULT_IMG_PROFILE_SEAMAN;
		else
		{
			$img = pathinfo($f['nama_gambar']);
			$thumb = $img['filename']."_thumb.".$img['extension'];
			
			$path_thumb = img_path("photo/$username/cover/$thumb");
			$url_thumb  = img_url("photo/$username/cover/$thumb");
			
			if(!empty($f) && file_exists($path_thumb))
			{
				$url = $url_thumb;
			}
			else
			{
				$url = DEFAULT_IMG_COVER_SEAMAN;
			}
		}
		return $url;	
		
	}
	
}

// PHOTO

if(!function_exists("check_photo_small"))
{
	function check_photo_small($username,$nama_gambar)
	{
		$CI =& get_instance();
		
	}
}

if(!function_exists("check_photo_thumbnail"))
{
	function check_photo_thumbnail($username,$nama_gambar)
	{
		$CI =& get_instance();
		
		$str = "SELECT * FROM photo_pelaut_tr WHERE username = '$username' AND nama_gambar = '$nama_gambar' ";	
		$q   = $CI->db->query($str);
		$f   = $q->row_array();
		
		//$ss = explode(".",$nama_gambar);
		$img = pathinfo($f['nama_gambar']);
		$thumb = $img['filename']."_thumb.".$img['extension'];
		$str_path = "photo/$username/thumbnail/$ss[0]"."_thumb.".$ss[1];
		$img_url  = img_url($str_path);
		$path 	 = pathup($str_path);
		
		if(!empty($f) && file_exists($path))
		{ 
		    $url = $img_url;
		}
		else if(!file_exists($path) || empty($f))
		{
			$url = DEFAULT_PHOTO_THUMB;
		}
		
		return $url;
		
	}
}

if(!function_exists("check_photo_big"))
{
	function check_photo_big($username,$nama_gambar)
	{
		$CI =& get_instance();
		
	}
}
