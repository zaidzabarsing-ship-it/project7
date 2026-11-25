<?php

namespace App\Controllers;

use App\Core\Controller;

class Matakuliah extends Controller
{
    public object $model;

    public function __construct()
    {
        $this->model = new \App\Models\Matakuliah();
    }

    // Menampilkan daftar mata kuliah
    public function index(): void
    {
        $this->dashboard('matakuliah/index', [
            'rows' => $this->model->tampil()
        ]);
    }

    // Menampilkan form input
    public function input(): void
    {
        $this->dashboard('matakuliah/input');
    }

    // Menyimpan data baru
    public function simpan(): void
    {
        if (!$this->isPost()) {
            return;
        }

        $data = $this->formData();
        $errors = $this->validate($data);

        if (!$errors && $this->model->adaKode($data['matkul_kode'])) {
            $errors['matkul_kode'] = 'Kode matakuliah sudah digunakan.';
        }

        if ($errors) {
            $this->flashRedirect(
                'matakuliah/input',
                'danger',
                'Periksa kembali data yang dimasukkan.',
                $data,
                $errors
            );
            return;
        }

        $this->model->simpan($data);

        $this->flashRedirect(
            'matakuliah',
            'success',
            'Data matakuliah berhasil ditambahkan.'
        );
    }

    // Menampilkan form edit
    public function edit($id): void
    {
        $id = $this->validId($id);
        $row = $id === null ? null : $this->model->edit($id);

        if ($row === null) {
            $this->notFound();
            return;
        }

        $this->dashboard('matakuliah/edit', [
            'row' => $row
        ]);
    }

    // Memperbarui data
    public function update(): void
    {
        if (!$this->isPost()) {
            return;
        }

        $id = $this->validId($this->postString('matkul_id'));

        if ($id === null || $this->model->edit($id) === null) {
            $this->notFound();
            return;
        }

        $data = $this->formData();
        $errors = $this->validate($data);

        if (!$errors && $this->model->adaKode($data['matkul_kode'], $id)) {
            $errors['matkul_kode'] = 'Kode matakuliah sudah digunakan.';
        }

        if ($errors) {
            $this->flashRedirect(
                'matakuliah/edit/' . $id,
                'danger',
                'Periksa kembali data yang dimasukkan.',
                $data,
                $errors
            );
            return;
        }

        $this->model->update($id, $data);

        $this->flashRedirect(
            'matakuliah',
            'success',
            'Data matakuliah berhasil diperbarui.'
        );
    }

    // Menghapus data
    public function delete($id): void
    {
        if (!$this->isPost()) {
            return;
        }

        $id = $this->validId($id);

        if ($id === null) {
            $this->notFound();
            return;
        }

        $this->model->delete($id);

        $this->flashRedirect(
            'matakuliah',
            'success',
            'Data matakuliah berhasil dihapus.'
        );
    }

    // Mengambil data dari form
    private function formData(): array
    {
        return [
            'matkul_kode' => $this->postString('matkul_kode'),
            'matkul_nama' => $this->postString('matkul_nama'),
            'matkul_sks' => $this->postString('matkul_sks'),
            'matkul_semester' => $this->postString('matkul_semester'),
        ];
    }

    // Validasi data
    private function validate(array $data): array
    {
        $errors = [];

        if (
            $data['matkul_kode'] === '' ||
            $this->textLength($data['matkul_kode']) > 25
        ) {
            $errors['matkul_kode'] =
                'Kode wajib diisi (maksimal 25 karakter).';
        }

        if (
            $data['matkul_nama'] === '' ||
            $this->textLength($data['matkul_nama']) > 100
        ) {
            $errors['matkul_nama'] =
                'Nama matakuliah wajib diisi (maksimal 100 karakter).';
        }

        if (!preg_match('/^[1-6]$/', $data['matkul_sks'])) {
            $errors['matkul_sks'] =
                'SKS harus berupa angka 1 sampai 6.';
        }

        if (!preg_match('/^(?:[1-9]|1[0-4])$/', $data['matkul_semester'])) {
            $errors['matkul_semester'] =
                'Semester harus berupa angka 1 sampai 14.';
        }

        return $errors;
    }
}
