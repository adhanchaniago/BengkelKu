<?php
	require_once 'class.php';
	
	$id_jasa	= $_REQUEST['kd_jasa'];
	$conn 		= new db_class();
	$conn->delete($id_jasa);
	header('location: index.php?lihat=jasa/index');
?>