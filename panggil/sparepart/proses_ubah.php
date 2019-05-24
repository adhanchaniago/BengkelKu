<?php 
require_once 'class.php';
if(ISSET($_POST['update'])){	
	$kd = $_POST['kode'];	
	$nama 	= $_POST['nama'];
	$hargaJual = $_POST['hargaJual'];
	$stok 	= $_POST['stok'];
	$diskon = $_POST['diskon'];
	$conn = new db_class();
	$conn->update($kd, $nama, $hargaJual, $diskon,  $stok);
	header('location: ../../index.php?lihat=sparepart/index');
}	
?>