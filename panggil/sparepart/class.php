	<?php
	require 'koneksi.php';
	
	class db_class extends db_connect{	
		
		public function __construct(){
			$this->connect();
		}
		
		public function create($kode,$nmBarang, $hargaBarang, $diskon, $stok){
			$stmt = $this->conn->prepare("INSERT INTO `barang` (`kd_barang`,`nm_barang`, `harga_jual`, `diskon`, `stok`) VALUES (?,?,?,?,?)") or die($this->conn->error);
			$stmt->bind_param("ssiii", $kode , $nmBarang, $hargaBarang,$diskon,$stok);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}
		
		public function read(){
			$stmt = $this->conn->prepare("select * from barang") or die($this->conn->error);
			if($stmt->execute()){
				$result = $stmt->get_result();
				$stmt->close();
				$this->conn->close();
				return $result;
			}
		}

	
		public function tampil($id_barang){
			$stmt = $this->conn->prepare("select * from barang where kd_barang =?") or die($this->conn->error);
			$stmt->bind_param("s", $id_barang);
			if($stmt->execute()){
				$result = $stmt->get_result();
				$fetch = $result->fetch_array();
				$stmt->close();
				$this->conn->close();
				return $fetch;
			}
		}
		
		public function delete($id_barang){
			$stmt = $this->conn->prepare("DELETE FROM `barang` WHERE `kd_barang` = ?") or die($this->conn->error);
			$stmt->bind_param("s", $id_barang);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}
		
		public function update($kd, $nama, $hargaJual, $diskon,  $stok){
			$stmt = $this->conn->prepare("UPDATE `barang` SET `nm_barang` = ?, `harga_jual` = ?, `diskon` = ?, `stok` = ? WHERE `kd_barang` = ?") or die($this->conn->error);
			$stmt->bind_param("siiis", $nama, $hargaJual, $diskon, $stok, $kd);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}
 	}	
?>