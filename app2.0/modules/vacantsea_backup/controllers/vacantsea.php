<?php if(!defined('BASEPATH')) exit('No direct script access allowed ');

// controller vacantsea , module vacantsea 

class Vacantsea extends MX_Controller
{

    function __construct(){

        parent::__construct();
        // authentification
        //$this->session->all_userdata(); exit;
        $username = $this->session->userdata('username');
        $user = $this->session->userdata("user");

        $this->load->model('vacantsea_model');
        $this->load->model('department_model');
        $this->load->model('authentification_model');
        $this->load->model('rank_model');
        $this->load->model('users/user_model');
    }

    function next_id($keterangan)
    {
        $id_terakhir = $this->input->post("id_terakhir");
        $data['vacantsea'] = $keterangan == "next" ? $this->vacantsea_model->get_vacantsea_panel_plus($id_terakhir) : $this->vacantsea_model->get_vacantsea_panel_minus($id_terakhir);
        $data['vacantsea'] = $keterangan != "next" ? array_reverse($data['vacantsea']): $data['vacantsea'];
        $x=0;
        $id_awal=0;
        foreach($data['vacantsea'] as $row) {
            if($x==0) $id_awal = $row['vacantsea_id'];
            $id_terakhir = $row['vacantsea_id'];
            $x++;
        }
        echo $id_awal."&".$id_terakhir;
    }

    function next_data($keterangan)
    {
        $data['title']	= "Vacantsea";
        $data['template'] = "template";
        $id_terakhir = $this->input->post("id_terakhir");

        $data['vacantsea'] = $keterangan == "next" ? $this->vacantsea_model->get_vacantsea_panel_plus($id_terakhir) : $this->vacantsea_model->get_vacantsea_panel_minus($id_terakhir);
        $data['vacantsea'] = $keterangan != "next" ? array_reverse($data['vacantsea']): $data['vacantsea'];
        $this->load->view("content-item",$data);
    }

    function getData()
    {
        $id_dept = $this->input->post("id_dept");
        $id_rank = $this->input->post("id_rank");
        $data_dept = !empty($id_dept) ? $this->department_model->get_detail_department($id_dept):"";
        $data_rank = !empty($id_rank) ? $this->rank_model->get_rank_detail($id_rank):"";
        echo $data_dept['department']."&".$data_rank["rank"];
    }

    function list_department(){
        $data["dept_jx"] = $this->department_model->get_department();
        $this->load->view("list_dept",$data);
    }

    function list_rank(){
        $id_dept = $this->input->post("id_department");
        $data["rank_jx"] = $this->rank_model->get_rank_bydept($id_dept);
        $this->load->view("list_rank",$data);
    }

    function cobacobasince()
    {
        $date_db = $this->input->post("z");
        $this->load->helper("date_format_helper");

        echo $this->input->post("z")." hei";
        $results = since($date_db);
        $data['results'] = $results;
    }

    function search(){
//        if($this->uri->segment(5) == "")echo "null yang ke 5";
//        if($this->uri->segment(4) == "")echo "null yang ke 4";

        $segment1 = $this->uri->segment(3); /* Department Name */
        $segment2 = $this->uri->segment(4); /* Rank Name */
        $segment3 = $this->uri->segment(5); /* Keyword */


        $data_dept = $this->department_model->get_detail_department_by_name($segment1);
        $data_rank = $this->rank_model->get_rank_detail_by_rank($segment2);

//        echo strpos($segment1, "Security");
        if(strpos($segment1, "%60"))
        {
            $segment1 = str_replace('%60','',$segment1);
            $data["vacantsea"] = $this->vacantsea_model->getSearchVacant($segment1);
            $data['total_vacant'] = $this->vacantsea_model->getSearchVacant($segment1,true);
        }
        $segment1 = strpos($segment1, "Security") ? $segment1 : str_replace('-',' ',$segment1);
        if(strpos($segment2, "%60"))
        {
            $segment2 = str_replace('%60','',$segment2);
            $data["dept_search"] = $this->department_model->get_detail_department_by_name($segment1);
            $data["vacantsea"] = $this->vacantsea_model->getSearchVacant($segment2, $data["dept_search"]["department_id"]);
            $data["total_vacant"] = $this->vacantsea_model->getSearchVacant($segment2, $data["dept_search"]["department_id"],true);
        }
        if(strpos($segment3, "%60") && $segment3 != "")
        {
            $segment2 = str_replace('-',' ',$segment2);
            $segment3 = str_replace('%60','',$segment3);
            $data["dept_search"] = $this->department_model->get_detail_department_by_name($segment1);
            $data["rank_search"] = $this->rank_model->get_rank_detail($segment2);
            $data["vacantsea"] = $this->vacantsea_model->getSearchVacant($segment3,$data["dept_search"]["department_id"], $data["rank_search"]["rank_id"]);
            $data["total_vacant"] = $this->vacantsea_model->getSearchVacant($segment3,$data["dept_search"]["department_id"], $data["rank_search"]["rank_id"],true);
        }
        $data['page'] = "search";
        $this->directPage($data);
    }

