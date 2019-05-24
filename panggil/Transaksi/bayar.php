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
$queryJumlah = mysqli_fetch_object(mysqli_query($konek, "SELECT count(no_invoice) as jumlah from transaksi_item where no_invoice= $id"));

?>
<div class="container"> 
	<table class="table table-striped">
		<tr>
			<td>Kode Transaksi</td>
			<td><?php echo $fetch['no_invoice']?></td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td><?php echo $fetch['tanggal']?></td>
		</tr>
		<tr>
			<td>Nama Pelanggan</td>
			<td><?php echo $fetch['namaPelanggan']?></td>
		</tr>
		<tr>
			<td>No Kendaraan</td>
			<td><?php echo $fetch['no_polisi']?></td>
		</tr>
	</table>
</div>

<div>
	<!-- <?php echo $queryJumlah->jumlah; ?> -->
	<caption>Sparepart</caption>
	<table class="table table-hover table-bordered" style="margin-top: 10px">
		<tr class="info">
			<th>No</th>
			<th>Keterangan</th>
			<th>Harga</th>
			<th>Diskon</th>
			<th>Jumlah</th>
			<th>Total Harga</th>
		</tr>
		<tbody>
			
			<?php
			$no=1;
			$sparepart = 0;
			$jasa= 0;
			$trans=0;
			echo "<tr><td colspan=6>Sparepart</td></tr>";
			while($tampil = mysqli_fetch_array($querySparepart)){ 
				?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $tampil['nama']?></td>
					<td><?php echo $tampil['harga']?></td>
					<td><?php echo $tampil['diskon']?></td>
					<td><?php echo $tampil['jumlah']?></td>
					<td>
						<?php 
						$sparepart = ($tampil['harga']-($tampil['harga']*$tampil['diskon']/100))*$tampil['jumlah']; 
						echo $sparepart; 
						?>
					</td>
				</tr>
				<?php
				$trans = $trans +$sparepart;
			}
			?>	
			<?php
			echo "<tr><td colspan=6>Jasa</td></tr>";
			while($tampil = mysqli_fetch_array($queryJasa)){ 
				?>

				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $tampil['nama']?></td>
					<td><?php echo $tampil['harga']?></td>
					<td><?php echo $tampil['diskon']?></td>
					<td>-</td>
					<td>
						<?php 
						$jasa = ($tampil['harga']-($tampil['harga']*$tampil['diskon']/100)); 											
						echo $jasa; 
						?>
					</td>
				</tr>
				<?php
				$trans = $trans +$jasa;
			}
			echo "<tr>
			<td colspan=5>Total</td>
			<td>$trans</td>
			</tr>";
			?>	

		</tbody>
	</table>
	<form action="" method="post">
		<input type="submit" name="klik" class="btn btn-large btn-success" value="bayar">
	</form>
	<?php 
	if (isset($_POST['klik'])) {
		mysqli_query($konek, "UPDATE transaksi set status = '1' where no_invoice= $id") or die(mysqli_error());
			// header('location:index.php?lihat=Transaksi/index');
		?>
		<a href="index.php?lihat=Transaksi/index" class="btn btn-danger btn-sm"
			<span class = "glyphicon glyphicon-trash" ></span> Kembali 
		</a>
		<?php
	}
	?>
</div>


