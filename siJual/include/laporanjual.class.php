<?php
class Laporanjual
{
	public $tabel = "transjual";
	public $tabeldetil = "detiljual";
	public $tabelbarang = "barang";
	public $tabelplg = "pelanggan";
	public $sql = "";

	public function __construct(){
		$this->koneksi = mysqli_connect($_ENV['dbhost'],$_ENV['dbuser'],$_ENV['dbpass'],$_ENV['dbname']);
	}
	
	public function getData($tglawal,$tglakhir){
		$this->sql = "SELECT tgl,total,nama FROM ".$this->tabel.",".$this->tabelplg." WHERE tgl>='$tglawal' and tgl <='$tglakhir' and ".$this->tabel.".kdplg=".$this->tabelplg.".kdplg ORDER BY tgl asc";
		//die($this->sql);
		$kueri = mysqli_query($this->koneksi,$this->sql);
		$x = array();
		while($data = mysqli_fetch_array($kueri)){
			//$x[] = array('tgl'=>$data['tgl'],'total'=>$data['total'],'nama'=>$data['nama']);
			$x[] = $data;
		}
		return $x;
	}

	public function getDataTransaksi() {
		$this->sql = "SELECT transjual.tgl, transjual.total, transjual.kdplg, pelanggan.nama, transjual.idjual FROM transjual INNER JOIN pelanggan ON transjual.kdplg = pelanggan.kdplg ORDER BY transjual.total desc";
		//die($this->sql);
		$kueri = mysqli_query($this->koneksi,$this->sql);
		$x = array();
		while($data = mysqli_fetch_array($kueri)){
			//$x[] = array('tgl'=>$data['tgl'],'total'=>$data['total'],'nama'=>$data['nama']);
			$x[] = $data;
		}
		return $x;
	}

	public function getDataDetilTransaksi($idjual) {
		$this->sql = "SELECT transjual.tgl, transjual.kdplg, detiljual.idjual, barang.nama, detiljual.qty, detiljual.hargajual FROM transjual INNER JOIN detiljual ON transjual.idjual = detiljual.idjual INNER JOIN barang ON detiljual.idbarang = barang.idbarang WHERE detiljual.idjual='$idjual'";
		//die($this->sql);
		$kueri = mysqli_query($this->koneksi,$this->sql);
		$x = array();
		while($data = mysqli_fetch_array($kueri)){
			//$x[] = array('tgl'=>$data['tgl'],'total'=>$data['total'],'nama'=>$data['nama']);
			$x[] = $data;
		}
		return $x;
	}
}
?>