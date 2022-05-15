<?php
include "../../include/config.php";
include "../../include/lib.php";
include "../../include/koneksi.php";
include "../../template/header.php";
include "../../template/sidebar.php";
include "../../include/laporanjual.class.php";
if(!is_login()){
  header("Location:login.php");
}
$Lapjual = new Laporanjual();


?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Laporan Data Transaksi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 text-right">
            <a href="<?php echo BASE_URL;?>pages/transaksipenjualan/index.php" class="btn btn-primary align-right"><i class="fa fa-plus"></i>&nbsp;Reset Form</a>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

  <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      	 <div class="row">
         <div class="col-12">
         	 <div class="card">
              <div class="card-header">
                <h3 class="card-title">Pilih Periode</h3>
              </div>
               <div class="card-body">
<div id='divform'>
  <form class="form-horizontal" role="form" action="" method="post" id='form1' onsubmit="return cekdata()">
   <div class="form-group">
    <label for="nama" class="col-sm-3 control-label"></label>
    <div class="col-sm-5">
     <input type="submit" class="btn btn-primary" value="Cetak" name="cetak" id="cetak"> 
	 <input type="reset" class="btn btn-info" name="tblreset" id="tblreset" value="Reset">
    </div>
  </div>
</div>
<?php
if(isset($_POST['cetak'])){
	$datalap = $Lapjual->getDataTransaksi();
?>
<div class="row">
  <div class="col-lg-12">
	<div class="box">
	  <header>
		<div class="icons">
		  <i class="fa fa-table"></i>
		</div>
		<h5>Data Laporan Data Transaksi</h5>
	  </header>
	  <div id="collapse4" class="body">
	  <div class='table-responsive'>
		<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
		  <thead>
			<tr>
				<th>Kode Penjualan</th>
			  <th>Tgl Penjualan</th>
			  <th>Pelanggan</th>
			  <th>Total</th>
			</tr>
		  </thead>
		  <tbody>
		  <?php 
		  if(isset($datalap)){
		  foreach($datalap as $index=>$value):
		  ?>
			<tr>
				<td><?php echo $value['idjual'];?></td>
			  <td><?php echo $value['tgl'];?></td>
			  <td><?php echo $value['nama'];?></td>
			  <td align='right'><?php echo $value['total'];?></td>
			</tr>
			<?php
			endforeach;
			}
			?>
		</tbody>
		</table>
		</div>
	  </div>
	</div>
  </div>
</div><!-- /.row -->
<?php } ?>
<?php
include "../../template/footer.php";
?>
<script>
$(document).ready(function(){
	
});


function cekdata(){
	if($('#tglawal').val()=='' || $('#tglakhir').val()==''){
		alert("Tanggal Awal dan Akhir belum diisi");
		return false;
	}else{
		return true;
	}
}
</script>
  

