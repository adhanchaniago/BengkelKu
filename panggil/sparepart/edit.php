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
require_once 'class.php';
$conn = new db_class();

	//Memgambil id data get dari url
$id_pinjam = $_REQUEST['kd_barang'];
$fetch = $conn->tampil($id_pinjam);
?>

<div class="row">
	<div class="col-lg-6">
		<form action="panggil/sparepart/proses_ubah.php" method="POST">
			
			<div class="form-group">
				<label>Kode Barang</label>
				<input type ="text"  value = "<?php echo $fetch['kd_barang']?>" name = "kode" class="form-control" readonly>
			</div>
			<div class="form-group">
				<label>Nama Barang</label>
				<input type ="text"  value = "<?php echo $fetch['nm_barang']?>" name = "nama" class="form-control" autofocus required>
			</div>
			<div class="form-group">
				<label>Harga Jual</label>
				<input type ="number"  value = "<?php echo $fetch['harga_jual']?>" name = "hargaJual" class="form-control" required min='5000'>
			</div>
			<div class="form-group">
				<label>Diskon</label>
				<input type ="number"  value = "<?php echo $fetch['diskon']?>" name = "diskon" class="form-control"  required min='0'>
			</div>
			<div class="form-group">
				<label>Stok</label>
				<input type ="number"  value = "<?php echo $fetch['stok']?>" name = "stok" class="form-control" required min='1'>
			</div>
			
			<button class="btn btn-warning" name="update">
				<span class = "glyphicon glyphicon-pencil"></span> Ubah
			</button>

		</form>
	</div>
</div>