    // $keyword, $department, $rank_id, $ship_type;

    function searching()
    {
//        echo "searching";
        $department_name = str_replace('%20',' ', $this->uri->segment(3));
        $rank = str_replace('-',' ',$this->uri->segment(4));
        $rank_data = $this->rank_model->get_rank_detail_by_rank($rank);
        $dept_id = $this->department_model->get_detail_department_by_name($department_name);

        // if(empty($sallary)) echo "sallary kosong".$department_name;
        $keyword = $this->input->post("keyword", true);
        $keyword = empty($keyword) ? "department":$keyword;
        $page = $this->input->post("page", true);
        $page = empty($page) ? "search_vacant":$page;
//        echo $department_name." - ".$rank." -> ".$keyword."<br>";
        $data['keyword'] = $keyword;
        $data['department_id'] = $dept_id['department_id'];
        $data['rank_id'] = empty($rank) ? $this->input->post("rank", true):$rank_data['rank_id'];
        $data['page'] = $page;
        $data['sallary'] = empty($sallary) ? $this->input->post("sallary", true):$sallary;
        $data['dept_name'] = $this->department_model->get_detail_department($data['department_id']);
// print_r($data);
        $this->directPage($data);
    }

    function index()
    {
        $data['page'] = "";
        $data['keyword'] = "";
        $sess_data = $this->session->all_userdata();

        $data["vacantsea"] = $this->vacantsea_model->get_vacantsea_panel();
        $vacant = $this->vacantsea_model->get_vacantsea_panel(true);
        if(empty($sess_data)){
            /* Untuk konten Free Akses Di mulai di sini */
        }
        else
        {
            /* Untuk konten Login Di mulai di sini */
            $data["pelaut"] = $this->user_model->get_detail_pelaut_byid($sess_data["id_user"]);
            $data["rank_pelaut"] = $this->rank_model->get_rank_bydept($data["pelaut"]["department"]);
            $data["vacantsea"] = empty($data["rank_pelaut"]) ? $this->vacantsea_model->get_vacantsea_panel() : $this->vacantsea_model->get_vacantsea_panelbydept($data["pelaut"]["department"]);
            $vacant = empty($data["rank_pelaut"]) ? $this->vacantsea_model->get_vacantsea_panel(true) : $this->vacantsea_model->get_vacantsea_panelbydept($data["pelaut"]["department"],true);

        }

        $data["total_vacant"] = count($vacant);
        foreach($vacant as $row) $data['id_paling_akhir'] = $row['vacantsea_id'];
        foreach ($data['vacantsea'] as $row) $data['id_pertama'] = $row['vacantsea_id'];

        $this->directPage($data);
    }

    protected function directPage($data="")
    {
        $data['title']	= "Vacantsea";
        $data['template'] = "template";

        $data['ship_type'] = $this->vacantsea_model->call_ship_type();
        $data['department'] = $this->vacantsea_model->call_department();
        $data['rank'] = $this->vacantsea_model->call_rank();
        $data['coc'] = $this->vacantsea_model->call_coc();

        $this->load->view('index',$data);
    }

