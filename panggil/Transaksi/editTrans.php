<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<style type="text/css">
      body{
        background-color:  #f0f5f5;
        /*background: transparent;*/
      }
      form, table{
      	background-color: white;
      	padding:20px;
      	border-radius: 5px;

      }
    </style>

</body>
</html>
<?php
	//Memgambil id data get dari url
$nama = "";
$query = "";
$con = mysqli_connect("localhost","root","","dbservice");
$jml=1;
$property = "";
if (isset($_REQUEST['kdJasa'])) {
	$nama = "Jasa";
	$id_pinjam = $_REQUEST['kdJasa'];
	$id_trans = $_REQUEST['kd'];
	$query = "select * from jasaservice";
	$fieldkd = "kd_jasa";
	$fieldnm = "nama_jasa";
	$property = "readonly";
	$jml = mysqli_fetch_array(mysqli_query($con, "select jumlah from transaksi_item where id= $id_pinjam"));
	$opsi = mysqli_fetch_array(mysqli_query($con, "SELECT jasaservice.nama_jasa as name, jasaservice.kd_jasa as kode FROM `transaksi_item` INNER JOIN jasaservice on transaksi_item.kode=jasaservice.kd_jasa where id= $id_pinjam "));

}else if (isset($_REQUEST['kdSparepart'])) {
	$nama = "Sparepart";
	$id_pinjam = $_REQUEST['kdSparepart'];
	$id_trans = $_REQUEST['kd'];
	$query = "select * from barang";
	$fieldkd = "kd_barang";
	$fieldnm = "nm_barang";
	$jml = mysqli_fetch_array(mysqli_query($con, "select jumlah from transaksi_item where id= $id_pinjam"));
	$opsi = mysqli_fetch_array(mysqli_query($con, "SELECT barang.nm_barang as name, barang.kd_barang as kode FROM `transaksi_item` INNER JOIN barang on transaksi_item.kode=barang.kd_barang where id= $id_pinjam "));

}
?>
<div class="row">
	<div class="col-lg-6">
		<form action="panggil/Transaksi/proses_ubahTrans.php" method="POST">
			<div class="form-group">
				<label>Kode Trans</label>
				<input type ="text"  value = "<?php echo $id_trans?>" name = "trans" class="form-control" readonly>
			</div>
			<div class="form-group">
				<label>Kode Item</label>
				<input type ="text"  value = "<?php echo $id_pinjam?>" name = "item" class="form-control" readonly>
			</div>
			<select class="form-control" name="sparepart">
				<?php
				$result = mysqli_query($con, $query);
				echo "<option value=".$opsi['kode'].">".$opsi['name']."</option>";
				while($row = mysqli_fetch_assoc($result)){
					echo "<option value=$row[$fieldkd]>$row[$fieldnm]</option>";
				} 
				?>
			</select>
			<div class="form-group">
				<label>jumlah</label>
				<input type ="number"  value = "<?php echo $jml['jumlah']?>" name ="jmlh" class="form-control" <?=$property ?>>
			</div>
			<button class="btn btn-warning" name="update">
				<span class = "glyphicon glyphicon-pencil"></span> Ubah
			</button>

		</form>
	</div>
</div>

