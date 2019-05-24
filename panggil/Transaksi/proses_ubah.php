<?php 
require_once 'class.php';
if(ISSET($_POST['update'])){	
	$kd = $_POST['kode'];	
	$nama 	= $_POST['nama'];
	$tgl = $_POST['tgl'];
	$no_polisi = $_POST['no_polisi'];
	$conn = new db_class();
	$conn->update($tgl, $nama, $no_polisi, $kd);
	header('location: ../../index.php?lihat=Transaksi/edit&kd_transaksi='.$kd);
}	
?>