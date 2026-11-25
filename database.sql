CREATE DATABASE IF NOT EXISTS db_project7
      CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_project7;

CREATE TABLE IF NOT EXISTS tb_mhsw (
      mhsw_id INT(11) NOT NULL AUTO_INCREMENT,
      mhsw_nim VARCHAR(25) NOT NULL,
      mhsw_nama VARCHAR(100) NOT NULL,
      mhsw_alamat TEXT DEFAULT NULL,
      PRIMARY KEY(mhsw_id),
      UNIQUE KEY(mhsw_nim)
);

CREATE TABLE IF NOT EXISTS tb_dosen (
      dosen_id INT(11) NOT NULL AUTO_INCREMENT,
      dosen_nip VARCHAR(25) NOT NULL,
      dosen_nama VARCHAR(100) NOT NULL,
      dosen_golongan VARCHAR(100) DEFAULT NULL,
      PRIMARY KEY(dosen_id),
      UNIQUE KEY(dosen_nip)
);

CREATE TABLE IF NOT EXISTS tb_matakuliah (
      matkul_id INT(11) NOT NULL AUTO_INCREMENT,
      matkul_kode VARCHAR(25) NOT NULL,
      matkul_nama VARCHAR(100) NOT NULL,
      matkul_sks TINYINT(3) NOT NULL,
      matkul_semester TINYINT(3) NOT NULL,
      PRIMARY KEY(matkul_id),
      UNIQUE KEY(matkul_kode)
);

CREATE TABLE IF NOT EXISTS tb_users (
	user_id INT(11) NOT NULL AUTO_INCREMENT,
	user_email VARCHAR(50) NOT NULL,
	user_password VARCHAR(100) NOT NULL,
	user_namalengkap VARCHAR(100) DEFAULT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at DATETIME DEFAULT NULL,
	PRIMARY KEY(user_id),
	UNIQUE KEY(user_email)
);

INSERT INTO `tb_users` (`user_id`, `user_email`, `user_password`, `user_namalengkap`, `created_at`, `updated_at`) VALUES
(1, 'admin@mail.com', '*4ACFE3202A5FF5CF467898FC58AAB1D615029441', 'Administrator', '2025-12-02 15:51:37', NULL);