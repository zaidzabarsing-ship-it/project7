<?php

namespace App\Models;

use App\Core\Model;

class Mahasiswa extends Model
{
	public function tampil()
	{
		$sql = "SELECT * FROM tb_mhsw";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		return $this->selects($stmt);
	}

	public function simpan(array $data)
	{
		$sql = "INSERT INTO tb_mhsw SET mhsw_nim=:mhsw_nim, mhsw_nama=:mhsw_nama, mhsw_alamat=:mhsw_alamat";
		$stmt = $this->db->prepare($sql);
		$stmt->execute($data);
	}

	public function edit($id)
	{
		$sql = "SELECT * FROM tb_mhsw WHERE mhsw_id=:mhsw_id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(":mhsw_id", $id);
		$stmt->execute();

		return $this->select($stmt);
	}

	public function update($id, array $data)
	{
		$sql = "UPDATE tb_mhsw SET mhsw_nim=:mhsw_nim, mhsw_nama=:mhsw_nama, mhsw_alamat=:mhsw_alamat WHERE mhsw_id=:mhsw_id";
		$stmt = $this->db->prepare($sql);
		$data['mhsw_id'] = $id;
		$stmt->execute($data);
	}

	public function adaNim($nim, $id = null)
	{
		$sql = "SELECT COUNT(*) FROM tb_mhsw WHERE mhsw_nim = :nim";
		if ($id !== null) {
			$sql .= " AND mhsw_id != :id";
		}
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(':nim', $nim);
		if ($id !== null) {
			$stmt->bindValue(':id', $id);
		}
		$stmt->execute();
		return $stmt->fetchColumn() > 0;
	}

	public function delete($id)
	{
		$sql = "DELETE FROM tb_mhsw WHERE mhsw_id=:mhsw_id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(":mhsw_id", $id);
		$stmt->execute();
	}
}
