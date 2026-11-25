<?php

namespace App\Models;

use App\Core\Model;

class Dosen extends Model
{
    public function tampil()
    {
        $sql = "SELECT * FROM tb_dosen ORDER BY dosen_id ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $this->selects($stmt);
    }

    public function simpan($data)
    {
        $sql = "INSERT INTO tb_dosen
                (dosen_nip, dosen_nama, dosen_golongan)
                VALUES (:dosen_nip, :dosen_nama, :dosen_golongan)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);
    }

    public function edit($id)
    {
        $sql = "SELECT * FROM tb_dosen WHERE dosen_id = :dosen_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':dosen_id', $id);
        $stmt->execute();

        $row = $this->select($stmt);
        return $row ?: null;
    }

    public function update($id, $data)
    {
        $sql = "UPDATE tb_dosen SET
                dosen_nip = :dosen_nip,
                dosen_nama = :dosen_nama,
                dosen_golongan = :dosen_golongan
                WHERE dosen_id = :dosen_id";

        $data['dosen_id'] = $id;

        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM tb_dosen WHERE dosen_id = :dosen_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':dosen_id', $id);
        $stmt->execute();
    }

    public function adaNip($nip, $id = null)
    {
        $sql = "SELECT COUNT(*) FROM tb_dosen WHERE dosen_nip = :nip";

        if ($id !== null) {
            $sql .= " AND dosen_id != :id";
        }

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nip', $nip);

        if ($id !== null) {
            $stmt->bindParam(':id', $id);
        }

        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }
}
