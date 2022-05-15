<?php
include "../../include/config.php";
include "../../include/lib.php";
include "../../include/koneksi.php";
include "../../template/header.php";
include "../../template/sidebar.php";
include "../../include/penjualan.class.php";
if(!is_login()){
  header("Location:login.php");
}

$Penjualan = new Penjualan();
//ambil data barang
$listbarang = $Penjualan->getAllBarang();
//ambil data pelanggan
$listdataplg = $Penjualan->getAllPlg();

if(isset($_POST['tblsimpan'])){
	$tgl = $_POST['tgljual'];
	$kdbrg = $_POST['kdbrg'];
	$qty = $_POST['qtyx'];
	$kdplg = $_POST['kdplg'];
	$harga = $_POST['harga'];
	$message = $Penjualan->simpan($tgl,$kdplg,$kdbrg,$qty,$harga);
}

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Form Penjualan</h1>
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
                <h3 class="card-title">Tambah Data Penjualan</h3>
              </div>
               <div class="card-body">
							<?php
							if(isset($message)){
								echo "<p class='informasi text-center bg-".$message[0]."'>".$message[1]."</p>";	
							}
							?>
					<div id='divform'>
  <form class="form-horizontal" role="form" action="" method="post" id='form1' onsubmit="return cekdata()">
				  <div class="form-group">
				    <label for="nama" class="col-sm-3 control-label">Tanggal</label>
				    <div class="col-sm-5">
				      <input type="date" class="form-control" id="tgljual" name="tgljual" placeholder="Tanggal Penjualan" required autofocus >
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="nama" class="col-sm-3 control-label">Pelanggan</label>
				    <div class="col-sm-5">
				      <select name='kdplg' id='kdplg' class='form-control' required>
					  <option value=''></option>
					  
					 <?php foreach($listdataplg as $row):?>
					  <option value='<?php echo $row['kdplg']?>'><?php echo $row['nama'];?></option>
					  <?php endforeach;?>
					  </select>
				    </div>
				  </div>
  <hr>

  <div class='row text-left'>
  <div class='col-sm-12'>
  <button type="button" class='btn btn-primary' onclick='popbarang()'>Pilih Barang</button>
  </div>
  </div>
  <a name='linkdata'></a>
  <table class='table' id='tabeldata'>
  <thead>
  <tr>
  <th>Kode</th>
  <th>Nama Produk</th>
  <th>Qty</th>
  <th>Price (Rp)</th>
  <th>Total (Rp)</th>
  <th>Action</th>
  </tr>
  </thead>
  <tbody></tbody>
  <tfoot>
  <tr>
  <td>&nbsp;</td>
  <td>Total</td>
  <td id='totalqty'></td>
  <td>&nbsp;</td>
  <td id='grandtotal' align="right"></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  </tr>
  </tfoot>
  </table>
  <input type='hidden' id='hidqty' value='0'> <input type='hidden' id='hidgrandtotal' value='0'>
  </div>
  <div class="form-group">
	  <label for="simpan" class="col-sm-3 control-label"></label>
    <div class="col-sm-5">
	  <input type="submit" class="btn btn-primary btn-sm" name="tblsimpan" id="tblsimpan" value="Simpan">
	  <input type="button" class="btn btn-info btn-sm" name="tblreset" id="tblreset" value="Reset" onclick='backbutton()'>
    </div>
  </div>
</form>
</div>
<!-- pop barang-->
<div class="modal fade" id="divpopbarang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog wide-modal">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Pilih Data Barang</h4>
      </div>
      <div class="modal-body">
		<table class="table table-bordered table-condensed table-hover table-striped" id='tabelpopbarang'>
		<thead>
		<tr>
		<th>Kode</th>
		<th>Nama Barang</th>
		<th>Harga</th>
		<th>Stok</th>
		<th>Qty</th>
		</tr>
		</thead>
		<tbody>
		<?php
	 foreach($listbarang as $databarang):
		?>
		<tr>
		<td><?php echo $databarang['idbarang'];?></td>
		<td><?php echo $databarang['nama'];?></td>
		<td class='text-right'><?php echo $databarang['harga'];?></td>
		<td class='text-right'><?php echo $databarang['stok'];?></td>
		<td align='right'><input type='number' width='3' id="qty_<?php echo $databarang['idbarang']?>" max='<?php echo $databarang['stok'];?>' min='0' class='qtypop'></td>
		<td><input type='button' class='btn btn-primary btn-xs' value='Pilih' onclick="inputbarang('<?php echo $databarang['idbarang']?>','<?php echo $databarang['stok']?>')"></td>
		</tr>
		<?php
		endforeach;
		?>
		</tbody>
		</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php
include "../../template/footer.php";
?>

<script src="<?php echo PLUGIN_URL;?>datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo PLUGIN_URL;?>datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo PLUGIN_URL;?>datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo PLUGIN_URL;?>datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script src="<?php echo JS_URL."penjualan.js";?>"></script>

