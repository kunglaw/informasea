<?php
$username   = $this->session->userdata("username_company");

    /* Job Statistics Data Start Here */
    $this->load->model("rank_model");
    $this->load->model("department_model");
    
    $str_general = "SELECT vacantsea.*, perusahaan.id_perusahaan, perusahaan.activation_code FROM vacantsea,perusahaan WHERE perusahaan.id_perusahaan = vacantsea.id_perusahaan AND perusahaan.activation_code = 'ACTIVE' AND perusahaan.tampil = 1 AND vacantsea.stat = 'open' ";
    
    $str_vac = "$str_general ORDER BY create_date ASC, vacantsea_id DESC";
    $q_vac = $this->db->query($str_vac);
    $f_vac = $q_vac->result_array();
    
    // GROUP BY RANK
    $str_gvac = "$str_general GROUP BY rank_id ORDER BY create_date ASC, vacantsea_id DESC";
    $q_gvac = $this->db->query($str_gvac);
    $f_gvac = $q_gvac->result_array();
    
    
    $jml_vacantsea = count($f_vac);

    /* Job Statistics End Here */

    /* Seatizen Statisctics Start Here */
    $str_rank = "select * from rank";
    $q_rank = $this->db->query($str_rank);
    $f_rank = $q_rank->result_array();

    $str = "select pms.pelaut_id, rt.rank from pelaut_ms pms join profile_resume_tr rt on rt.pelaut_id = pms.pelaut_id where pms.activation = 'ACTIVE' and pms.`show` = 'TRUE' ";

    $str_order = "$str ORDER BY create_date ASC, pelaut_id DESC";
    $q_order = $this->db->query($str_order);
    $f_order = $q_order->result_array();

    $jml_seatizen = count($f_order);
    /* Seatizen Statistics End Here */
?>
<section>
<div class="container">
    <div class="row title text-center">

            <h3>STATISTICS</h3>

            <h6 class="alt">Here are the Most Popular Categories</h6>

        </div>
    <div class="row">
        <div class="col-md-6">
            <div id="container-chart-job" style="min-width: 310px; height: 400px; margin: 0 auto">
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <center><h4><b>Sorry, your company doesnt have a crew<br>On Leave, On Board, and Applicant</b></h4></center>
            </div>
        </div>
        <div class="col-md-6">
            <div id="container-chart-seatizen" style="min-width: 310px; height: 400px; margin: 0 auto">
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <center><h4><b>Sorry, your company doesnt have a crew<br>On Leave, On Board, and Applicant</b></h4></center>
            </div>
        </div>
    </div>
        </div>
</section>
<div class="container_modal_del"></div>
<script>
// alert("<?php echo date('Y-m-d') ?>");
var jml_vacant_per_rank = new Array();
var jml_seatizen_per_rank = new Array();
   $(function () {
    <?php
        if($jml_seatizen > 0){
            $data_seatizen_per_rank = array();
            foreach ($f_rank as $value) {
                $str_searank = "$str and rt.rank = $value[rank_id]";
                $q_searank = $this->db->query($str_searank);
                $f_searank = $q_searank->result_array();

                if($f_searank == null) continue;

                $jml_searank = count($f_searank);
                $percent = ($jml_searank / $jml_seatizen) * 100;
                echo "jml_seatizen_per_rank['".str_replace(' ', '_', $value['rank'])."'] = $jml_searank;\n";
                $data_seatizen_per_rank[str_replace(' ', '_', $value['rank'])] = $percent;
            }
        }

        if($jml_vacantsea > 0){
            $data_vacant_per_rank = array();
            
            foreach($f_gvac as $row)
            {
                //load
                
                $rank = $this->rank_model->get_rank_detail_byid($row["rank_id"]);
                $department = $this->department_model->get_detail_department($rank["id_department"]);
                
                $str_vacperrank = $str_general." AND rank_id = '$row[rank_id]' ";
                $q_vacperrank = $this->db->query($str_vacperrank);
                $f_vacperrank = $q_vacperrank->result_array();
                
                $jml_vacperrank = count($f_vacperrank);
                $percent = ($jml_vacperrank / $jml_vacantsea) * 100;
                echo "jml_vacant_per_rank['".str_replace(' ', '_', $rank['rank'])."'] = $jml_vacperrank;\n";
                $data_vacant_per_rank[str_replace(' ', '_', $rank['rank'])] = $percent;

            }
            // print_r($data);
        }
            
    ?>

    <?php 
    // print_r($allCrewCompany);
    
    if($jml_seatizen > 0){ ?>
    $('#container-chart-seatizen').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Seatizen'
        },
        tooltip: {
        
            formatter: function () {
                // body...
                var name = this.point.name;
                name_space = name.replace(/\s/g, '_');
                var value = jml_seatizen_per_rank[name_space];
                value = value > 1 ? value+" peoples" : value+" people";
                var pesan = name+": <b>"+value+"</b>";
                // console.log(name+" -> "+name_space);
                return pesan;
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.y:.2f}%',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Total',
            colorByPoint: true,
            data: [
            <?php 
            $z=0;
            $jml_total = count($data_seatizen_per_rank);
            foreach ($data_seatizen_per_rank as $key => $value) {
                $key = str_replace('_', ' ', $key);
                echo "{
                    name : '$key',
                    y : $value
                }";
                if(($jml_total-1) != $z) echo ", ";
                $z++;

            }
            
            ?>
            ]
        }]
    });
    <?php } ?>

    <?php 
    // print_r($allCrewCompany);
    
    if($jml_vacantsea > 0){ ?>
    $('#container-chart-job').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Job'
        },
        tooltip: {
        
            formatter: function () {
                // body...
                var name = this.point.name;
                name_space = name.replace(/\s/g, '_');
                var value = jml_vacant_per_rank[name_space];
                value = value > 1 ? value+" jobs" : value+" job";
                var pesan = name+": <b>"+value+"</b>";
                // console.log(name+" -> "+name_space);
                return pesan;
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.y:.2f}%',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Total',
            colorByPoint: true,
            data: [
            <?php 
            $z=0;
            $jml_total = count($data_vacant_per_rank);
            foreach ($data_vacant_per_rank as $key => $value) {
                $key = str_replace('_', ' ', $key);
                echo "{
                    name : '$key',
                    y : $value
                }";
                if(($jml_total-1) != $z) echo ", ";
                $z++;

            }
            
            ?>
            ]
        }]
    });
    <?php } ?>
});
</script>