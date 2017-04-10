<?php if(!defined('BASEPATH')) exit (" No direct Script access allowed ");

class Image_thumb_model extends CI_Model{
	
	

// $destination = "photo";
// $destination = "timeline";


function resize_dimension($image_width = 0,$image_height = 0)
{
	$CI =& get_instance();
	// PENGATURAN RESOLUSI GAMBAR 
				
	//$x = isset(number_format($_FILES['picture']['size'])) ? number_format($_FILES['picture']['size']) : 0; 
	//$dimension = getimagesize($_FILES['picture']['tmp_name']); // dimension , ukuran pixel
	
	$ratio = 0;
	if($image_width < $image_height)
	{
		$ratio = $image_width / $image_height;
	}
	else
	{
		$ratio = $image_height / $image_width;
		
	}
	

	if(($image_height >= 480 && $image_height <= 720) || ($image_width >= 480 && $image_width <= 720))
	{
	  //echo "480 x 720 <br>";
	  $quality 			  = '100%';
	  $width 	  			= $image_width * $ratio ;
	  $height 	 	  	   = $image_height * $ratio ; //echo "<hr>";
	  
	}
	else if(($image_height >= 960 && $image_height <= 1440) || ($image_width >= 960 && $image_width <= 1440))
	{
	  //echo "960 x 144 <br>";
	  $quality 			  = '95%';
	  $width 	  			= $image_width * $ratio * $ratio ;
	  $height 	 		   = $image_height * $ratio * $ratio ;
	}
	else if(($image_height >= 1441) || ($image_width >= 1441))
	{
	  //echo "960 x 144 <br>";
	  $quality 			  = '80%';
	  $width 	  			= $image_width * $ratio * $ratio * $ratio;
	  $height 	 		   = $image_height * $ratio * $ratio * $ratio;
	}
	else
	{
	  $quality 			  = '100%';
	  $width 	  			= $image_width;
	  $height 	 		   = $image_height;	
	}
	
	
	return array('quality' => $quality,'width' => $width,'height' => $height);
	
}

function image_small($file_name = "",$destination = "")
{
	$CI =& get_instance();
	$CI->load->library("image_lib");
	$CI->load->helper('file_url');
	
	$username = $CI->session->userdata("username");
	
	$config['image_library'] = 'gd2';
	$config['source_image'] = pathup("photo/$username/big/$file_name");
	$explodesi = explode(".",$file_name);
	$config['new_image']	= pathup("$destination/$username/small/$explodesi[0]"."_small.".$explodesi[1]);
	//$config['create_thumb'] = TRUE;
	//$config['thumb_marker'] = "_small";
	//$config['quality'] = '85%';
	$config['maintain_ratio'] = FALSE;
	$config['width'] = 40;
	$config['height'] = 40;
	
	$CI->image_lib->initialize($config);
	$CI->image_lib->resize();
	$CI->image_lib->clear();
}
										// destination itu nama folder tujuan setelah assets/$username
function image_thumb($file_name = "",$destination = "")
{
	$CI =& get_instance();
	$CI->load->library("image_lib");
	$CI->load->helper('file_url');
	
	$username = $CI->session->userdata("username");
	
	$config['image_library'] = 'gd2';
	$config['source_image'] = pathup("photo/$username/big/$file_name");
	$explodesi = explode(".",$file_name);
	$config['new_image']	= pathup("$destination/$username/thumbnail/$explodesi[0]"."_thumb.".$explodesi[1]);
	//$config['create_thumb'] = TRUE;
	//$config['thumb_marker'] = "_small";
	//$config['quality'] = '85%';
	$config['maintain_ratio'] = FALSE;
	$config['width'] = 150;
	$config['height'] = 150;
	
	$CI->image_lib->initialize($config);
	$CI->image_lib->resize();
	$CI->image_lib->clear();
}

/* BUAT RESUME PIC atau Profile PIC*/
function image_small_fr($file_name = "",$destination = "resume", $source = "resume")
{
	$CI =& get_instance();
	$CI->load->library("image_lib");
	$CI->load->helper('file_url');
	
	$username = $CI->session->userdata("username");
	
	$config['image_library'] = 'gd2';
	$config['source_image'] = pathup("photo/$username/$source/$file_name");
	$explodesi = explode(".",$file_name);
	$config['new_image']	= pathup("photo/$username/$destination/$explodesi[0]"."_small.".$explodesi[1]);
	//$config['create_thumb'] = TRUE;
	//$config['thumb_marker'] = "_small";
	//$config['quality'] = '85%';
	$config['maintain_ratio'] = FALSE;
	$config['width'] = 40;
	$config['height'] = 40;
	
	$CI->image_lib->initialize($config);
	$CI->image_lib->resize();
	$CI->image_lib->clear();
		
}

function image_big_fr($file_name = "",$destination = "resume", $source = "resume")
{
	$CI =& get_instance();
	$CI->load->library("image_lib");
	$CI->load->helper('file_url');
	
	$username = $CI->session->userdata("username");
	
	$config['image_library'] = 'gd2';
	$config['source_image'] = pathup("photo/$username/$source/$file_name");
	$config['new_image']	= pathup("photo/$username/$destination/$file_name");
	//$config['create_thumb'] = TRUE;
	//$config['thumb_marker'] = "_small";
	//$config['quality'] = '85%';
	$config['maintain_ratio'] = FALSE;
	//$config['width'] = 40;
	//$config['height'] = 40;
	
	$CI->image_lib->initialize($config);
	$CI->image_lib->resize();
	$CI->image_lib->clear();
}

function image_thumb_fr($file_name = "",$destination = "resume", $source = "resume")
{
	$CI =& get_instance();
	$CI->load->library("image_lib");
	$CI->load->helper('file_url');
	
	$username = $CI->session->userdata("username");
	
	$config['image_library'] = 'gd2';
	$config['source_image'] = pathup("photo/$username/$source/$file_name");
	$explodesi = explode(".",$file_name);
	$config['new_image']	= pathup("photo/$username/$destination/$explodesi[0]"."_thumb.".$explodesi[1]);
	//$config['create_thumb'] = TRUE;
	//$config['thumb_marker'] = "_small";
	//$config['quality'] = '85%';
	$config['maintain_ratio'] = FALSE;
	$config['width'] = 150;
	$config['height'] = 150;
	
	$CI->image_lib->initialize($config);
	$CI->image_lib->resize();
	$CI->image_lib->clear();
}

// INGAT , INI BUAT CROP RESUME / PROFILE / HEADER
function image_cropping($file_name = "",$destination = "resume", $source = "resume")
{
  /*GAMBAR DI RESIZE TERLEBIH DAHULU */
  /* kedalam bentuk actual yang ada di form */

  $CI =& get_instance();
  $this->load->library("image_lib");
  //$CI->load->helper('file_url');
  
  $username 	= $this->session->userdata("username");
  
  $x_axis 	  = $this->input->post("x1");
  $y_axis 	  = $this->input->post("y1");
  $width	   = $this->input->post('width'); // lebar gambar yg di form
  $height 	  = $this->input->post("height"); // panjang gambar yg di form
  $wcrop 	   = $this->input->post("wcrop"); // width crop
  $hcrop	   = $this->input->post("hcrop"); // height crop

  $config['image_library'] 	= 'gd2';
  $config['source_image'] 	 = pathup("photo/$username/$source/$file_name");
  
  var_dump(is_file($config['source_image']));
  
  $explodesi 				  = explode(".",$file_name);
  //$config['new_image']		= pathup("photo/$username/$destination/$explodesi[0]"."_thumb.".$explodesi[1]);
  $config['new_image']		= pathup("photo/$username/$destination/$file_name");
  $config['create_thumb'] = TRUE;
  $config['thumb_marker'] = "_thumb";
  
  var_dump(is_file($config['new_image']));
  
  $config['maintain_ratio']   = FALSE;
  $config['width'] 			= $width; 
  $config['height'] 		   = $height;
  print_r($config);
  $this->image_lib->initialize($config);
  $a = $this->image_lib->resize();
  var_dump($a);
  echo $this->image_lib->display_errors();
  echo "<hr>";
  $this->image_lib->clear();
  
  
  /* CROPPING */
  /* ==================================================== */
  /*$cfcrop['image_library'] = 'gd2';
  $cfcrop['source_image'] = pathup("photo/$username/$destination/$explodesi[0]"."_thumb.".$explodesi[1]);
  $cfcrop['maintain_ratio'] = FALSE;
  $cfcrop['width']  = $wcrop;
  $cfcrop['height'] = $hcrop;
  $cfcrop['x_axis'] = $x_axis;
  $cfcrop['y_axis'] = $y_axis;
  print_r($cfcrop);
  
  $CI->image_lib->initialize($cfcrop);
  $b = $CI->image_lib->crop();
  var_dump($b);
  echo $CI->image_lib->display_errors();
  echo "<hr>";
  $CI->image_lib->clear();
  
  $cfcrop['image_library'] = 'gd2';
  $cfcrop['source_image'] = pathup("photo/$username/$destination/$explodesi[0]"."_thumb.".$explodesi[1]);
  $cfcrop['new_image'] = pathup("photo/$username/$destination/$explodesi[0]"."_small.".$explodesi[1]);
  $cfcrop['maintain_ratio'] = FALSE;
  $cfcrop['width']  = 40;
  $cfcrop['height'] = 40;
  print_r($cfcrop);
 
  $CI->image_lib->initialize($cfcrop);
  $c = $CI->image_lib->resize();
  var_dump($c);
  echo $CI->image_lib->display_errors();
  echo "<hr>";
  $CI->image_lib->clear();*/
}

/* ============================================================================= */


/* BUAT PROFILE PIC */
/* image profile pic gambar small,thumb,dan big nya ditaruh dalam satu folder profile_pic*/

function image_small_pp($file_name = "",$destination = "profile_pic")
{
	$CI =& get_instance();
	$CI->load->library("image_lib");
	$CI->load->helper('file_url');
	
	$username = $CI->session->userdata("username");
	
	$config['image_library'] = 'gd2';
	$config['source_image'] = pathup("photo/$username/profile_pic/$file_name");
	$explodesi = explode(".",$file_name);
	$config['new_image']	= pathup("photo/$username/$destination/$explodesi[0]"."_small.".$explodesi[1]);
	//$config['create_thumb'] = TRUE;
	//$config['thumb_marker'] = "_small";
	//$config['quality'] = '85%';
	$config['maintain_ratio'] = FALSE;
	$config['width'] = 40;
	$config['height'] = 40;
	
	$CI->image_lib->initialize($config);
	$CI->image_lib->resize();
	$CI->image_lib->clear();
		
}

function image_big_pp($file_name = "",$destination = "profile_pic")
{
	$CI =& get_instance();
	$CI->load->library("image_lib");
	$CI->load->helper('file_url');
	
	$username = $CI->session->userdata("username");
	
	$config['image_library'] = 'gd2';
	$config['source_image'] = pathup("photo/$username/big/$file_name");
	$config['new_image']	= pathup("photo/$username/$destination/$file_name");
	//$config['create_thumb'] = TRUE;
	//$config['thumb_marker'] = "_small";
	//$config['quality'] = '85%';
	$config['maintain_ratio'] = FALSE;
	//$config['width'] = 40;
	//$config['height'] = 40;
	
	$CI->image_lib->initialize($config);
	$CI->image_lib->resize();
	$CI->image_lib->clear();
}

function image_thumb_pp($file_name = "",$destination = "profile_pic")
{
	$CI =& get_instance();
	$CI->load->library("image_lib");
	$CI->load->helper('file_url');
	
	$username = $CI->session->userdata("username");
	
	$config['image_library'] = 'gd2';
	$config['source_image'] = pathup("photo/$username/big/$file_name");
	$explodesi = explode(".",$file_name);
	$config['new_image']	= pathup("photo/$username/$destination/$explodesi[0]"."_thumb.".$explodesi[1]);
	//$config['create_thumb'] = TRUE;
	//$config['thumb_marker'] = "_small";
	//$config['quality'] = '85%';
	$config['maintain_ratio'] = FALSE;
	$config['width'] = 150;
	$config['height'] = 150;
	
	$CI->image_lib->initialize($config);
	$CI->image_lib->resize();
	$CI->image_lib->clear();
}

/* ROTATE IMAGE */
function image_big_rotate($filename = "")
{
	$CI =& get_instance();
	$CI->load->library("image_lib");
	$CI->load->helper('file_url');
	
	$username = $CI->session->userdata("username");
	
	$config['image_library'] = 'gd2';
	//$config['library_path'] = '/usr/bin/';
	$config['source_image'] =  pathup("photo/$username/big/$filename");
	$config['rotation_angle'] = "90";
	
	$CI->image_lib->initialize($config);

	if ( ! $CI->image_lib->rotate())
	{
		echo $CI->image_lib->display_errors();
	}
	$CI->image_lib->clear();
	
}

function image_thumb_rotate($filename = "")
{
	$CI =& get_instance();
	$CI->load->library("image_lib");
	$CI->load->helper('file_url');
	
	$username = $CI->session->userdata("username");
	
	$xx = explode(".",$filename);
	$filename = $xx[0]."_thumb.".$xx[1];
	
	$config['image_library'] = 'gd2';
	//$config['library_path'] = '/usr/bin/';
	$config['source_image'] =  pathup("photo/$username/thumbnail/$filename");
	$config['rotation_angle'] = "90";
	
	$CI->image_lib->initialize($config);

	if ( ! $CI->image_lib->rotate())
	{
		echo $CI->image_lib->display_errors();
	}
	$CI->image_lib->clear();
	
}

function image_small_rotate($filename = "")
{
	$CI =& get_instance();
	$CI->load->library("image_lib");
	$CI->load->helper('file_url');
	
	$username = $CI->session->userdata("username");
	
	$xx = explode(".",$filename);
	$filename = $xx[0]."_small.".$xx[1];
	
	$config['image_library'] = 'gd2';
	//$config['library_path'] = '/usr/bin/';
	$config['source_image'] =  pathup("photo/$username/small/$filename");
	$config['rotation_angle'] = "90";
	
	$CI->image_lib->initialize($config);

	if ( ! $CI->image_lib->rotate())
	{
		echo $CI->image_lib->display_errors();
	}
	$CI->image_lib->clear();
	
}


//  echo image_thumb( 'assets/images/picture-1/picture-1.jpg', 50, 50 );  contoh penggunaan

/* End of file image_helper.php */
/* Location: ./application/helpers/image_helper.php */
		
	
	
}