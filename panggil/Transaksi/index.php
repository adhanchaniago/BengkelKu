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
	require 'class.php';
	$conn = new db_class();
	$read = $conn->read();
	$link 	= "index.php?lihat=Transaksi/";
	?>

	<div class = "row">	
		<div class = "col-lg-12">
			<h3 class = "text-primary">Master Transaksi</h3>
			<hr style = "border-top:1px dotted #000;"/>
			<h4>Transaksi</h4>

			<!-- =====PILIH JASA================= -->
			<div class="container">
				<div class="form-group">
					<form name="add_name_Jasa" id="add_name_Jasa">
						<div class="form-group">
							<label>Kode Transaksi</label>
							<input type ="text" name = "kode" class="form-control" value="<?php echo date('dhis'); ?>" readonly>
						</div>
						<div class="form-group">
							<label>Tanggal Transaksi</label>
							<input type ="date" name = "tglTrans" class="form-control" autofocus>
						</div>
						<div class="form-group">
							<label>Nama</label>
							<input type ="text"  name = "nama" class="form-control" autofocus>
						</div>
						<div class="form-group">
							<label>No Kendaraan</label>
							<input type ="text" name = "noKendaraan" class="form-control" >
						</div>
						<div class="table-responsive">
							<table class="table table-bordered" id="dynamic_field_Jasa">
								<tr>
									<th>Jasa</th>
									<th>Action</th>
								</tr>
								<tr>
									<td>
										<select class="form-control" name="jasa[]">
											<?php
											$con = mysqli_connect("localhost","root","","dbservice");
											$result = mysqli_query($con,"select * from jasaservice");
											while($row = mysqli_fetch_assoc($result)){
												echo "<option value=$row[kd_jasa]>$row[nama_jasa]</option>";
											} 
											?>
										</select>
									</td>
									<td><button type="button" name="add_jasa" id="add_jasa" class="btn btn-success">+</button></td>
								</tr>
							</table>
							<table class="table table-bordered" id="dynamic_field_Sparepart">
								<tr>
									<th>Sparepart</th>
									<th>Jumlah</th>
									<th>Action</th>
								</tr>
								<tr>
									<td>
										<select  id="jumlahmax" class="form-control" name="sparepart[]">
											<?php
											$con = mysqli_connect("localhost","root","","dbservice");
											$result = mysqli_query($con,"select * from barang where stok >0");
											while($row = mysqli_fetch_assoc($result)){
												echo "<option data-max=$row[stok] value=$row[kd_barang]>$row[nm_barang]</option>";
											} 
											?>
										</select>
									</td>
									<td>
										<input type="number"  id="jml" class="form-control" value="1" name="jumlah[]" min="1" max="100">
									</td>
									<td><button type="button" name="add_Sparepart" id="add_Sparepart" class="btn btn-success">+</button></td>
								</tr>
							</table>
							<input type="button" name="submit_jasa" id="submit_jasa" class="btn btn-info" value="Submit_jasa" />
						</div>
					</form>
				</div>
			</div>
			<script>
				$('#jumlahmax').change(function(){
					$('#jml').attr('max', $(this).find(":selected").data('max'));
				});
				$("[type='number']").keypress(function (evt){
					evt.preventDefault();
				});
				$(document).ready(function(){
					var ijasa=1;
					$('#add_jasa').click(function(){
						ijasa++;

						$('#dynamic_field_Jasa').append('<tr id="row'+ijasa+'"><td><select class="form-control" name="jasa[]"><?php
							$con = mysqli_connect("localhost","root","","dbservice");
							$result = mysqli_query($con,"select * from jasaservice");
							while($row = mysqli_fetch_assoc($result)){
								echo "<option value=$row[kd_jasa]>$row[nama_jasa]</option>";
							} 
							?>
							</select></td><td><button type="button" name="remove" id="'+ijasa+'" class="btn btn-danger btn_remove_jasa">X</button></td></tr>');
					});

					$(document).on('click', '.btn_remove_jasa', function(){
						var button_id = $(this).attr("id"); 
						$('#row'+button_id+'').remove();
					});
					var isparepart=1;
					$('#add_Sparepart').click(function(){
						isparepart++;

						$('#dynamic_field_Sparepart').append('<tr id="row'+isparepart+'"><td><select id="jumlahmax" class="form-control" name="sparepart[]"><?php
							$con = mysqli_connect("localhost","root","","dbservice");
							$result = mysqli_query($con,"select * from barang where stok >0");
							while($row = mysqli_fetch_assoc($result)){
								echo "<option data-max=$row[stok] value=$row[kd_barang]>$row[nm_barang]</option>";
							} 
							?>
							</select></td><td><input id="jml" type="number" class="form-control" name="jumlah[]">								</td><td><button type="button" name="remove" id="'+isparepart+'" class="btn btn-danger btn_remove_sparepart">X</button></td></tr>');
					});
					$(document).on('click', '.btn_remove_sparepart', function(){
						var button_id = $(this).attr("id"); 
						$('#row'+button_id+'').remove();
					});

					$('#submit_jasa').click(function(){		
						$.ajax({
							url:"panggil/Transaksi/action.php",
							method:"POST",
							data:$('#add_name_Jasa').serialize(),
							success:function(data)
							{
								alert(data);
								$('#add_name_Jasa')[0].reset();
								location.reload(); 
							}
						});
					});

				});
			</script>
			<br>
			<table class="table table-hover table-bordered" style="margin-top: 10px">
				<tr class="info">
					<th>No</th>
					<th>Tanggal Transaksi</th>
					<th>Kode Transaksi</th>
					<th>Nama</th>
					<th>No Kendaraan</th>
					<th>Aksi</th>
				</tr>
				<tbody>

					<?php
					$no=1;
					$status ="";
					while($tampil = $read->fetch_array()){ 
						if ($tampil['status']==1) {
							$status="disabled";
						}else{
							$status="";	
						}
						?>

						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $tampil['tanggal']?></td>
							<td><?php echo $tampil['no_invoice']?></td>
							<td><?php echo $tampil['namaPelanggan']?></td>
							<td><?php echo $tampil['no_polisi']?></td>
							<td style="text-align: center;">
								<a href="<?= $link.'edit&kd_transaksi='.$tampil['no_invoice'] ?>" class="btn btn-primary btn-sm" <?php echo $status ?>>
									<span class = "glyphicon glyphicon-edit"></span> Edit
								</a> 
								<a href="<?= $link.'bayar&kd_transaksi='.$tampil['no_invoice'] ?>" class="btn btn-success btn-sm" <?php echo $status ?>>
									<span class = "glyphicon glyphicon-edit"></span> Bayar
								</a> 
								<a onclick="return confirm('Apakah yakin data akan di hapus?')" href="	<?= $link.'hapus&kd_transaksi='.$tampil['no_invoice'] ?>" class="btn btn-danger btn-sm" <?php echo $status ?>>
									<span class = "glyphicon glyphicon-trash" ></span> Hapus
								</a>

							</td>
						</tr>

						<?php


					}
					?>	

				</tbody>
			</table>
		</div>
	</div>
