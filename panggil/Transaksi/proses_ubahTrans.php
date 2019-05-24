<?php
$con = mysqli_connect("localhost","root","","dbservice");
if(ISSET($_POST['update'])){	
	$kdTrans = $_POST['trans'];	
	$kdItem = $_POST['item'];	
	$nama 	= $_POST['sparepart'];
	$jumlah = $_POST['jmlh'];
	$query = "UPDATE `transaksi_item` SET `kode` = $nama, `jumlah` = $jumlah WHERE `transaksi_item`.`id` = $kdItem ";
	mysqli_query($con, $query)or die(mysqli_error());
	header('location: ../../index.php?lihat=Transaksi/edit&kd_transaksi='.$kdTrans);
}	
?>