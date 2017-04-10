<?php if(!defined('BASEPATH')) exit ('No Direct Script access allowed');

function success_seaman()
{
		
}

function define_cookie_seaman($data)
{
	$CI =& get_instance();
	$CI->load->helper("cookie");
	
	$cookies = array(
		array(
			'name'   => 'name',
			'value'  => $data['name'],
			'expire' => '86500',
			/* 'domain' => '.some-domain.com',
			'path'   => '/',
			'prefix' => 'myprefix_',*/
			//'secure' => TRUE
		),

		array(
			'name'   => "photo",
			'value'  => $data['photo'],
			'expire' => '86500',
			/* 'domain' => '.some-domain.com',
			'path'   => '/',
			'prefix' => 'myprefix_',*/ 
			//'secure' => TRUE
		),

		array(

			'name'   => "username",
			'value'  => $data['username'],
			'expire' => '86500',
			/* 'domain' => '.some-domain.com',
			'path'   => '/',
			'prefix' => 'myprefix_', */
			//'secure' => TRUE
		),

		array(
			'name'   => "cover",
			'value'  => $data['cover'],
			'expire' => '86500',
			/* 'domain' => '.some-domain.com',
			'path'   => '/',
			'prefix' => 'myprefix_',*/
			//'secure' => TRUE
		),
		
		array(
			'name'   => "success",
			'value'  => $data['success'],
			'expire' => '86500',
			/* 'domain' => '.some-domain.com',
			'path'   => '/',
			'prefix' => 'myprefix_',*/
			//'secure' => TRUE
		),
		
		array(
			'name'   => "error",
			'value'  => $data['error'],
			'expire' => '86500',
			/* 'domain' => '.some-domain.com',
			'path'   => '/',
			'prefix' => 'myprefix_',*/
			//'secure' => TRUE
		),
	);
	
	foreach($cookies as $cookie){
		$CI->input->set_cookie($cookie);
	}
}

function clear_cookie_seaman()
{
	$CI =& get_instance();
	$CI->load->helper('cookie');
	//$this->session->sess_destroy();
	
	$cookies = array(
		array(
		  'name'   => 'name',
		  'value'  => ""
		  //'domain' => base_url(),
		  //'path'   => '/',
		  //'prefix' => 'userinformasea_',
		  //'secure' => TRUE
		),
		
		array(
		  'name'   => "photo",
		  'value'  => ""
		  //'domain' => base_url(),
		  //'path'   => '/',
		  //'prefix' => 'userinformasea_',
		  //'secure' => TRUE
		),
		
		array(
		  'name'   => "username",
		  'value'  => ""
		  //'domain' => base_url(),
		  //'path'   => '/',
		  //'prefix' => 'userinformasea_',
		  //'secure' => TRUE
		),
		
		array(
		  'name'   => "success",
		  'value'  => ""
		  //'domain' => base_url(),
		  //'path'   => '/',
		  //'prefix' => 'userinformasea_',
		  //'secure' => TRUE
		),
		
		array(
		  'name'   => "error",
		  'value'  => ""
		  //'domain' => base_url(),
		  //'path'   => '/',
		  //'prefix' => 'userinformasea_',
		  //'secure' => TRUE
		),
		
		array(
			"name"=>"cover",
			"value"=>""
		)
	);

	foreach($cookies as $cookie){
		delete_cookie($cookie['name']);
		unset($cookie['name']);
		
	}
	setcookie(NULL,NULL,-1,"/");
}

function success_company($success_msg)
{
	$CI =& get_instance();
	$CI->load->helper('cookie');
	
	$cookies = array(
		array(
		  'name'   => 'success_company',
		  'value'  => $success_msg,
		  'expire' => '86500',
			/* 'domain' => '.some-domain.com',
			'path'   => '/',
			'prefix' => 'myprefix_',*/
			//'secure' => TRUE
		),
	);
	
	foreach($cookies as $cookie){
		$CI->input->set_cookie($cookie);
	}	
	
}