    function detail()
    {
//        $this->authentification_model->close_access();
        $this->load->model("department_model");
        $this->load->model('rank_model');
        $this->load->model('vessel_model');
        $this->load->model('nation_model');
        $this->load->model('ship_model');

        $segment3 = $this->uri->segment(3); // id

        $data['vacantsea'] = $this->vacantsea_model->detail_vacantsea($segment3);

        $data['title'] = ucfirst($data['vacantsea']['vacantsea']);
        $data['template'] = "vacantsea_detail/template_detail"; // punya detail
        $id_perusahaan = $data['vacantsea']['id_perusahaan'];
        $data['company'] = $this->vacantsea_model->get_data_perusahaan($id_perusahaan);
        $data["nationality"] = $this->nation_model->get_detail_nationality($data["company"]["id_nationality"]);
        $data["department"] = $this->department_model->get_detail_department($data["vacantsea"]["department"]);
        $data["rank"] = $this->rank_model->get_rank_detail($data["vacantsea"]["rank_id"]);
        $data["ship_type"] = $this->ship_model->get_ships_type($data["vacantsea"]["ship_type"]);
        $data["ship"] = $this->ship_model->get_detail_ship($data["vacantsea"]["ship"]);

        $this->load->view('index',$data);
    }

    function apply()
    {
        $this->authentification_model->close_access();

        // harus login terlebih dahulu

        $this->load->model("department_model");
        $this->load->model('rank_model');
        $this->load->model('vessel_model');
        $this->load->model('nation_model');
        $this->load->model('seaman/resume_model');

        $pelaut_id = $this->session->userdata("id_user");

        $segment2 = $this->uri->segment(3); // id
        $segment3 = $this->uri->segment(4); // title

        $data['vacantsea'] = $this->vacantsea_model->detail_vacantsea($segment2);
        $data['profile_resume'] = $this->resume_model->get_profile_resume($pelaut_id);

        $data['title'] = $data['vacantsea']['vacantsea'];

        //$data['css'] = "apply/head_detail"; // punya detail
        // content
        $data['template'] = "apply_vacantsea/template"; // punya detail
        //$data['include'] = "content/vacatsea/detail"; // detail content yang ada di vacantsea

        //data dari tabel perusahaan
        $id_perusahaan = $data['vacantsea']['id_perusahaan'];
        $data['company'] = $this->vacantsea_model->get_data_perusahaan($id_perusahaan);

        //data array tiap vacantsea
        $data['perusahaan'] = $data['vacantsea']['perusahaan'];

        $this->load->view('index',$data);
    }

    function list_applicant()
    {
        $this->authentification_model->close_access();

        $this->load->model("seaman/resume_model");

        $id_vacantsea = $this->input->post("id_vacantsea");
        $id_pelaut 	= $this->input->post("id_pelaut");
        /* view melalui ajax */
        $data['list_applicant'] = $this->vacantsea_model->applicant_vacantsea($id_vacantsea,$id_pelaut);
        $data['vacantsea']	  = $this->vacantsea_model->detail_vacantsea($id_vacantsea);
        //$data['resume']		 = $this->resume_model->get_resume();

        $this->load->view('list-applicant/list-applicant',$data);
    }

    function test_list_applicant()
    {
        $this->authentification_model->close_access();

        $this->load->view('list-applicant/list-applicant-bak');
    }

    function applied_job()
    {
        $this->authentification_model->close_access();

        $this->load->model('photo/photo_mdl');
        $this->load->model('company/company_model');
        $id_user = $this->session->userdata("id_user");

        $data['title'] = "Applied Job";
        $data['applied_job'] = $this->vacantsea_model->list_applied($id_user);
        $data['template'] = "applied-list-new/template";
        $this->load->view('index',$data);
    }

    function apply_submit()
    {
        $this->authentification_model->close_access();

        $username =  $this->session->userdata("username");
        if(!isset($username) || $username == "")
        {
            header("location:".base_url());
        }
        else
        {
            $this->vacantsea_model->insert_applicant();
            //header("location:".base_url("vacantsea"));
        }
    }

    function search_vacantsea()
    {
        $this->authentification_model->close_access();

        $dt = explode(',', $this->input->post('x'));
        $keyword = $dt[1];
        $department = $dt[2];
        $rank_id = $dt[3];
        $ship_type = $dt[4];
        $page = $dt[5];
        $coc_class = $dt[6];
        $sallary = $dt[7];
//        echo ""
        if(empty($keyword) && empty($department) && empty($rank_id) && empty($ship_type) && empty($coc_class) && empty($sallary))
        {
            $this->index();
        }
        else
        {
            if($this->input->post('x') != 1)
            {
                header("location:".base_url());
            }
            // echo "<br>test".$keyword;
            $data['keyword'] 	= $keyword;
            $data['department_id'] = $department;
            $data['rank_id']	= $rank_id;
            $data['ship_type']  = $ship_type;
            $data['page']	   	= $page;
            $data['coc_class']	= $coc_class;
            $data['sallary']	= $sallary;
            // echo $data['keyword'];
            $data['job'] = $this->vacantsea_model->search_vacantsea($keyword, $department, $rank_id, $ship_type);
            // print_r($data['hasil']);
            // $data['job'] = $data['hasil']['job'];

            // print_r($data);
            // echo $data['keyword']." testing ";
            $this->load->view('list_vacantsea',$data);
        }
    }

