<?php
require_once 'class.php';

// if(ISSET($_POST['submit_jasa'])){
$kode = $_POST['kode'];	
$nama 	= $_POST['nama'];
$tgl = $_POST['tglTrans'];
$noPolisi = $_POST['noKendaraan'];
$conn 		= new db_class();
$conn->create($kode,$tgl, $nama, $noPolisi);

$connect = mysqli_connect("localhost", "root", "", "dbservice");
$number_jasa = count($_POST["jasa"]);
$number_sparepart = count($_POST["sparepart"]);

if($number_jasa >= 1 && $number_sparepart >=1){
	for($i=0; $i<$number_jasa; $i++)
	{
		if(trim($_POST["jasa"][$i] != ''))
		{
			$sql1 = "INSERT INTO transaksi_item (id, no_invoice, kode, jenis_transaksi, jumlah) VALUES('',$kode, ".$_POST["jasa"][$i].",1,1)";
			mysqli_query($connect, $sql1)or die(mysqli_error());
		}
	}
	for($i=0; $i<$number_sparepart; $i++){
		if(trim($_POST["sparepart"][$i] != ''))
		{
			$sql2 = "INSERT INTO transaksi_item (no_invoice, kode, jenis_transaksi, jumlah) VALUES($kode, ".mysqli_real_escape_string($connect, $_POST["sparepart"][$i]).",0,".$_POST["jumlah"][$i].")";
			mysqli_query($connect, $sql2)or die(mysqli_error());
		}
	}
	$jmlSparepart =0;
	$jmlJasa =0;
	$query1 = mysqli_query($connect, "SELECT transaksi_item.no_invoice as trans, transaksi_item.id as id, barang.nm_barang AS nama, barang.harga_jual AS harga, barang.diskon AS diskon, transaksi_item.jumlah as jumlah FROM `transaksi_item` INNER JOIN barang ON transaksi_item.kode = barang.kd_barang where no_invoice = $kode");
	$query2 = mysqli_query($connect, "SELECT transaksi_item.no_invoice as trans, transaksi_item.id as id, jasaservice.nama_jasa AS nama, jasaservice.harga as harga, jasaservice.diskon as diskon FROM `transaksi_item` INNER JOIN jasaservice ON transaksi_item.kode = jasaservice.kd_jasa where no_invoice = $kode");
	while ($row = mysqli_fetch_array($query1)) {
		$jmlSparepart = $jmlSparepart + ($row['harga']-($row['harga']*$row['diskon']/100))*$row['jumlah'];		
	}
	while ($row = mysqli_fetch_array($query2)) {
		$jmlJasa = $jmlJasa + ($row['harga']-($row['harga']*$row['diskon']/100));
	}
	$jmlTotal = $jmlSparepart+$jmlJasa;
	mysqli_query($connect, "Update transaksi set totalharga = $jmlTotal where no_invoice=$kode")or die(mysqli_error());
	echo "Data Transaksi Tersimpan";
}	
else
{
	echo "Data gagal Tersimpan";
}
?>