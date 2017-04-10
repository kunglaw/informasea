<?php $this->load->view('css');
$notification_image = [
                                          'ic_notif_friendrequest.png',
                                          'ic_notif_uncomplete.png',
                                          'ic_notif_interview.png'
                                        ]; 
/*
 *
 * Created by PhpStorm.
 * User: a
 * Date: 12/06/2015
 * Time: 20:38
 */
?>

<div class="col-md-9 contactpage seatizen-list-container center-block">
       <br>
    <br>
    <div class="container">
        <h3> Your Notifications </h3>
        <hr>
    </div>
<div class="container">
  <div class="row" style="">
        <div class="col-md-11">
            <table class="table table-hover">
            <?php 
             foreach($notif as $n){ 
              if($n['type'] == "Request Friend"){
                $img = $notification_image[0];
              } else if($n['type'] == "Resume Uncomplete" OR $n['type'] == "Expired certificate"){
                $img = $notification_image[1];
              } else if($n['type'] == "hire crew"){
                $img = $notification_image[2];
              }

                $user = $this->user_model->get_detail_pelaut($n['from_user']);
       


                ?>
             <tr onclick="window.location.href='<?=base_url().$n[url] ?>'"> <td>
              <img class="media-object" src="<?php echo asset_url()."img/".$img;?>" style="float:left; margin-right:10px;">
                <a href="<?php echo $n['url']; ?>"> 
              <?php echo $n['nama_pengirim']." ".$n['description']; ?>  </a> <br>
           <?php 
            $now = new Datetime(date('Y-m-d H:i:s'));
            $tgl = new Datetime($n['datetime']);
            $a = $now->diff($tgl);
            // echo "<b>"; print_r($a); echo "</b>";
            // echo "<br>";
                
            if($a->y ==0 AND $a->m == 0){


            if($a->d == 0){
              
                    if($a->h == 0){
                      
                        if($a->i == 0){
                            echo $a->s ." seconds ago";
                        } else{
                            echo $a->i ." minutes ago";
                        }

                    }else {
                        echo $a->h ." hours ago";
                    }
            } else if($a->d == 1){
                echo "Yesterday";
            } else {
                echo $a->d ." days ago";
            }
             } else if($a->y != 0) {
                echo $a->y ." years ago";
             } else if($a->y == 0 AND $a->m != 0){
                echo $a->m ." month ago";
             }
 
            ?></td></tr>
          <?php   } ?>
         </table>
        </div>


      </div>
  </div>
</div>

<?php 
    //echo $this->output->enable_profiler(TRUE);
$this->load->view("js_under") ?>

