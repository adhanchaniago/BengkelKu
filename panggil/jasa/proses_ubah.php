<?php 
require_once 'class.php';
if(ISSET($_POST['update'])){	
	$kd = $_POST['kode'];	
	$nama 	= $_POST['nama'];
	$hargaJual = $_POST['hargaJual'];
	$diskon = $_POST['diskon'];
	$conn = new db_class();
	$conn->update($kd, $nama, $hargaJual, $diskon);
	header('location: ../../index.php?lihat=jasa/index');
}	
?>