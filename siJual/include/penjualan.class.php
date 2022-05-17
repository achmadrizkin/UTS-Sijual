<?php
class Penjualan
{
	public $tabel = "transjual";
	public $tabeldetil = "detiljual";
	public $tabelbarang = "barang";
	public $tabelplg = "pelanggan";
	public $sql = "";

	public function __construct(){
		$this->koneksi = mysqli_connect($_ENV['dbhost'],$_ENV['dbuser'],$_ENV['dbpass'],$_ENV['dbname']);
	}

	public function simpan($tgl,$kdplg,$kdbrg,$qty,$harga){
//	print_r($qty);
	//cari idjual terakhir + 1;
		$this->sql = "SELECT * from ".$this->tabel;
		$kueri = mysqli_query($this->koneksi,$this->sql);
		if(mysqli_num_rows($kueri)==0){
			$kodejual = "1";
		}else{
			$this->sql = "SELECT max(idjual) as kode FROM ".$this->tabel;
			$kueri = mysqli_query($this->koneksi,$this->sql);
			$data = mysqli_fetch_array($kueri);
			$x = $data['kode'];
			$kodejual = $x + 1;
		}
		$total = 0;
		//hitung totalnya berapa?
		foreach($kdbrg as $index=>$value){
			$idbarang = $value;
			$qtyx = $qty[$index];
			$hargax= $harga[$index];
			$this->sql = "INSERT INTO ".$this->tabeldetil."(idjual,idbarang,qty,hargajual) values('".$kodejual."','".$idbarang."','".$qtyx."','".$hargax."')";
			mysqli_query($this->koneksi,$this->sql);
			$total = $total + ($qtyx*$hargax);
		}
//simpan ke transjual
		$this->sql = "insert into ".$this->tabel."(idjual,kdplg,tgl,total) values('".$kodejual."','".$kdplg."','".$tgl."','".$total."') ";
		$kueri = mysqli_query($this->koneksi,$this->sql);
		if(!$kueri){
			return array('danger',mysqli_error());
		}else{
			return array('success',"Data berhasil disimpan");
		}
	}
	public function getAllBarang(){
		$this->sql = "SELECT * FROM ".$this->tabelbarang." ORDER BY idbarang asc";
		$kueri = mysqli_query($this->koneksi, $this->sql);
		$x = array();
		while($data = mysqli_fetch_array($kueri)){
			$x[] = $data;
		}
		return $x;
	}
	public function getAllPlg(){
		$this->sql = "SELECT kdplg,nama FROM ".$this->tabelplg." ORDER BY nama asc";
		$kueri = mysqli_query($this->koneksi,$this->sql);
		$x = array();
		while($data = mysqli_fetch_array($kueri)){
			//$x[] = array('kdplg'=>$data['kdplg'],'nama'=>$data['nama']);
			$x[] = $data;
		}
		return $x;
	}
}
?>