    function search_vacantsea_plus()
    {
        // echo "test";
        $this->authentification_model->close_access();

        //echo "search vacantsea plus ... "; exit;
        $keyword = $this->input->post('keyword');
        $sallary = $this->input->post('sallary');
        $ship_type = $this->input->post('ship_type');
        $department = $this->input->post('department');
        $rank_id = $this->input->post('rank_id');
        $coc_class = $this->input->post('coc_class');

        $vacantsea_id = $this->input->post('vacantsea_id');
        $jml_setting = $this->input->post('jml_setting');

        // echo $keyword." - ".$vacantsea_id." = ".$jml_setting;

        if($this->input->post('x') != 1)
        {
            header("location:".base_url());
        }
        // echo "Hallo";
        $data['job_plus'] = $this->vacantsea_model->search_vacantsea_plus($keyword, $department, $rank_id, $ship_type, $vacantsea_id, $jml_setting);
        // print_r($data);
        $data['uri'] = $this->input->post('uri');

        $data['keyword'] 	= $keyword;
        $data['department_id'] = $department;
        $data['rank_id']	= $rank_id;
        $data['ship_type']  = $ship_type;
        $data['page']	   = $page;
        // print_r($data);
        $this->load->view('list_vacantsea_plus',$data);

    }

    /* =================================================================== */

    function get_list_vacantsea()
    {
        $this->authentification_model->close_access();
        $username = $this->session->userdata("username");

        //echo "coba dong";exit;
        if($this->input->post('x') != 1)
        {
            header("location:".base_url());
        }
        // echo "hallo";
        $data['job'] = $this->vacantsea_model->vacantsea_limit();
        $data['department'] = $this->vacantsea_model->department_list();

        if(!empty($username))
        {
            $data['user'] = $this->user_model->get_detail_pelaut($username);
            $data['job'] = $this->vacantsea_model->vacantsea_limit_by_department($data['user']['department']);
        }

        // $data['rank'] = $this->vacantsea_model->rank_department($data['department'][0]['department_id']);
        // print_r($data['rank']);
        // echo $data['rank'][0]['rank'];
        // print_r($data['department']);
        // print_r($data);
        // echo $data['department'][0]['department_id'];
//        echo $data['user']['department'];
        $this->load->view('list_vacantsea',$data);
    }

    function get_list_vacantsea_plus()
    {
        $this->authentification_model->close_access();

        $data['job_plus'] = $this->vacantsea_model->vacantsea_limit_plus();
        $data['uri'] = $this->input->post('uri');

        $this->load->view('list_vacantsea_plus',$data);

    }

    function rank_ajax()
    {
        $this->authentification_model->close_access();

        $data['rank'] = $this->vacantsea_model->call_rank();
        $this->load->view("list_rank",$data);
    }

    function get_coc_class()
    {
        $this->authentification_model->close_access();

        $this->load->model("coc_model");

        $id = $this->input->post("department_id");

        $coc = $this->coc_model->get_coc_bydept($id);

        if(!empty($coc))
        {
            foreach($coc as $row)
            {
                echo "<option value='$row[id_coc_class]' >$row[coc_class]</option>";
            }
        }
        else
        {
            echo "<option value='0' >- Other -</option>";

        }
    }

    function get_rank()
    {
        $this->authentification_model->close_access();

        $this->load->model("rank_model");

        $id = $this->input->post("department_id");

        $rank = $this->rank_model->get_rank_bydept($id);


        if(!empty($rank))
        {
            foreach($rank as $row)
            {
                echo "<option value='$row[rank_id]' >$row[rank]</option>";
            }
        }
        else
        {
            echo "<option value='0' >- Other -</option>";

        }
    }

    function __desturct(){}

}



?>