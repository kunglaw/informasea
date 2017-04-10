function search_process($from = "search",$from_dashboard = false){
			$url = $from;
			$segment1 = $this->uri->segment(3); //nationality
			$segment2 = $this->uri->segment(4); //ship
			$segment3 = $this->uri->segment(5); //department
			$segment4 = $this->uri->segment(6); //keyword
			$segment5 = $this->uri->segment(7);

			$offset = 0;

			 if($from_dashboard) {
//            echo "$segment1, $segment2";
            /*Searcing dari Dashboard dimulai di sini*/
            $department = empty($segment2) ? str_replace('-',' ',segment2) : str_replace('-',' ',$segment1);
            $department = strpos($segment2, "Security") ? $segment2 : str_replace('-', ' ', $segment2);
            $department = strpos($segment1, "Security") ? $segment1 : str_replace('-', ' ', $segment1);
            $vessel = str_replace('-',' ', $segment1);
            $nationality = empty($segment3) ? empty($segment2) ? str_replace('-',' ', $segment1) : str_replace('-',' ', $segment2) : str_replace('-',' ', $segment3);

            $data_vessel = $this->vessel_model->get_ship_type_detail_byname($vessel);
            $data_dept = $this->department_model->get_detail_department_by_name($department);
            $data_nationality = $this->nation_model->get_detail_nationality($nationality);

            $v1 = empty($data_vessel) ? false : true;
            $v2 = empty($data_dept) ? false : true;
            $v3 = empty($data_nationality) ? false : true;

//            echo "$v1 & $v2 & $v3";
            $semua_terisi = $v1 && $v2 && $v3;
            $vessel_dan_department = $v1 && $v2 && !$v3;
            $vessel_dan_nationality = $v1 && !$v2 && $v3;
            $department_dan_nationality = !$v1 && $v2 && $v3;
            $hanya_nationality = !$v1 && !$v2 && $v3;
            $hanya_department = !$v1 && $v2 && !$v3;
            $hanya_vessel = $v1 && !$v2 && !$v3;

//            echo "$semua_terisi & $vessel_dan_department & $vessel_dan_nationality & $department_dan_nationality & $hanya_nationality & $hanya_department & $hanya_vessel";

            if ($semua_terisi) {
                /* Semua terpilih */
                $url .= "/$segment1/$segment2/$segment3/";
                if (is_numeric($segment4)) {
                    $data['search_data'] = array(
                        'department' => $data_dept['department_id'],
                        'ship_type' => $data_vessel['ship_type'],
                        'nationality' => $data_nationality['name']
                    );
                    $offset = empty($segment4) ? 0 : $segment4;
                    $segment4 = "";
                } else {
                    $data['search_data'] = array(
                        'department' => $data_dept['department_id'],
                        'ship_type' => $data_vessel['ship_type'],
                        'nationality' => $data_nationality['name'],
                        'keyword' => $segment4
                    );
                    $offset = empty($segment5) ? 0 : $segment5;
                    $url .= $segment4;
                }
                $seatizen = $this->seatizen_model->getSearchSeatizenDashboard($segment4, $data_vessel["type_id"], $data_dept["department_id"], $data_nationality['name'], false, $offset);
                $total_seatiz = count($this->seatizen_model->getSearchSeatizenDashboard($segment4, $data_vessel["type_id"], $data_dept["department_id"], $data_nationality['name'], true, $offset));
            } else if ($vessel_dan_department) {
                /* Vessel dan Department terisi */
                $url .= "/$segment1/$segment2/";
                if (is_numeric($segment3)) {
                    $data['search_data'] = array(
                        'department' => $data_dept['department_id'],
                        'ship_type' => $data_vessel['ship_type']
                    );
                    $offset = empty($segment3) ? 0 : $segment3;
                    $segment3 = "";
                } else {
                    $data['search_data'] = array(
                        'department' => $data_dept['department_id'],
                        'ship_type' => $data_vessel['ship_type'],
                        'keyword' => $segment3
                    );
                    $offset = empty($segment4) ? 0 : $segment4;
                    $url .= $segment3;
                }
                $seatizen = $this->seatizen_model->getSearchSeatizenDashboard($segment3, $data_vessel["type_id"], $data_dept["department_id"],'', false, $offset);
                $total_seatiz= count($this->seatizen_model->getSearchSeatizenDashboard($segment3, $data_vessel["type_id"], $data_dept["department_id"], '', true, $offset));
            } else if ($vessel_dan_nationality) {
                /* Vessel dan Nationality terisi */
                $url .= "/$segment1/$segment2/";
                if (is_numeric($segment3)) {
                    $data['search_data'] = array(
                        'ship_type' => $data_vessel['ship_type'],
                        'nationality' => $data_nationality['name']
                    );
                    $offset = empty($segment3) ? 0 : $segment3;
                    $segment3 = "";
                } else {
                    $data['search_data'] = array(
                        'nationality' => $data_nationality['name'],
                        'ship_type' => $data_vessel['ship_type'],
                        'keyword' => $segment3
                    );
                    $offset = empty($segment4) ? 0 : $segment4;
                    $url .= $segment3;
                }
                $seatizen = $this->seatizen_model->getSearchSeatizenDashboard($segment3, $data_vessel["type_id"], 0, $data_nationality['name'], false, $offset);
                $total_seatiz = count($this->seatizen_model->getSearchSeatizenDashboard($segment3, $data_vessel["type_id"], 0, $data_nationality['name'], true, $offset));
            } else if ($department_dan_nationality) {
                /* Department dan Nationality terisi */
                $url .= "/$segment1/$segment2/";
                if (is_numeric($segment3)) {
                    $data['search_data'] = array(
                        'department' => $data_dept['department_id'],
                        'nationality' => $data_nationality['name']
                    );
                    $offset = empty($segment3) ? 0 : $segment3;
                    $segment3 = "";
                } else {
                    $data['search_data'] = array(
                        'nationality' => $data_nationality['name'],
                        'department' => $data_dept['department_id'],
                        'keyword' => $segment3
                    );
                    $offset = empty($segment4) ? 0 : $segment4;
                    $url .= $segment3;
                }
                $seatize = $this->seatizen_model->getSearchSeatizenDashboard($segment3, 0, $data_dept['department_id'], $data_nationality['name'], false, $offset);
                $total_seatiz = count($this->seatizen_model->getSearchSeatizenDashboard($segment3, 0, $data_dept['department_id'], $data_nationality['name'], true, $offset));
            } else if ($hanya_nationality) {
                /* Hanya Nationality terisi */
                $url .= "/$segment1/";
                if (is_numeric($segment3)) {
                    $data['search_data'] = array(
                        'nationality' => $data_nationality['name']
                    );
                    $offset = empty($segment2) ? 0 : $segment2;
                    $segment2 = "";
                } else {
                    $data['search_data'] = array(
                        'nationality' => $data_nationality['name'],
                        'keyword' => $segment2
                    );
                    $offset = empty($segment3) ? 0 : $segment3;
                    $url .= $segment2;

                }
                $seatizen = $this->seatizen_model->getSearchSeatizenDashboard($segment2, 0, 0, $data_nationality['name'], false, $offset);
              print_r($seatizen);
              exit;
                $total_seatiz = count($this->seatizen_model->getSearchSeatizenDashboard($segment2, 0, 0, $data_nationality['name'], true, $offset));
            } elseif ($hanya_department) {
                /* Hanya Department terisi */
                $url .= "/$segment1/";
                if (is_numeric($segment2)) {
                    $data['search_data'] = array(
                        'department' => $data_dept['department_id']
                    );
                    $offset = empty($segment2) ? 0 : $segment2;
                    $segment2 = "";
                } else {
                    $data['search_data'] = array(
                        'department' => $data_dept['department_id'],
                        'keyword' => $segment2
                    );
                    $offset = empty($segment3) ? 0 : $segment3;
                    $url .= $segment2;
                }
                $seatizen = $this->seatizen_model->getSearchSeatizenDashboard($segment2, 0, $data_dept["department_id"], '', false, $offset);
                $total_seatiz = count($this->seatizen_model->getSearchSeatizenDashboard($segment2, 0, $data_dept["department_id"], '', true, $offset));
            } elseif ($hanya_vessel) {
                /* Hanya Vessel terisi */
                $url .= "/$segment1/";
                if (is_numeric($segment2)) {
                    $data['search_data'] = array(
                        'ship_type' => $data_vessel['ship_type']
                    );
                    $offset = empty($segment2) ? 0 : $segment2;
                    $segment2 = "";
                } else {
                    $data['search_data'] = array(
                        'ship_type' => $data_vessel['ship_type'],
                        'keyword' => $segment2
                    );
                    $offset = empty($segment3) ? 0 : $segment3;
                    $url .= $segment2;
                }
                $seatizen = $this->seatizen_model->getSearchSeatizenDashboard($segment2, $data_vessel["type_id"],0, '', false, $offset);
                $total_seatiz = count($this->seatizen_model->getSearchSeatizenDashboard($segment2, $data_vessel["type_id"],0,'', true, $offset));
            }
            else{
                /* Hanya Keyword */
                $data['search_data'] = array(
                    'keyword' => $segment1
                );
                $url .= "/$segment1/";

                if (is_numeric($segment2)) {
                    $offset = empty($segment2) ? 0 : $segment2;
                }
                $seatizen = $this->seatizen_model->getSearchSeatizenDashboard($segment1, 0,0, '', false, $offset);
                $total_seatiz = count($this->seatizen_model->getSearchSeatizenDashboard($segment1, 0,0,'', true, $offset));
            }
        }

			 else{
				//pencarian search
            $nationality        = str_replace('-',' ',$segment1);

          	
           	$ship 				= empty($segment2) ? str_replace('-',' ',$segment1) : str_replace('-',' ', $segment2); 
           	$ship 				= strpos($segment2, "Training") ? $segment2 : str_replace('-',' ',$segment2);
           	$ship 				= strpos($segmnent1,"Training") ? $segment1 : str_replace('-',' ',$segment1);
           	$department 		= empty($segment3) ? empty($segment2) ? str_replace('-',' ',$segment1) : str_replace('-',' ',$segment2) : str_replace('-',' ', $segment3);
           	
           	// $department 		= strpos($segment2, "Security") ? $segment2 : str_replace('-',' ', $segment2);
           	// $department 		= strpos($segment1, "Security") ? $segment1 : str_replace('-',' ', $segment1);
           	// $department 		= strpos($segment3, "Security") ? $segment3 : str_replace('-',' ', $segment3);

           	$rank 				= empty($segment4) ? empty($segment3) ? str_replace('-',' ',$segment2) : str_replace('-',' ', $segment3) : str_replace('-', ' ', $segment4);
           	$coc 				= empty($segment5) ? empty($segment4) ? empty($segment3) ? str_replace('-',' ',$segment2) : str_replace('-',' ',$segment3) : str_replace('-',' ',$segment4) : str_replace('-',' ',$segment5);


			 //	echo $department;
            $data_nationality 	= $this->nation_model->get_detail_nationality($nationality);
            $data_ship 			= $this->ship_model->get_detail_ship_type_by_name($ship);
            $data_dept 			= $this->department_model->get_detail_department_by_name($department);
            $data_rank 			= $this->rank_model->get_rank_detail_by_rank($rank);
            $data_coc  			= $this->coc_model->get_coc_by_name($coc);

            echo "<pre>";
            print_r($data_nationality);
            print_r($data_ship);
            print_r($data_dept);
            print_r($data_rank);
            print_r($data_coc);
            echo "</pre>";

            $v1 		= empty($data_nationality) ? false : true;
            $v2 		= empty($data_ship) ? false : true;
            $v3 		= empty($data_dept) ? false : true;
            $v4 		= empty($data_rank) ? false : true;
            $v5  		= empty($data_coc) ? false : true;	

       

            echo "segment 1 :".$segment1;
            echo "<br /> segment 2 :".$segment2;
            echo "<br /> segment 3 :".$segment3;
            echo "<br /> segment 4 :".$segment4;
            echo "<br /> segment 5 :".$segment5;

            echo "<br /> V1 : ".$v1;
            echo "<br /> V2 : ".$v2;
            echo "<br /> V3 : ".$v3;
            echo "<br /> V4 : ".$v4;
            echo "<br /> V5 : ".$v5."<br /><br />";

            //nation/ship/department/rank/coc
            $semua_terisi = $v1 && $v2 && $v3 && $v4 && $v5;
            //nation/ship/department/rank
            $semua_kecuali_coc = $v1 && $v2 && $v3 && $v4 && !$v5;
            //nation/ship/department/coc
            $semua_kecuali_rank = $v1 && $v2 && $v3 && !$v4 && $v5;
            //nation/department/rank/coc
            $semua_kecuali_ship = $v1 && !$v2 && $v3 && $v4 && $v5;
            //ship/department/rank/coc
            $semua_kecuali_nation = !$v1 && $v2 && $v3 && $v4 && $v5;
            //nation/ship/department
            $kecuali_rank_coc = $v1 && $v2 && $v3 && !$v4 && !$v5;
            //nation/departmen/rank
            $kecuali_ship_coc = $v1 && !$v2 && $v3 && $v4 && !$v5;
            //ship/department/rank
            $kecuali_nation_coc = !$v1 && $v2 && $v3 && $v4 && !$v5;
            //nation/ship
            $nation_dan_ship = $v1 && $v2 && !$v3 && !$v4 && !$v5;
            //nation/department/rank/coc
            $nation_department_full = $v1 && !$v2 && $v3 && $v4 && $v5;
            //nation/department/rank
            $nation_department_no_coc = $v1 && !$v2 && $v3 && $v4 && !$v5;
            //nation/department/coc
            $nation_department_no_rank = $v1 && !$v2 && $v3 && !$v4 && $v5;
            //nation/department
            $nation_department = $v1 && !$v2 && $v3 && !$v4 && !$v5;
            //department/rank/coc
			$department_full = !$v1 && !$v2 && $v3 && $v4 && $v5;
			//department/rank
			$department_no_coc = !$v1 && !$v2 && $v3 && $v4 && !$v5;
			//department/coc
			$department_no_rank = !$v1 && !$v2 && $v3 && !$v4 && $v5;
			//department
			$just_department = !$v1 && !$v2 && $v3 && !$v4 && !$v5;
			//ship/department/
			$ship_department_no_rank_coc = !$v1 && $v2 && $v3 && !$v4 && !$v5;
			//ship/department/coc
			$ship_department_no_rank = !$v1 && $v2 && $v3 && !$v4 && $v5; 
			//nation
			$just_nation = $v1 && !$v2 && !$v3 && !$v4 && !$v5;
			//ship
			$just_ship = !$v1 && $v2 && !$v3 && !$v4 && !$v5;
		

			if(empty($segment6)) $segment6 = '';


			if($semua_terisi){
				echo "smua terisi";
				$url .= "/$segment1/$segment2/$segment3/$segment4/$segment5/";
				if(is_numeric($segment6)){
					$data['search_data'] = array(
						'nationality' => $data_nationality['name'],
						'ship' => $data_ship['ship_type'],
						'department' => $data_dept['department'],
						'rank' => $data_rank['rank'],
						'coc' => $data_coc['coc_class']);

				} else{
					$data['search_data'] = array(
						'nationality' => $data_nationality['name'],
						'ship' => $data_ship['ship_type'],
						'department' => $data_dept['department'],
						'rank' => $data_rank['rank'],
						'coc' => $data_coc['coc_class'],
						'keyword' => $segment6);
					$url .= $segment6;
				}
				$seatizen = $this->seatizen_model->searchSeatizen($segment6,$data_nationality['name'],$data_ship['type_id'],$data_dept['department_id'],$data_rank['rank_id'],$data_coc['id_coc_class'],false,$offset);
				$total_seatiz = count($this->seatizen_model->searchSeatizen($segment6,$data_nationality['name'],$data_ship['type_id'],$data_dept['department_id'],$data_rank['rank_id'],$data_coc['id_coc_class'],true,$offset));
			} else if($semua_kecuali_coc){
				echo "semua kecuali coc";
				$url .= "/$segment1/$segment2/$segment3/$segment4/";
				if(is_numeric($segment5)){
					$data['search_data'] = array(
						'nationality' => $data_nationality['name'],
						'ship' => $data_ship['ship_type'],
						'department' => $data_dept['department'],
						'rank' => $data_rank['rank']);
					$offset = empty($segment5) ?  0 : $segment5;
					$segment5 = '';
				} else{
					$data['search_data'] = array(
						'nationality' => $data_nationality['name'],
						'ship' => $data_ship['ship_type'],
						'department' => $data_dept['department'],
						'rank' => $data_rank['rank'],
						'keyword' => $segment5);
					$url .= $segment5;
				}
				$seatizen = $this->seatizen_model->searchSeatizen($segment5,$data_nationality['name'],$data_ship['type_id'],$data_dept['department_id'],$data_rank['rank_id'],0,false,$offset);
				$total_seatiz = count($this->seatizen_model->searchSeatizen($segment5,$data_nationality['name'],$data_ship['type_id'],$data_dept['department_id'],$data_rank['rank_id'],0,true,$offset));
			} 
			else if($semua_kecuali_rank){
				echo "semua kecuali rank";
				$url .= "/$segment1/$segment2/$segment3/$segment4/";
				if(is_numeric($segment5)){
					$data['search_data'] = array(
						'nationality' => $data_nationality['name'],
						'ship' => $data_ship['ship_type'],
						'department' => $data_dept['department'],
						'coc' => $data_coc['coc_class']);
					$offset = empty($segment5) ? 0 : $segment5;
					$segment5 = '';
				} else{
					$data['search_data'] = array(
						'nationality' => $data_nationality['name'],
						'ship' => $data_ship['ship_type'],
						'department' => $data_dept['department'],
						'coc' => $data_coc['coc_class'],
						'keyword' => $segment5);
					$url .= $segment5;
				}
				$seatizen = $this->seatizen_model->searchSeatizen($segment5,$data_nationality['name'],$data_ship['type_id'],$data_dept['department_id'],0,$data_coc['id_coc_class'],false,$offset);
				$total_seatiz = count($this->seatizen_model->searchSeatizen($segment5,$data_nationality['name'],$data_ship['type_id'],$data_dept['department_id'],0,$data_coc['id_coc_class'],true,$offset));
			} 
			else if($semua_kecuali_ship){
				echo "nation department full";
				$url = "/$segment1/$segment2/$segment3/$segment4/";
				if(is_numeric($segment5)){
					$data['search_data'] = array(
						'nationality' => $data_nationality['name'],
						'department' => $data_dept['department'],
						'rank' => $data_rank['rank'],
						'coc' => $data_coc['coc_class']);
					$offset = empty($segment5) ? 0 : $segment5;
					$segment5 = '';
				} else{
					$data['search_data'] = array(
						'nationality' => $data_nationality['name'],
						'department' => $data_dept['department'],
						'rank' => $data_rank['rank'],
						'coc' => $data_coc['coc_class'],
						'keyword' => $segment5);
					$url .= $segment5;
				}
				$seatizen = $this->seatizen_model->searchSeatizen($segment5,$data_nationality['name'],0,$data_dept['department_id'],$data_rank['rank_id'],$data_coc['id_coc_class'],false,$offset);
				$total_seatiz = count($this->seatizen_model->searchSeatizen($segment5,$data_nationality['name'],0,$data_dept['department_id'],$data_rank['rank_id'],$data_coc['id_coc_class'],true,$offset));
			} 
			else if($semua_kecuali_nation){
				echo "ship department full";
				$url .= "/$segment1/$segment2/$segment3/$segment4/";
				if(is_numeric($segment5)){
					$data['search_data'] = array(
						'ship' => $data_ship['ship_type'],
						'department' => $data_dept['department'],
						'rank' => $data_rank['rank'],
						'coc' => $data_coc['coc_class']);
					$offset = empty($segment5) ? 0 : $segment5;
					$segment5 = '';
				} else{ 
					$data['search_data'] = array(
						'ship' => $data_ship['ship_type'],
						'department' => $data_dept['department'],
						'rank' => $data_rank['rank'],
						'coc' => $data_coc['coc_class'],
						'keyword' => $segment5);
					$url .= $segment5;
			}
			$seatizen = $this->seatizen_model->searchSeatizen($segment5,'',$data_ship['type_id'],$data_dept['department_id'],$data_rank['rank_id'],$data_coc['id_coc_class'],false,$offset);
			$total_seatiz = count($this->seatizen_model->searchSeatizen($segment5,'',$data_ship['type_id'],$data_dept['department_id'],$data_rank['rank_id'],$data_coc['id_coc_class'],true,$offset));
			
			} else if($kecuali_rank_coc){
				echo "Nation department ship";
				$url .= "/$segment1/$segment2/$segment3";
				if(is_numeric($segment4)){
					$data['search_data'] = array(
						'nationality' => $data_nationality['name'],
						'ship' => $data_ship['ship_type'],
						'department' => $data_dept['department']);
					$offset = empty($segment4) ? 0 : $segment4;
					$segment4 = '';
				} else {
					$data['search_data'] = array(
						'nationality' => $data_nationality['name'],
						'ship' => $data_ship['ship_type'],
						'department' => $data_dept['department'],
						'keyword' => $segment4);
					$url .= $segment4;
				}
				$seatizen = $this->seatizen_model->searchSeatizen($segment4,$data_nationality['name'],$data_ship['type_id'],$data_dept['department_id'],0,0,false,$offset);
				$total_seatiz = count($this->seatizen_model->searchSeatizen($segment4,$data_nationality['name'],$data_ship['type_id'],$data_dept['department_id'],0,0,true,$offset));
			} 
			else if($kecuali_ship_coc){
				$url .= "/$segment1/$segment2/$segment3";
				if(is_numeric($segment4)){
					$data['search_data'] = array(
						'nationality' => $data_nationality['name'],
						'department' => $data_dept['department'],
						'rank' => $data_rank['rank']);
					$offset = empty($segment4) ? 0 : $segment4;
					$segment4 = '';
				} else {
					$data['search_data'] = array(
						'nationality' => $data_nationality['name'],
						'department' => $data_dept['department'],
						'rank' => $data_rank['rank'],
						'keyword' => $segment4);
					$url .= $segment4;
				}
				$seatizen = $this->seatizen_model->searchSeatizen($segment4,$data_nationality['name'],0,$data_dept['department_id'],$data_rank['rank_id'],$data_coc['id_coc_class'],false,$offset);
				$total_seatiz = count($this->seatizen_model->searchSeatizen($segment4,$data_nationality['name'],0,$data_dept['department_id'],$data_rank['rank_id'],$data_coc['id_coc_class'],true,$offset));
			} 
			else if($kecuali_nation_coc){
				$url = "/$segment1/$segment2/$segment3/";
				if(is_numeric($segment4)){
					$data['search_data'] = array(
						'ship' => $data_ship['ship_type'],
						'department' => $data_dept['department'],
						'rank' => $data_rank['rank']);
					$offset = empty($segment4) ? 0 : $segment4;
				} else {
					$data['search_data'] = array(
						'ship' => $data_ship['ship_type'],
						'department' => $data_dept['department'],
						'rank' => $data_rank['rank'],
						'keyword' => $segment4);
					$url .= $segment4;
				}
				$seatizen = $this->seatizen_model->searchSeatizen($segment4,'',$data_ship['type_id'],$data_dept['department_id'],$data_rank['rank_id'],0,false,$offset);
				$total_seatiz = count($this->seatizen_model->searchSeatizen($segment4,'',$data_ship['type_id'],$data_dept['department_id'],$data_rank['rank_id'],0,true,$offset));
			} 
			 else if($nation_dan_ship){
			 	echo "nation dan ship";
				$url .= "/$segment1/$segment2/";
				if(is_numeric($segment3)){
					$data['search_data'] = array(
						'nationality' => $data_nationality['name'],
						'ship' => $data_ship['ship_type']);
					$offset = empty($segment3) ? 0 : $segment3;
				} else {
					$data['search_data'] = array(
						'nationality' => $data_nationality['name'],
						'ship' => $data_ship['ship_type'],
						'keyword' => $segment3);
					$url .= $segment3;
				}
				$seatizen = $this->seatizen_model->searchSeatizen($segment3,$data_nationality['name'],$data_ship['type_id'],0,0,0,false,$offset);
				$total_seatiz = count($this->seatizen_model->searchSeatizen($segment3,$data_nationality['name'],$data_ship['type_id'],0,0,0,true,$offset));
			} else if($nation_department_full){
				echo "nation department full";
				$url .= "/$segment1/$segment2/$segment3/$segment4";
				if(is_numeric($segment5)){
					$data['search_data'] = array(
						'nationality' => $data_nationality['name'],
						'department' => $data_dept['department'],
						'rank' => $data_rank['rank'],
						'coc' => $data_coc['coc_class']);
					$offset = empty($segment5) ? 0 : $segment5;
				} else {
					$data['search_data'] = array(
						'nationality' => $data_nationality['name'],
						'department' => $data_dept['department'],
						'rank' => $data_rank['rank'],
						'coc' => $data_coc['coc_class'],
						'keyword' => $segment5);
					$url .= $segment5;
				}
				$seatizen = $this->seatizen_model->searchSeatizen($segment5,$data_nationality['name'],0,$data_dept['department_id'],$data_rank['rank_id'],$data_coc['id_coc_class'],false,$offset);
				$total_seatiz = count($this->seatizen_model->searchSeatizen($segment5,$data_nationality['name'],0,$data_dept['department_id'],$data_rank['rank_id'],$data_coc['id_coc_class'],true,$offset));
			} 
			else if($nation_department_no_coc){
				echo "nation department rank";
				$url .= "/$segment1/$segment2/$segment3/";
				if(is_numeric($segment4)){
					$data['search_data'] = array(
						'nationality' => $data_nationality['name'],
						'department' => $data_dept['department'],
						'rank' => $data_rank['rank']);
					$offset = empty($segment4) ? 0 : $segment4;
				} else {
					$data['search_data'] = array(
						'nationality' => $data_nationality['name'],
						'department' => $data_dept['department'],
						'rank' => $data_rank['rank'],
						'keyword' => $segment4);
					$url .= $segment4;
				}
				$seatizen = $this->seatizen_model->searchSeatizen($segment4,$data_nationality['name'],0,$data_dept['department_id'],$data_rank['rank_id'],0,false,$offset);
				$total_seatiz = count($this->seatizen_model->searchSeatizen($segment4,$data_nationality['name'],0,$data_dept['department_id'],$data_rank['rank_id'],0,true,$offset));
			} else if($nation_department_no_rank){
				echo "hanya nation department no rank";
				$url .= "/$segment1/$segment2/$segment3/";
				if(is_numeric($segment4)){
					$data['search_data'] = array(
						'nationality' => $data_nationality['name'],
						'department' => $data_dept['department'],
						'coc' => $data_coc['coc_class']);
					$offset = empty($segment4) ? 0 : $segment4;
				} else {
					$data['search_data'] = array(
						'nationality' => $data_nationality['name'],
						'department' => $data_dept['department'],
						'coc' => $data_coc['coc_class'],
						'keyword' => $segment4);
					$url .= $segment4;
				}
				$seatizen = $this->seatizen_model->searchSeatizen($segment4,$data_nationality['name'],0,$data_dept['department_id'],0,$data_coc['id_coc_class'],false,$offset);
				$total_seatiz = count($this->seatizen_model->searchSeatizen($segment4,$data_nationality['name'],0,$data_dept['department_id'],0,$data_coc['id_coc_class'],true,$offset));
			} else if($nation_department){
				echo "hanya nation department";
				$url .= "/$segment1/$segment2/";
				if(is_numeric($segment3)){
					$data['search_data'] = array(
						'nationality' => $data_nationality['name'],
						'department' => $data_dept['department']);
					$offset = empty($segment3) ? 0 : $segment3;
				} else {
					$data['search_data'] = array(
						'nationality' => $data_nationality['name'],
						'department' => $data_dept['department'],
						'keyword' => $segment3);
					$url .= $segment3;
				}
				$seatizen = $this->seatizen_model->searchSeatizen($segment3,$data_nationality['name'],0,$data_dept['department_id'],0,0,false,$offset);
				$total_seatiz = count($this->seatizen_model->searchSeatizen($segment3,$data_nationality['name'],0,$data_dept['department_id'],0,0,true,$offset));
			} else if($department_full){
				echo "department full";
				$url .= "/$segment1/$segment2/$segment3/";
				if(is_numeric($segment4)){
					$data['search_data'] = array(
						'department' => $data_dept['department'],
						'rank' => $data_rank['rank'],
						'coc' => $data_coc['coc_class']);
					$offset = empty($segment4) ? 0 : $segment4;
				} else {
					$data['search_data'] = array(
						'department' => $data_dept['department'],
						'rank' => $data_rank['rank'],
						'coc' => $data_coc['coc_class'],
						'keyword' => $segment4);
					$url .= $segment4;
				}
				$seatizen = $this->seatizen_model->searchSeatizen($segment4,'',0,$data_dept['department_id'],$data_rank['rank_id'],$data_coc['id_coc_class'],false,$offset);
				$total_seatiz = count($this->seatizen_model->searchSeatizen($segment4,'',0,$data_dept['department_id'],$data_rank['rank_id'],$data_coc['id_coc_class'],true,$offset));
			} else if($department_no_rank){
				echo "hanya department coc";
				$url .="/$segment1/$segment2/";
				if(is_numeric($segment3)){
					$data['search_data'] = array(
						'department' => $data_dept['department'],
						'coc' => $data_coc['coc_class']);
					$offset = empty($segment3) ? 0 : $segment3;
				} else {
					$data['search_data'] = array(
						'department' => $data_dept['department'],
						'rank' => $data_coc['coc_class'],
						'keyword' => $segment3);
					$url .= $segment3;
				}
				$seatizen = $this->seatizen_model->searchSeatizen($segment3,'',0,$data_dept['department_id'],0,$data_coc['id_coc_class'],false,$offset);
				$total_seatiz = count($this->seatizen_model->searchSeatizen($segment3,'',0,$data_dept['department_id'],0,$data_coc['id_coc_class'],true,$offset));
			}else if($ship_department_no_rank){
				echo "ship department no rank";
				$url .= "/$segment1/$segment2/$segment3/";
				if(is_numeric($segment4)){
					$data['search_data'] = array(
						'ship' => $data_ship['ship_type'],
						'department' => $data_dept['department'],
						'coc' => $data_coc['coc_class']);
					$offset = empty($segment4) ? 0 : $segment4;
				} else {
					$data['search_data'] = array(
						'ship' => $data_ship['ship_type'],
						'department' => $data_dept['department'],
						'coc' => $data_coc['coc_class'],
						'keyword' => $segment4);
					$url .= $segment4;
				}
				$seatizen = $this->seatizen_model->searchSeatizen($segment4,'',$data_ship['type_id'],$data_dept['department_id'],0,$data_coc['id_coc_class'],false,$offset);
				$total_seatiz = count($this->seatizen_model->searchSeatizen($segment4,'',$data_ship['type_id'],$data_dept['department_id'],0,$data_coc['id_coc_class'],true,$offset));
			} 

			else if($ship_department_no_rank_coc){
				echo "SHIP DAN DEPARTMENT ";
				$url .="/$segment1/$segment2/";
				if(is_numeric($segment3)){
					$data['search_data'] = array(
						'ship' => $data_ship['ship_type'],
						'department' => $data_dept['department']);
					$offset = empty($segment3) ? 0 : $segment3;
				} else {
					$data['search_data'] = array(
						'ship' => $data_ship['ship_type'],
						'department' => $data_dept['department'],
						'keyword' => $segment3);
					$url .= $segment3;
				}
				$seatizen = $this->seatizen_model->searchSeatizen($segment3,'',$data_ship['type_id'],$data_dept['department_id'],0,0,false,$offset);
				$total_seatiz = count($this->seatizen_model->searchSeatizen($segment3,'',$data_ship['type_id'],$data_dept['department_id'],0,0,true,$offset));
			}else if($department_no_coc){
				echo "department rank";
				$url .="/$segment1/$segment2/";
				if(is_numeric($segment3)){
					$data['search_data'] = array(
						'department' => $data_dept['department'],
						'rank' => $data_rank['rank']);
					$offset = empty($segment3) ? 0 : $segment3;
				} else {
					$data['search_data'] = array(
						'department' => $data_dept['department'],
						'rank' => $data_rank['rank'],
						'keyword' => $segment3);
					$url .= $segment3;
				}
				$seatizen = $this->seatizen_model->searchSeatizen($segment3,'',0,$data_dept['department_id'],$data_rank['rank_id'],0,false,$offset);
				$total_seatiz = count($this->seatizen_model->searchSeatizen($segment3,'',0,$data_dept['department_id'],$data_rank['rank_id'],0,true,$offset));
			} else if($ship_department_no_coc){
				echo "hanya ship department no coc";
				$url .="/$segment1/$segment2/$segment3";;
				if(is_numeric($segment4)){
					$data['search_data'] = array(
						'ship' => $data_ship['ship_type'],
						'department' => $data_dept['department'],
						'rank' => $data_rank['rank']);
					$offset = empty($segment4) ? 0 : $segment4;
				} else {
					$data['search_data'] = array(
						'ship' => $data_ship['ship_type'],
						'department' => $data_dept['department'],
						'rank' => $data_rank['rank'],
						'keyword' => $segment4);
					$url .= $segment4;
				}
				$seatizen = $this->seatizen_model->searchSeatizen($segment4,'',$data_ship['type_id'],$data_dept['department_id'],$data_rank['rank_id'],0,false,$offset);
				$total_seatiz = count($this->seatizen_model->searchSeatizen($segment3,'',$data_ship['type_id'],$data_dept['department_id'],$data_rank['rank_id'],0,true,$offset));
			}  else if($just_department){
				echo "hanya department";
				$url .="/$segment1/";
				if(is_numeric($segment2)){
					$data['search_data'] = array(
						'department' => $data_dept['department']);
					$offset = empty($segment2) ? 0 : $segment2;
				} else {
					$data['search_data'] = array(
						'department' => $data_dept['department'],
						'keyword' => $segment2);
					$url .= $segment2;
				}
				$seatizen = $this->seatizen_model->searchSeatizen($segment2,'',0,$data_dept['department_id'],0,0,false,$offset);
				$total_seatiz = count($this->seatizen_model->searchSeatizen($segment2,'',0,$data_dept['department_id'],0,0,true,$offset));
			}

			else if($just_ship){
				echo "hanya ship";
				$url .= "/$segment1/";
				if(is_numeric($segment2)){
					$data['search_data'] = array(
						'ship' => $data_ship['ship_type']);
					$offset = empty($segment2) ? 0 : $segment2;
					$segment2 = '';
				} else{
					$data['search_data'] = array(
						'ship' => $data_ship['ship_type'],
						'keyword' => $segment2);
					$url .= $segment2;
				}
				$seatizen = $this->seatizen_model->searchSeatizen($segment2,0,$data_ship['type_id'],0,0,0,false,$offset);
				$total_seatiz = count($this->seatizen_model->searchSeatizen($segment2,0,$data_ship['type_id'],0,0,0,true,$offset));
			}

			else if($just_nation){
				echo "hanya negara";
				$url .= "/$segment1/";
				if(is_numeric($segment2)){
					$data['search_data'] = array(
						'nationality' => $data_nationality['name']);
				} else{
					$data['search_data'] = array(
						'nationality' => $data_nationality['name'],
						'keyword' => $segment2);
					$url .= $segment2;
				}
				$seatizen = $this->seatizen_model->searchSeatizen($segment2,$data_nationality['name'],0,0,0,0,false,$offset);
				$total_seatiz = count($this->seatizen_model->searchSeatizen($segment2,$data_nationality['name'],0,0,0,0,true,$offset));

			} else{
						$url .= "/$segment1/";
						echo "<br /> cuma keyword";
				if(is_numeric($segment2)) {
						$offset = empty($segment2) ? 0 : $segment2;
				}	else {
					$offset = empty($segment3) ? 0 : $segment3;
					$data['search_data'] = array(
					'keyword' => $segment1
					);
					$url .= $segment2;
					
				}
				$seatizen = $this->seatizen_model->searchSeatizen($segment1,'',0,0,0,0,false,$offset);
				$total_seatiz = count($this->seatizen_model->searchSeatizen($segment1,'',0,0,0,0,true,$offset));

			}



			}

			run_tracker("search");
			$data['seatizen'] = $seatizen;
        $data['total_seatiz'] = $total_seatiz;
        $data['page'] = $url;
        $this->directPage($data);

		}