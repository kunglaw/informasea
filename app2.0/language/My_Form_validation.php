<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

  private $CI;

  public function __construct($rules = array())
  {
   parent::__construct($rules);
   $this->CI->lang->load('MY_form_validation');
  }
  
  function alpha_dash_space($str)
  {
   return ( ! preg_match("/^([-a-z0-9_ ])+$/i", $str)) ? FALSE : TRUE;
  }

}
