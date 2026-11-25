<?php

namespace App\Controllers;

use App\Core\Controller;

class Mahasiswa extends Controller
{
	public object $model;

	public function __construct()
	{
		$this->model = new \App\Models\Mahasiswa();
	}

	public function index()
	{
		$data['rows'] = $this->model->tampil();
		$this->dashboard('mahasiswa/index', $data);
	}

	public function input()
	{
		$this->dashboard('mahasiswa/input');
	}

	public function simpan()
	{
		if (!$this->isPost()) {
			$this->notFound();
			return;
		}
		$data = [
			'mhsw_nim' => $this->postString('mhsw_nim'),
			'mhsw_nama' => $this->postString('mhsw_nama'),
			'mhsw_alamat' => $this->postString('mhsw_alamat'),
		];
		$errors = $this->validateMahasiswa($data);
		if (!$errors && $this->model->adaNim($data['mhsw_nim'])) {
			$errors['mhsw_nim'] = 'NIM sudah digunakan.';
		}
		if ($errors) {
			$this->flashRedirect('mahasiswa/input', 'danger', 'Periksa kembali data yang dimasukkan.', $data, $errors);
		}
		$this->model->simpan($data);
		$this->flashRedirect('mahasiswa', 'success', 'Data mahasiswa berhasil ditambahkan.');
	}

	public function edit($id)
	{
		$id = $this->validId($id);
		$data['row'] = $id === null ? null : $this->model->edit($id);
		if ($data['row'] === null) {
			$this->notFound();
			return;
		}
		$this->dashboard('mahasiswa/edit', $data);
	}

	public function update()
	{
		if (!$this->isPost()) {
			$this->notFound();
			return;
		}
		$id = $this->validId($this->postString('mhsw_id'));
		if ($id === null || $this->model->edit($id) === null) {
			$this->notFound();
			return;
		}
		$data = [
			'mhsw_nim' => $this->postString('mhsw_nim'),
			'mhsw_nama' => $this->postString('mhsw_nama'),
			'mhsw_alamat' => $this->postString('mhsw_alamat'),
		];
		$errors = $this->validateMahasiswa($data);
		if (!$errors && $this->model->adaNim($data['mhsw_nim'], $id)) {
			$errors['mhsw_nim'] = 'NIM sudah digunakan.';
		}
		if ($errors) {
			$this->flashRedirect('mahasiswa/edit/' . $id, 'danger', 'Periksa kembali data yang dimasukkan.', $data, $errors);
		}
		$this->model->update($id, $data);
		$this->flashRedirect('mahasiswa', 'success', 'Data mahasiswa berhasil diperbarui.');
	}

	public function delete($id)
	{
		if (!$this->isPost()) {
			$this->notFound();
			return;
		}
		$id = $this->validId($id);
		if ($id === null) {
			$this->notFound();
			return;
		}
		$this->model->delete($id);
		$this->flashRedirect('mahasiswa', 'success', 'Data mahasiswa berhasil dihapus.');
	}

	private function validateMahasiswa(array $data): array
	{
		$errors = [];
		if ($data['mhsw_nim'] === '' || $this->textLength($data['mhsw_nim']) > 25) {
			$errors['mhsw_nim'] = 'NIM wajib diisi (maksimal 25 karakter).';
		}
		if ($data['mhsw_nama'] === '' || $this->textLength($data['mhsw_nama']) > 100) {
			$errors['mhsw_nama'] = 'Nama wajib diisi (maksimal 100 karakter).';
		}
		return $errors;
	}
}
