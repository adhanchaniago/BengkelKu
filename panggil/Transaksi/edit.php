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
$link 	= "index.php?lihat=Transaksi/";

	//Memgambil id data get dari url
$id_pinjam = $_REQUEST['kd_transaksi'];
$fetch = $conn->tampil($id_pinjam);
$konek = mysqli_connect("localhost","root","","dbservice");
$id = mysqli_real_escape_string($konek, $id_pinjam);
$querySparepart = mysqli_query($konek, "SELECT transaksi_item.no_invoice as trans, transaksi_item.id as id, barang.nm_barang AS nama, barang.harga_jual AS harga, barang.diskon AS diskon, transaksi_item.jumlah as jumlah FROM `transaksi_item` INNER JOIN barang ON transaksi_item.kode = barang.kd_barang where no_invoice = $id");
$queryJasa = mysqli_query($konek, "SELECT transaksi_item.no_invoice as trans, transaksi_item.id as id, jasaservice.nama_jasa AS nama, jasaservice.harga as harga, jasaservice.diskon as diskon FROM `transaksi_item` INNER JOIN jasaservice ON transaksi_item.kode = jasaservice.kd_jasa where no_invoice = $id");

?>

<div class="row">
	<div class="col-lg-6">
		<form action="panggil/Transaksi/proses_ubah.php" method="POST">
			
			<div class="form-group">
				<label>Kode Transaksi</label>
				<input type ="text"  value = "<?php echo $fetch['no_invoice']?>" name = "kode" class="form-control" readonly>
			</div>
			<div class="form-group">
				<label>Tanggal</label>
				<input type ="date"  value = "<?php echo $fetch['tanggal']?>" name = "tgl" class="form-control" autofocus>
			</div>
			<div class="form-group">
				<label>Nama Pelanggan</label>
				<input type ="text"  value = "<?php echo $fetch['namaPelanggan']?>" name = "nama" class="form-control" >
			</div>
			<div class="form-group">
				<label>No kendaraan</label>
				<input type ="text"  value = "<?php echo $fetch['no_polisi']?>" name = "no_polisi" class="form-control" >
			</div>
			<button class="btn btn-warning" name="update">
				<span class = "glyphicon glyphicon-pencil"></span> Ubah
			</button>
		</form>
	</div>
</div>

<div>
	<table class="table table-hover table-bordered" style="margin-top: 10px">
		<tr class="info">
			<th>No</th>
			<th>Barang</th>
			<th>Harga</th>
			<th>Diskon</th>
			<th>Jumlah</th>
			<th>Aksi</th>
		</tr>
		<tbody>

			<?php
			$no=1;
			while($tampil = mysqli_fetch_array($querySparepart)){ 
				?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $tampil['nama']?></td>
					<td><?php echo $tampil['harga']?></td>
					<td><?php echo $tampil['diskon']?></td>
					<td><?php echo $tampil['jumlah']?></td>
					<td style="text-align: center;">
						<a href="<?= $link.'editTrans&kd='.$tampil['trans'].'&kdSparepart='.$tampil['id'] ?>" class="btn btn-primary btn-sm">
							<span class = "glyphicon glyphicon-edit"></span> Edit
						</a> 
						<a onclick="return confirm('Apakah yakin data akan di hapus?')" href="	<?= $link.'hapusTrans&kd='.$tampil['trans'].'&kdItem='.$tampil['id'] ?>" class="btn btn-danger btn-sm">
							<span class = "glyphicon glyphicon-trash"></span> Hapus
						</a>
					</td>
				</tr>

				<?php
			}
			?>	

		</tbody>
	</table>
</div>

<div>
	<table class="table table-hover table-bordered" style="margin-top: 10px">
		<tr class="info">
			<th>No</th>
			<th>Jasa</th>
			<th>Harga</th>
			<th>Diskon</th>
			<th>Aksi</th>
		</tr>
		<tbody>

			<?php
			$no=1;
			while($tampil = mysqli_fetch_array($queryJasa)){ 
				?>

				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $tampil['nama']?></td>
					<td><?php echo $tampil['harga']?></td>
					<td><?php echo $tampil['diskon']?></td>
					<td style="text-align: center;">
						<a href="<?= $link.'editTrans&kd='.$tampil['trans'].'&kdJasa='.$tampil['id'] ?>" class="btn btn-primary btn-sm">
							<span class = "glyphicon glyphicon-edit"></span> Edit
						</a>  
						<a onclick="return confirm('Apakah yakin data akan di hapus?')" href="	<?= $link.'hapusTrans&kd='.$tampil['trans'].'&kdItem='.$tampil['id'] ?>" class="btn btn-danger btn-sm">
							<span class = "glyphicon glyphicon-trash"></span> Hapus
						</a>
					</td>
				</tr>

				<?php
			}
			?>	

		</tbody>
	</table>
</div>

