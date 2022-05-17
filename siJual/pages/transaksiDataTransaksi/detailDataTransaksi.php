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

$i = 1;
$Lapjual = new Laporanjual();
//cek apakah ada parameter id, kalo gak ada balikin ke index
if(!isset($_GET['id'])){
	header("location:index.php");
  }else{
	$idbarang = sanitasi_input($_GET['id']);
	$sql = "SELECT transjual.idjual, transjual.kdplg, pelanggan.nama, pelanggan.alamat, transjual.tgl, pelanggan.telp FROM `transjual` INNER JOIN pelanggan ON transjual.kdplg = pelanggan.kdplg WHERE transjual.idjual='$idbarang'";
	$result = mysqli_query($koneksi,$sql);
	$jumlah = mysqli_num_rows($result);
	if($jumlah==0){
	  header("location:index.php");
	}else{
	  $data = mysqli_fetch_assoc($result);
	}
}

$sql1 = "SELECT transjual.tgl, transjual.total, transjual.kdplg, pelanggan.nama, transjual.idjual FROM transjual INNER JOIN pelanggan ON transjual.kdplg = pelanggan.kdplg WHERE transjual.idjual='$idbarang'";
$result1 = mysqli_query($koneksi,$sql1);
$jumlah1 = mysqli_num_rows($result1);
$y = mysqli_fetch_assoc($result1);

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Laporan Detail Data Transaksi</h1>
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
                <h3 class="card-title">Laporan Detail Data Transaksi</h3>
              </div>
               <div class="card-body">
<div id='divform'>
  <form class="form-horizontal" role="form" action="" method="post" id='form1' onsubmit="return cekdata()">
   <div class="form-group">
    <label for="nama" class="col-sm-3 control-label"></label>
    <div class="col-sm-5">
		<div class="form-group">
					<h3><?php echo "<b> Detail Penjualan Kode " . $data['idjual'] . "</b>";?></h3> <br>
					<h7><?php echo "Nama: " .  "<b>" . $data['nama'] . "</b>";?></h7><br>
					<h7><?php echo "Telp: " .  "<b>" . $data['telp'] . "</b>";?></h7><br>
					<h7><?php echo "Alamat: " .  "<b>" . $data['alamat'] . "</b>";?></h7><br>
					<h7><?php echo "Tanggal Transaksi: " .  "<b>" . $data['tgl'] . "</b>";?></h7><br><br><br>
                  </div>
    </div>
  </div>
</div>
<?php
if($i == 1){
	$datalap = $Lapjual->getDataDetilTransaksi($idbarang);
?>
<div class="row">
  <div class="col-lg-12">
	<div class="box">
	  <div id="collapse4" class="body">
	  <div class='table-responsive'>
		<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
		  <thead>
			<tr>
				<th>Nama Barang</th>
			  <th>Qty</th>
			  <th>Harga</th>
			  <th>Total</th>
			</tr>
		  </thead>
		  <tbody>
		  <?php 
		  if(isset($datalap)){
		  foreach($datalap as $index=>$value):
		  ?>
			<tr>
			  <td><?php echo $value['nama'];?></td>
			  <td><?php echo $value['qty'];?></td>
			  <td><?php echo $value['hargajual'];?></td>
			  <td><?php echo $value['hargajual']*$value['qty'];?></td>
			</tr>
			<?php
			endforeach;
			}
			?>
			<tr>
				<th colspan="3">Grand Total</th>
				<th><?php echo $y['total']?></th>
			</tr>
		</tbody>
		</table>
		</div>
	  </div>
	</div>
  </div>
</div><!-- /.row -->
<?php } 

?>
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