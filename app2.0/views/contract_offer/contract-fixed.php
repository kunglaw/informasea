
<center style="margin-top: -90px"> 
                <h2 style="color:#337AB7"> Kontrak Kerja Sama</h2>
                <!-- <h4 style="color:#337AB7; "> Informasea.com </h4>  -->
            </center>
            <br>
            <br>
            <br>
<p>Yang bertanda tangan di bawah ini</p> 
<br>
<table style="margin-left: 30px;">
    <tr>
        <td width="200">Nama Perusahaan</td>
        <td width="20">:</td>
        <td><?php echo $dt_contract['nama_perusahaan'] ?></td>
    </tr>
    <tr>
        <td>Alamat Perusahaan</td>
        <td>:</td>
        <td><?php echo $dt_contract['alamat_perusahaan'] ?></td>
    </tr>
    <tr>
        <td>Telepon Perusahaan</td>
        <td>:</td>
        <td><?php echo $dt_contract['telp'] ?></td>
    </tr>
    <tr>
        <td>Penanggung Jawab</td>
        <td>:</td>
        <td><?php echo $dt_contract['nama_pic'] ?></td>
    </tr>
    <tr>
        <td>Jabatan</td>
        <td>:</td>
        <td><?php echo $dt_contract['jabatan_pic'] ?></td>
    </tr>
</table>
<br>
<p>Selanjutnya akan disebut sebagai <b>PIHAK PERTAMA</b></p>
<br>
<table style="margin-left: 30px;">
    <tr>
        <td width="200">Nama Perusahaan</td>
        <td width="20">:</td>
        <td>Informasea.com</td>
    </tr>
    <tr>
        <td>Alamat Perusahaan</td>
        <td>:</td>
        <td>Jl. Pinang Raya no xxx</td>
    </tr>
    <tr>
        <td>Telepon Perusahaan</td>
        <td>:</td>
        <td>08945223658</td>
    </tr>
    <tr>
        <td>Penanggung Jawab</td>
        <td>:</td>
        <td>Rifal Qori Kurniawan</td>
    </tr>
    <tr>
        <td>Jabatan</td>
        <td>:</td>
        <td>Founder</td>
    </tr>
</table>
<br>
<p>Selanjutnya akan disebut sebagai <b>PIHAK KEDUA</b></p>
<br>

<p>Untuk selanjutnya antara <b>PIHAK PERTAMA</b> dan <b>PIHAK KEDUA</b> memiliki perjanjian kerjasama dengan ketentuan sebagai berikut:</p>
<br>
<?php echo $dt_contract['content'] ?>

<br>
<br>
<p>Kami yakin dapat memberikan <?php echo $dt_contract['nama_perusahaan'] ?> lebih banyak pilihan dalam proses hiring crew sehingga <?php echo $dt_contract['nama_perusahaan'] ?> memiliki peluang yang lebih besar untuk menemukan crew yang kompeten.</p>
<br>
<p>Demikian perjajian kerjasama ini kami buat untuk menjadi ikatan diantara kami. Segala hal yang belum termuat pada perjajian ini, dibicarakan bersama antara pihak pertama dan pihak kedua untuk mencapai mufakat dikemudian hari dan otomatis menjadi addendum pada perjanjian ini.</p>
<br>
<p>Perjanjian ini kami buat secara penuh kesadaran dan tanpa paksaan dari manapun. Jika terjadi perselisihan pada pelaksanaan perjanjian ini, maka kami sepakat menyelesaikannya dengan cara kekeluargaan dan musyawarah, namun jika tidak terselesaikan juga, kami sepakat menyelesaikan secara hukum yang berlaku.</p>
<br>
<br>
<br>
<!-- <span style="text-align:right"> -->
<?php
    
    $array_hari = array(1=>"Senin","Selasa","Rabu","Kamis","Jumat", "Sabtu","Minggu");
    $hari = $array_hari[date("N")];
?>
<p align="left">
    kontrak ini dibuat pada hari <?=$hari?>, tanggal <?=date("d")?> , bulan <?php echo date('m') ?>, tahun <?php echo date('Y') ?>
</p>
<br>
<br>
<br>
<div style="width:50%; float: left">
<center>
    <p>PIHAK PERTAMA</p>
    <br>
    <br>
    <br>
    <br>
    <p><?php echo $dt_contract['nama_pic'] ?></p>
    <p><?php echo $dt_contract['nama_perusahaan'] ?></p>
    </center>
</div>
    <div style="width:50%;float: left">
    <center>
        <p>PIHAK KEDUA</p>
        <br>
        <br>
        <br>
        <br>
        <p>Rifal Qori Kurniawan</p>
        <p>Founder Informasea.com</p>
        </center>
    </div>

    <br>
    <br>
    <br>
<!-- </span> -->
<center style="margin-top: 200px;">
<?php if(!$agree){ ?>
<button id="back-to-nego" class="btn btn-default" style="font-size: 14pt;">Back</button>
<?php } ?>
<a href="<?=base_url("contract/print_contract/?id=$dt_contract[id_contract]&t=$t")?>" target="_blank">
	<button class="btn btn-success" style="font-size: 16pt;">Agree and Print</button>
</a>
</center>

<script type="text/javascript">
    $("#back-to-nego").click(function () {
        // body...
        $("#form-fix").hide('fast');
        $("#frm-nego").show('fast');
    })
</script>