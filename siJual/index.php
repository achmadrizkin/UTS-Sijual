<?php
include "include/config.php";
include "include/koneksi.php";
include "include/lib.php";

//kalo udah login, gak perlu login lagi
if(is_login()){
  header("Location:dashboard.php");
}else{
	header("Location:login.php");
}
?>