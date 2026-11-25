<?php

namespace App\Core;

class Controller
{
	protected function isPost(): bool
	{
		return ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST';
	}

	protected function postString(string $key): string
	{
		return trim((string) ($_POST[$key] ?? ''));
	}

	protected function textLength(string $value): int
	{
		return function_exists('mb_strlen') ? mb_strlen($value) : strlen($value);
	}

	protected function validId($id): ?int
	{
		if (!is_scalar($id) || !preg_match('/^[1-9][0-9]*$/', (string) $id)) {
			return null;
		}
		return (int) $id;
	}

	protected function notFound(): void
	{
		http_response_code(404);
		$this->guest('error/404');
	}

	protected function flashRedirect(
		string $path,
		string $type,
		string $message,
		array $old = [],
		array $errors = []
	): void
	{
		$_SESSION['flash'] = [
			'type' => $type,
			'message' => $message,
		];
		$_SESSION['old'] = $old;
		$_SESSION['errors'] = $errors;
		header('location:' . URL . '/' . ltrim($path, '/'));
		exit;
	}

	// Layout home
	public function guest($view, $data = [])
	{
		require_once ROOT . "layouts/guest.php";
	}

	// layout dashboard
	public function dashboard($view, $data = [])
	{
		require_once ROOT . "layouts/dashboard.php";
	}
}
