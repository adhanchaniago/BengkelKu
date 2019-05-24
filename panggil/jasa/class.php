	<?php
	require 'koneksi.php';
	
	class db_class extends db_connect{	
		
		public function __construct(){
			$this->connect();
		}
		
		public function create($kode,$nmJasa, $harga, $diskon){
			$stmt = $this->conn->prepare("INSERT INTO `jasaservice` (`kd_jasa`, `nama_jasa`, `harga`, `diskon`) VALUES (?,?,?,?)") or die($this->conn->error);
			$stmt->bind_param("ssii", $kode , $nmJasa, $harga,$diskon);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}
		
		public function read(){
			$stmt = $this->conn->prepare("select * from jasaservice") or die($this->conn->error);
			if($stmt->execute()){
				$result = $stmt->get_result();
				$stmt->close();
				$this->conn->close();
				return $result;
			}
		}

	
		public function tampil($id_jasaservice){
			$stmt = $this->conn->prepare("select * from jasaservice where kd_jasa =?") or die($this->conn->error);
			$stmt->bind_param("s", $id_jasaservice);
			if($stmt->execute()){
				$result = $stmt->get_result();
				$fetch = $result->fetch_array();
				$stmt->close();
				$this->conn->close();
				return $fetch;
			}
		}
		
		public function delete($id_jasaservice){
			$stmt = $this->conn->prepare("DELETE FROM `jasaservice` WHERE `kd_jasa` = ?") or die($this->conn->error);
			$stmt->bind_param("s", $id_jasaservice);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}
		
		public function update($kd, $nama, $hargaJual, $diskon){
			$stmt = $this->conn->prepare("UPDATE `jasaservice` SET `nama_jasa` = ?, `harga` = ?, `diskon` = ? WHERE `kd_jasa` = ?") or die($this->conn->error);
			$stmt->bind_param("siis", $nama, $hargaJual, $diskon, $kd);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}
 	}	
?>