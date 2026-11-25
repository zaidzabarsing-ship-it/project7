<?php

namespace App\Controllers;

use App\Core\Controller;

class Dosen extends Controller
{
	public object $model;

	public function __construct()
	{
		$this->model = new \App\Models\Dosen();
	}

	public function index(): void
	{
		$this->dashboard('dosen/index', ['rows' => $this->model->tampil()]);
	}

	public function input(): void
	{
		$this->dashboard('dosen/input');
	}

	public function simpan(): void
	{
		if (!$this->isPost()) {
			return;
		}

		$data = $this->formData();
		$errors = $this->validate($data);
		if (!$errors && $this->model->adaNip($data['dosen_nip'])) {
			$errors['dosen_nip'] = 'NIP sudah digunakan.';
		}
		if ($errors) {
			$this->flashRedirect('dosen/input', 'danger', 'Periksa kembali data yang dimasukkan.', $data, $errors);
		}

		$this->model->simpan($data);
		$this->flashRedirect('dosen', 'success', 'Data dosen berhasil ditambahkan.');
	}

	public function edit($id): void
	{
		$id = $this->validId($id);
		$row = $id === null ? null : $this->model->edit($id);
		if ($row === null) {
			$this->notFound();
			return;
		}
		$this->dashboard('dosen/edit', ['row' => $row]);
	}

	public function update(): void
	{
		if (!$this->isPost()) {
			return;
		}

		$id = $this->validId($this->postString('dosen_id'));
		if ($id === null || $this->model->edit($id) === null) {
			$this->notFound();
			return;
		}

		$data = $this->formData();
		$errors = $this->validate($data);
		if (!$errors && $this->model->adaNip($data['dosen_nip'], $id)) {
			$errors['dosen_nip'] = 'NIP sudah digunakan.';
		}
		if ($errors) {
			$this->flashRedirect('dosen/edit/' . $id, 'danger', 'Periksa kembali data yang dimasukkan.', $data, $errors);
		}

		$this->model->update($id, $data);
		$this->flashRedirect('dosen', 'success', 'Data dosen berhasil diperbarui.');
	}

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
		$this->flashRedirect('dosen', 'success', 'Data dosen berhasil dihapus.');
	}

	private function formData(): array
	{
		return [
			'dosen_nip' => $this->postString('dosen_nip'),
			'dosen_nama' => $this->postString('dosen_nama'),
			'dosen_golongan' => $this->postString('dosen_golongan'),
		];
	}

	private function validate(array $data): array
	{
		$errors = [];
		if ($data['dosen_nip'] === '' || $this->textLength($data['dosen_nip']) > 25) {
			$errors['dosen_nip'] = 'NIP wajib diisi (maksimal 25 karakter).';
		}
		if ($data['dosen_nama'] === '' || $this->textLength($data['dosen_nama']) > 100) {
			$errors['dosen_nama'] = 'Nama wajib diisi (maksimal 100 karakter).';
		}
		if ($this->textLength($data['dosen_golongan']) > 100) {
			$errors['dosen_golongan'] = 'Golongan maksimal 100 karakter.';
		}
		return $errors;
	}
}
