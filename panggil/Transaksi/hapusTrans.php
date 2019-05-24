<?php
	require_once 'class.php';
	$kdItem = $_REQUEST['kdItem'];
	$id_transaksi	= $_REQUEST['kd'];
	$conn 		= new db_class();
	echo $kdItem;
	echo $id_transaksi;
	$conn->deleteTrans($kdItem);
		header('location: index.php?lihat=Transaksi/edit&kd_transaksi='.$id_transaksi);

?>