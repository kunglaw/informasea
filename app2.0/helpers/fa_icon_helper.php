<?php if(!defined('BASEPATH')) exit ('No Direct Script Access Allowed');

if ( ! function_exists('fa'))
{
		function fa($icon, $add_on = '')
		{
			return "<i class='fa fa-$icon' $add_on></i>";
		}
}