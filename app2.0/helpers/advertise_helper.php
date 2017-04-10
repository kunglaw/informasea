<?php
    
    if(!function_exists('fill_ads_data')){
        function fill_ads_data()
        {
            /* Function ini di letakkan di container paling atas */
            $CI =& get_instance();
            $request_param = explode('/', $_SERVER['REQUEST_URI']);
            // if() 
            $data['is_preview'] = in_array('preview', $request_param) ? true: false;
            if($data['is_preview']){
                // echo $_SERVER['REQUEST_URI'];
                // print_r($request_param);
                $dbadmin = $CI->load->database(DB_SETTING3, true);
                $q = "select * from admin_advertise_list where DATE(start_date) >= '".date('Y-m-d')."' and '".date('Y-m-d')."' <= DATE(expired_date)";
                // echo $q;
                $exec = $dbadmin->query($q);

                $list_iklan = $exec->result_array();
                $exec->free_result();
                $list_iklan_atas_kiri = array();
                $list_iklan_atas_kanan = array();
                $list_iklan_bawah_kiri = array();
                $list_iklan_bawah_kanan = array();
                $list_iklan_melayang_kiri = array();
                $list_iklan_melayang_kanan = array();
                $index_atas_kiri=0;
                $index_bawah_kiri=0;
                $index_atas_kanan=0;
                $index_bawah_kanan=0;
                $index_melayang_kiri=0;
                $index_melayang_kanan=0;
                foreach ($list_iklan as $key => $value) {
                    if($value['id_area'] == 1) $list_iklan_atas_kiri[$index_atas_kiri++] = $list_iklan[$key];
                    elseif ($value['id_area'] == 2) $list_iklan_atas_kanan[$index_atas_kanan++] = $list_iklan[$key];
                    elseif ($value['id_area'] == 3) $list_iklan_bawah_kiri[$index_bawah_kiri++] = $list_iklan[$key];
                    elseif ($value['id_area'] == 4) $list_iklan_bawah_kanan[$index_bawah_kanan++] = $list_iklan[$key];
                    elseif ($value['id_area'] == 5) $list_iklan_melayang_kiri[$index_melayang_kiri++] = $list_iklan[$key];
                    elseif ($value['id_area'] == 6) $list_iklan_melayang_kanan[$index_melayang_kanan++] = $list_iklan[$key];
                }
                $data['list_iklan'] = array(
                    'top_left' => $list_iklan_atas_kiri,
                    'top_right' => $list_iklan_atas_kanan,
                    'bottom_left' => $list_iklan_bawah_kiri,
                    'bottom_right' => $list_iklan_bawah_kanan,
                    '_left' => $list_iklan_melayang_kiri,
                    '_right' => $list_iklan_melayang_kanan
                );
                // echo "<pre>";
                // print_r($data);
                // echo "</pre>";
                // print_r($list_iklan);
                // exit;
                
                $data['position'] = $CI->input->get("pos");
                $CI->db = $CI->load->database(DB_SETTING, true);

            }

            return $data;
        }
    }

    if(!function_exists('generate_preview_ads')){
        function generate_preview_ads($area, $position='horizontal')
        {
            // $CI =& get_instance();
            
            $link_iklan_terpilih = "javascript:void(0)";
            $style_width = "width='700' height='90'";
            $style_padding = "style='padding: 10px 50px; max-width: 700px; max-height: 100px; width:100%'";
            if($position == "vertical") {
                $style_padding = "style='padding: 10px 0px'";
                $style_width = "width='100%'";
            }

            $url_iklan_terpilih = asset_url("img/$area.png");
                
            
            echo "<div class=\"col-md-12\">
                     <center><a href='$link_iklan_terpilih' target='_blank'><img src=\"$url_iklan_terpilih\" $style_width alt='untuk banner iklan disini' $style_padding ></a></center>
                 </div>";
        }
    }

	if(!function_exists('generate_ads_container')){
		function generate_ads_container($list_iklan, $position='horizontal')
		{
            // $CI =& get_instance();

			$link_iklan_terpilih = "javascript:void(0)";
            $style_width = "width='700' height='90'";
            $url_space_kosong = 'ex_space_iklan.png';
            if($position == "vertical") {
                $style_width = "width='100%'";
                $url_space_kosong = "ex_space_iklan_vertical.png";
            }
            // print_r($list_iklan);
            if($list_iklan != null){
                /* Proses pengacakan iklan yan */
                shuffle($list_iklan);
                $iklan_terpilih = $list_iklan[0]['media'];
                $link_iklan_terpilih = $list_iklan[0]['ad_target_url'];
                $url_iklan_terpilih = img_url("advertise/$iklan_terpilih");
                    // echo $url_iklan_terpilih;
                    
            }
            else $url_iklan_terpilih = asset_url("img/$url_space_kosong");
                
			
			echo "<div class=\"col-md-12\">
                     <center><a href='$link_iklan_terpilih' target='_blank'><img src=\"$url_iklan_terpilih\" $style_width alt='untuk banner iklan disini' style='padding: 10px 50px'></a></center>
                 </div>";
		}
	}
?>