<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{
	public function login()
	{
		$user_email = $_POST['user_email'];
		$user_password = $_POST['user_password'];

		$sql = "SELECT * FROM tb_users WHERE user_email=:user_email AND user_password=PASSWORD(:user_password)";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(":user_email", $user_email);
		$stmt->bindParam(":user_password", $user_password);
		$stmt->execute();

		return $this->select($stmt);
	}

	public function tampil()
	{
		$sql = "SELECT * FROM tb_users";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		return $this->selects($stmt);
	}

	public function simpan(array $data)
	{
		$sql = "INSERT INTO tb_users SET user_email=:user_email, user_password=PASSWORD(:user_password), user_namalengkap=:user_namalengkap";
		$stmt = $this->db->prepare($sql);
		$stmt->execute([
			'user_email' => $data['user_email'],
			'user_password' => $data['user_password'],
			'user_namalengkap' => $data['user_namalengkap'],
		]);
	}

	public function edit($id)
	{
		$sql = "SELECT * FROM tb_users WHERE user_id=:user_id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(":user_id", $id);
		$stmt->execute();

		return $this->select($stmt);
	}

	public function update($id, array $data)
	{
		if ($data['user_password'] !== '') {
			$sql = "UPDATE tb_users SET user_email=:user_email, user_password=PASSWORD(:user_password), user_namalengkap=:user_namalengkap, updated_at=NOW() WHERE user_id=:user_id";
		} else {
			$sql = "UPDATE tb_users SET user_email=:user_email, user_namalengkap=:user_namalengkap, updated_at=NOW() WHERE user_id=:user_id";
		}
		$stmt = $this->db->prepare($sql);
		$params = [
			'user_email' => $data['user_email'],
			'user_namalengkap' => $data['user_namalengkap'],
			'user_id' => $id,
		];
		if ($data['user_password'] !== '') {
			$params['user_password'] = $data['user_password'];
		}
		$stmt->execute($params);
	}

	public function adaEmail($email, $id = null)
	{
		$sql = "SELECT COUNT(*) FROM tb_users WHERE user_email = :email";
		if ($id !== null) {
			$sql .= " AND user_id != :id";
		}
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(':email', $email);
		if ($id !== null) {
			$stmt->bindValue(':id', $id);
		}
		$stmt->execute();
		return $stmt->fetchColumn() > 0;
	}

	public function delete($id)
	{
		$sql = "DELETE FROM tb_users WHERE user_id=:user_id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(":user_id", $id);
		$stmt->execute();
	}
}
