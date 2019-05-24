<?php
	require_once 'class.php';
	
	$id_transaksi	= $_REQUEST['kd_transaksi'];
	$conn 		= new db_class();
	$conn->delete($id_transaksi);
	header('location: index.php?lihat=Transaksi/index');
?>