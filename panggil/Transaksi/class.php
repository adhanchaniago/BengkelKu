	<?php
	require 'koneksi.php';
	
	class db_class extends db_connect{	
		
		public function __construct(){
			$this->connect();
		}
		
		public function create($kode,$tgl, $nama, $noPolisi){
			$stmt = $this->conn->prepare("INSERT INTO `transaksi` (`no_invoice`, `tanggal`, `namaPelanggan`, `no_polisi` ) VALUES (?,?,?,?); ") or die($this->conn->error);
			$stmt->bind_param("ssss", $kode,$tgl, $nama, $noPolisi);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}
		
		public function read(){
			$stmt = $this->conn->prepare("select * from transaksi order by status desc") or die($this->conn->error);
			if($stmt->execute()){
				$result = $stmt->get_result();
				$stmt->close();
				$this->conn->close();
				return $result;
			}
		}
		public function option_show(){
			$stmt = $this->conn->prepare("select * from jasaservice");
			if ($stmt === FALSE) {
				die($this->conn->error);
			}
			if($stmt->execute()){
				$result = $stmt->get_result();
				$stmt->close();
				$this->conn->close();
				return $result;
			}
		}

		public function tampil($id_jasaservice){
			$stmt = $this->conn->prepare("select * from transaksi where no_invoice =?") or die($this->conn->error);
			$stmt->bind_param("s", $id_jasaservice);
			if($stmt->execute()){
				$result = $stmt->get_result();
				$fetch = $result->fetch_array();
				$stmt->close();
				$this->conn->close();
				return $fetch;
			}
		}

		public function delete($id){
			$stmt1 = $this->conn->prepare("DELETE FROM `transaksi` WHERE `no_invoice` = ?") or die($this->conn->error);
			$stmt1->bind_param("s", $id);
			$stmt2 = $this->conn->prepare("DELETE FROM `transaksi_item` WHERE `no_invoice` = ?") or die($this->conn->error);
			$stmt2->bind_param("s", $id);
			if($stmt1->execute() && $stmt2->execute()){
				$stmt1->close();
				$stmt2->close();
				$this->conn->close();
				return true;
			}
		}

		public function deleteTrans($id){
			$stmt2 = $this->conn->prepare("DELETE FROM `transaksi_item` WHERE `id` = ?") or die($this->conn->error);
			$stmt2->bind_param("s", $id);
			if($stmt2->execute()){
				$stmt2->close();
				$this->conn->close();
				return true;
			}
		}
		
		public function update($tgl, $nama, $no_polisi, $kd){
			$stmt = $this->conn->prepare("UPDATE `transaksi` SET `tanggal` = ?, `namaPelanggan` = ?, `no_polisi` = ? WHERE `transaksi`.`no_invoice` = ?;
") or die($this->conn->error);
			$stmt->bind_param("ssss", $tgl, $nama, $no_polisi, $kd);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}
	}	
	?>