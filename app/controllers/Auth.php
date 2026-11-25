<?php

namespace App\Controllers;

use App\Core\Controller;

class Auth extends Controller
{
	public object $model;

	public function __construct()
	{
		$this->model = new \App\Models\User();
	}

	public function index()
	{
		$this->login();
	}

	public function login()
	{
		if (isset($_SESSION['user_id'])) {
			header('location:' . URL . '/dashboard');
			exit;
		}

		$data['error'] = $_SESSION['login_error'] ?? null;
		unset($_SESSION['login_error']);

		$this->guest('auth/login', $data);
	}

	public function proses()
	{
		$row = $this->model->login();

		if ($row) {
			session_regenerate_id(true);
			$_SESSION['user_id'] = $row['user_id'];
			$_SESSION['user_email'] = $row['user_email'];
			$_SESSION['user_namalengkap'] = $row['user_namalengkap'];

			header('location:' . URL . '/dashboard');
		} else {
			$_SESSION['login_error'] = "Email atau password salah.";
			header('location:' . URL . '/auth/login');
		}
	}

	public function logout()
	{
		session_unset();
		session_destroy();

		header('location:' . URL . '/auth/login');
	}
}