function define_cookie_agent($data)
{
	$CI =& get_instance();
	$CI->load->helper('cookie');
	
	/* $data_cookie = array(
						
		"company_name"     => $check_user['nama_perusahaan'],
		"contact_person"   => $check_a['contact_person'],
		"photo_company"    => $url,
		"username_agent"   => $check_a['username'],
		"cover_company"    => $url_cover
	
	); */
	
	$cookies = array(
		array(
		  'name'   => 'company_name',
		  'value'  => $data['company_name'],
		  'expire' => '86500',
			/* 'domain' => '.some-domain.com',
			'path'   => '/',
			'prefix' => 'myprefix_',*/
			//'secure' => TRUE
		),
		
		array(
			'name'   => 'contact_person',
			'value'  => $data['contact_person'],
			'expire' => '86500',
			/* 'domain' => '.some-domain.com',
			'path'   => '/',
			'prefix' => 'myprefix_',*/
			//'secure' => TRUE
		),
		
		array(
		  'name'   => "photo_company",
		  'value'  => $data['photo_company'],
		  'expire' => '86500',
			/* 'domain' => '.some-domain.com',
			'path'   => '/',
			'prefix' => 'myprefix_',*/
		  //'secure' => TRUE
		),
		
		array(
		
		  'name'   => "username_agent",
		  'value'  => $data['username_agent'],
		  'expire' => '86500',
		  /* 'domain' => '.some-domain.com',
		  'path'   => '/',
		  'prefix' => 'myprefix_',*/
		  //'secure' => TRUE
		),
		
		array(
		  'name'   => "cover_company",
		  'value'  => $data['cover_company'],
		  'expire' => '86500',
		  /* 'domain' => '.some-domain.com',
		  'path'   => '/',
		  'prefix' => 'myprefix_',*/
		  //'secure' => TRUE
		),
		
		array(
		
		  'name'   => "success_company",
		  'value'  => $data['success_company'],
		  'expire' => '86500',
		  /* 'domain' => '.some-domain.com',
		  'path'   => '/',
		  'prefix' => 'myprefix_',*/
		  //'secure' => TRUE
		),
		
		array(
		
		  'name'   => "error_company",
		  'value'  => $data['error_company'],
		  'expire' => '86500',
		  /* 'domain' => '.some-domain.com',
		  'path'   => '/',
		  'prefix' => 'myprefix_',*/
		  //'secure' => TRUE
		),
	);
	
	foreach($cookies as $cookie){
		$CI->input->set_cookie($cookie);
	}
}

function define_cookie_company($data)
{
	$CI =& get_instance();
	$CI->load->helper('cookie');
	
	$cookies = array(
		array(
		  'name'   => 'company_name',
		  'value'  => $data['company_name'],
		  'expire' => '86500',
			/* 'domain' => '.some-domain.com',
			'path'   => '/',
			'prefix' => 'myprefix_',*/
			//'secure' => TRUE
		),
		
		array(
			'name'   => 'contact_person',
			'value'  => $data['contact_person'],
			'expire' => '86500',
			/* 'domain' => '.some-domain.com',
			'path'   => '/',
			'prefix' => 'myprefix_',*/
			//'secure' => TRUE
		),
		
		array(
		  'name'   => "photo_company",
		  'value'  => $data['photo_company'],
		  'expire' => '86500',
			/* 'domain' => '.some-domain.com',
			'path'   => '/',
			'prefix' => 'myprefix_',*/
		  //'secure' => TRUE
		),
		
		array(
		
		  'name'   => "username_company",
		  'value'  => $data['username_company'],
		  'expire' => '86500',
		  /* 'domain' => '.some-domain.com',
		  'path'   => '/',
		  'prefix' => 'myprefix_',*/
		  //'secure' => TRUE
		),
		
		array(
		  'name'   => "cover_company",
		  'value'  => $data['cover_company'],
		  'expire' => '86500',
		  /* 'domain' => '.some-domain.com',
		  'path'   => '/',
		  'prefix' => 'myprefix_',*/
		  //'secure' => TRUE
		),
		
		array(
		
		  'name'   => "success_company",
		  'value'  => $data['success_company'],
		  'expire' => '86500',
		  /* 'domain' => '.some-domain.com',
		  'path'   => '/',
		  'prefix' => 'myprefix_',*/
		  //'secure' => TRUE
		),
		
		array(
		
		  'name'   => "error_company",
		  'value'  => $data['error_company'],
		  'expire' => '86500',
		  /* 'domain' => '.some-domain.com',
		  'path'   => '/',
		  'prefix' => 'myprefix_',*/
		  //'secure' => TRUE
		),
	);
	
	foreach($cookies as $cookie){
		$CI->input->set_cookie($cookie);
	}
}


function clear_cookie_company()
{
	$CI =& get_instance();
	$CI->load->helper('cookie');
		
	$cookies = array(
		array(
		  'name'   => 'company_name',
		  'value'  => "",
		  'expire' => '86500',
		),
		
		array(
		  'name'   => "photo_company",
		  'value'  => "",
		  'expire' => '86500',
		),
		
		array(
		  'name'   => "username_company",
		  'value'  => "",
		  'expire' => '86500',
		),
		
		array(
		  'name'   => "cover_company",
		  'value'  => "",
		  'expire' => '86500'
		),
		
		//success
		array(
		  'name'   => 'success_company',
		  'value'  => "",
		  'expire' => '10'							
		),
		
		array(
		  'name'   => "error_company",
		  'value'  => "",
		  'expire' => '86500'
		),
	);
	
	if(!empty($cookies))
	{
		foreach($cookies as $c){
			delete_cookie($c['name']);
			unset($c);
			setcookie($c['name'],NULL,-1,"/");
		
		}
	}
}