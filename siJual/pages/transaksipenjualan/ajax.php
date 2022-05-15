<?php
include "../../include/config.php";
include "../../include/koneksi.php";

if(isset($_POST['req'])){
	if($_POST['req']=='brg'){
		$idbrg = $_POST['id'];
		//ambil data barang
		$sql = "SELECT * FROM barang WHERE idbarang='$idbrg'";
  		$result = mysqli_query($koneksi,$sql);
  		 $data = mysqli_fetch_assoc($result);
		echo json_encode($data);
		exit;
	}
}
?>