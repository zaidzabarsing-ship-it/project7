<?php

namespace App\Controllers;

use App\Core\Controller;

class User extends Controller
{
	public object $model;

	public function __construct()
	{
		$this->model = new \App\Models\User();
	}

	public function index()
	{
		$data['rows'] = $this->model->tampil();
		$this->dashboard('user/index', $data);
	}

	public function input()
	{
		$this->dashboard('user/input');
	}

	public function simpan()
	{
		if (!$this->isPost()) {
			$this->notFound();
			return;
		}
		$data = [
			'user_email' => $this->postString('user_email'),
			'user_password' => (string) ($_POST['user_password'] ?? ''),
			'user_namalengkap' => $this->postString('user_namalengkap'),
		];
		$errors = $this->validateUser($data, true);
		if (!$errors && $this->model->adaEmail($data['user_email'])) {
			$errors['user_email'] = 'Email sudah digunakan.';
		}
		if ($errors) {
			$this->flashRedirect('user/input', 'danger', 'Periksa kembali data yang dimasukkan.', $data, $errors);
		}
		$this->model->simpan($data);
		$this->flashRedirect('user', 'success', 'Data user berhasil ditambahkan.');
	}

	public function edit($id)
	{
		$id = $this->validId($id);
		$data['row'] = $id === null ? null : $this->model->edit($id);
		if ($data['row'] === null) {
			$this->notFound();
			return;
		}
		$this->dashboard('user/edit', $data);
	}

	public function update()
	{
		if (!$this->isPost()) {
			$this->notFound();
			return;
		}
		$id = $this->validId($this->postString('user_id'));
		if ($id === null || $this->model->edit($id) === null) {
			$this->notFound();
			return;
		}
		$data = [
			'user_email' => $this->postString('user_email'),
			'user_password' => (string) ($_POST['user_password'] ?? ''),
			'user_namalengkap' => $this->postString('user_namalengkap'),
		];
		$errors = $this->validateUser($data, false);
		if (!$errors && $this->model->adaEmail($data['user_email'], $id)) {
			$errors['user_email'] = 'Email sudah digunakan.';
		}
		if ($errors) {
			$this->flashRedirect('user/edit/' . $id, 'danger', 'Periksa kembali data yang dimasukkan.', $data, $errors);
		}
		$this->model->update($id, $data);
		$this->flashRedirect('user', 'success', 'Data user berhasil diperbarui.');
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
		if ((int) ($_SESSION['user_id'] ?? 0) === $id) {
			$this->flashRedirect('user', 'danger', 'Akun yang sedang digunakan tidak dapat dihapus.');
		}
		$this->model->delete($id);
		$this->flashRedirect('user', 'success', 'Data user berhasil dihapus.');
	}

	private function validateUser(array $data, bool $passwordRequired): array
	{
		$errors = [];
		if ($data['user_email'] === '' || !filter_var($data['user_email'], FILTER_VALIDATE_EMAIL) || $this->textLength($data['user_email']) > 50) {
			$errors['user_email'] = 'Email tidak valid (maksimal 50 karakter).';
		}
		if ($passwordRequired && $data['user_password'] === '') {
			$errors['user_password'] = 'Password wajib diisi.';
		}
		if ($data['user_password'] !== '' && $this->textLength($data['user_password']) > 100) {
			$errors['user_password'] = 'Password maksimal 100 karakter.';
		}
		if ($this->textLength($data['user_namalengkap']) > 100) {
			$errors['user_namalengkap'] = 'Nama lengkap maksimal 100 karakter.';
		}
		return $errors;
	}
}
