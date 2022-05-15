<?php
include "../../include/config.php";
include "../../include/lib.php";
include "../../include/koneksi.php";

//cek apakah ada parameter id, kalo gak ada balikin ke index
if(!isset($_GET['id'])){
  header("location:index.php");
}else{
  $idbarang = sanitasi_input($_GET['id']);
  $sql = "DELETE FROM barang WHERE idbarang='$idbarang'";
  $result = mysqli_query($koneksi,$sql);
  if($result){
    header("Location:index.php");
  }
}