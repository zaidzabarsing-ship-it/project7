<?php

namespace App\Core;

use PDO;

class Model
{

	protected object $db;

	public function __construct()
	{
		$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
		$this->db = new PDO($dsn, DB_USER, DB_PASS);
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	}

	public function select($stmt)
	{
		//Menampilkan satu data
		return $stmt->fetch();
	}

	public function selects($stmt)
	{
		//Menampilkan semua data
		$data = [];

		while ($rows = $stmt->fetch()) {
			$data[] = $rows;
		}

		return $data;
	}
}
