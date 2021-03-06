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

// get data gramd total
$sql = "SELECT SUM(transjual.total) AS GrandTotal FROM transjual";
$result = mysqli_query($koneksi,$sql);
$jumlah = mysqli_num_rows($result);
$y = mysqli_fetch_assoc($result);
	
$i = 1;
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
                <h3 class="card-title">Data Transaksi Keseluruhan</h3>
              </div>
               <div class="card-body">
<div id='divform'>
  <form class="form-horizontal" role="form" action="" method="post" id='form1' onsubmit="return cekdata()">
   <div class="form-group">
    <label for="nama" class="col-sm-3 control-label"></label>
    <div class="col-sm-5">
    </div>
  </div>
</div>
<?php
if($i){
	$datalap = $Lapjual->getDataTransaksi();
?>
<div class="row">
  <div class="col-lg-12">
	<div class="box">
	  <header>
		<h5>Laporan Penjualan</h5>
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
				<td><a href="<?php echo BASE_URL;?>pages/transaksiDataTransaksi/detailDataTransaksi.php?id=<?php echo $value['idjual'];?>"><i><?php echo $value['idjual'];?></i></a> 
				<!-- <td><a href="<?php echo BASE_URL;?>pages/transaksiDataTransaksi/detailDataTransaksi.php?id="><i></i>&nbsp;<?php echo $value['idjual'];?></a></td> -->
			  <td><?php echo $value['tgl'];?></td>
			  <td><?php echo $value['nama'];?></td>
			  <td align='right'><?php echo $value['total'];?></td>
			</tr>
			<?php
			endforeach;
			}
			?>
			<tr>
				<th colspan="3">Grand Total</th>
				<th><?php echo $y['GrandTotal'];?></th>
			</tr>
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
  

