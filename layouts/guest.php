<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sistem Akademik | Project 7</title>

	<link rel="shortcut icon" href="<?php echo AST; ?>/img/favicon.ico" type="image/x-icon">
	<link href="<?php echo AST; ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo AST; ?>/bootstrap-icons/bootstrap-icons.min.css" rel="stylesheet">
	<link href="<?php echo AST; ?>/css/style.css" rel="stylesheet">
</head>

<body class="guest-page bg-light">
	<nav class="navbar bg-white border-bottom shadow-sm">
		<div class="container">
			<a href="<?php echo URL; ?>" class="navbar-brand d-flex align-items-center gap-2">
				<img src="<?php echo AST; ?>/img/delitekno.png" class="guest-logo" alt="Logo">
				<span class="fw-bold">Sistem Akademik</span>
			</a>
			<a href="<?php echo URL; ?>/auth/login" class="btn btn-primary">
				<i class="bi bi-box-arrow-in-right me-1"></i> Login
			</a>
		</div>
	</nav>

	<main class="container py-5">
		<?php require_once ROOT . "app/views/" . $view . ".php"; ?>
	</main>

	<footer class="border-top bg-white text-secondary py-3">
		<div class="container">Project 7 Pemrograman Berbasis Web</div>
	</footer>

	<script src="<?php echo AST; ?>/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
