<?php
	require_once 'class.php';
	
	$id_barang	= $_REQUEST['kd_barang'];
	$conn 		= new db_class();
	$conn->delete($id_barang);
	header('location: index.php?lihat=sparepart/index');
?>