<?php
function is_login(){
	//cek ada cookie gak? kalo ada buat jadi session
	if(isset($_COOKIE['userlogin'])){
    		$_SESSION['username'] = $_COOKIE['userlogin'];
    		$_SESSION['is_login'] = true;
    }
    //cek ada session gak? kalo gak ada redirect ke login
	if(!isset($_SESSION['is_login'])){
		return false;
	}else{
		return true;
	}
}

function sanitasi_input($str){
	return htmlspecialchars(strip_tags(addslashes($str)));
}

function waktusekarang(){
	return date('Y-m-d H:i:s');
}
?>