<?php

namespace App\Models;

use App\Core\Model;

class Matakuliah extends Model
{
    // Menampilkan seluruh data mata kuliah
    public function tampil()
    {
        $sql = "SELECT * FROM tb_matakuliah ORDER BY matkul_id ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $this->selects($stmt);
    }

    // Menyimpan data mata kuliah
    public function simpan($data)
    {
        $sql = "INSERT INTO tb_matakuliah
                (matkul_kode, matkul_nama, matkul_sks, matkul_semester)
                VALUES
                (:matkul_kode, :matkul_nama, :matkul_sks, :matkul_semester)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);
    }

    // Mengambil satu data mata kuliah berdasarkan ID
    public function edit($id)
    {
        $sql = "SELECT * FROM tb_matakuliah WHERE matkul_id = :matkul_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':matkul_id', $id);
        $stmt->execute();

        $row = $this->select($stmt);
        return $row ?: null;
    }

    // Memperbarui data mata kuliah
    public function update($id, $data)
    {
        $sql = "UPDATE tb_matakuliah SET
                matkul_kode = :matkul_kode,
                matkul_nama = :matkul_nama,
                matkul_sks = :matkul_sks,
                matkul_semester = :matkul_semester
                WHERE matkul_id = :matkul_id";

        $data['matkul_id'] = $id;

        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);
    }

    // Menghapus data mata kuliah
    public function delete($id)
    {
        $sql = "DELETE FROM tb_matakuliah WHERE matkul_id = :matkul_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':matkul_id', $id);
        $stmt->execute();
    }

    // Memeriksa apakah kode mata kuliah sudah digunakan
    public function adaKode($kode, $id = null)
    {
        $sql = "SELECT COUNT(*) FROM tb_matakuliah
                WHERE matkul_kode = :kode";

        if ($id !== null) {
            $sql .= " AND matkul_id != :id";
        }

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':kode', $kode);

        if ($id !== null) {
            $stmt->bindParam(':id', $id);
        }

        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }
}
