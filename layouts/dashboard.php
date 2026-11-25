<?php
if (!empty($_GET['page'])) {
	$currentPage = $_GET['page'];
} else {
	$requestUri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
	$basePath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/');
	if ($basePath !== '' && $basePath !== '/' && strpos($requestUri, $basePath) === 0) {
		$requestUri = substr($requestUri, strlen($basePath));
	}
	$currentPage = trim($requestUri, '/') ?: 'dashboard';
}
$currentPage = explode('/', trim($currentPage, '/'))[0];
?>
<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Suendri">
	<title>Project 7 Pemrograman Berbasis Web Lanjutan</title>

	<link rel="shortcut icon" href="<?php echo AST; ?>/img/favicon.ico" type="image/x-icon">
	<link href="<?php echo AST; ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo AST; ?>/bootstrap-icons/bootstrap-icons.min.css" rel="stylesheet">
	<link href="<?php echo AST; ?>/css/style.css" rel="stylesheet">
</head>

<body class="bg-light">
	<div class="d-flex" id="wrapper">
		<aside class="text-dark" id="sidebar-wrapper">
			<header class="sidebar-heading text-center position-relative">
				<button class="btn btn-sm btn-outline-secondary d-md-none position-absolute top-0 end-0 m-2 menu-toggle" type="button" aria-label="Tutup menu">
					<i class="bi bi-x-lg"></i>
				</button>
				<img src="<?php echo AST; ?>/img/delitekno.png" class="brand" alt="Logo">
				<div class="fw-bold mt-2">Sistem Akademik</div>
			</header>

			<nav class="list-group list-group-flush p-3 gap-1">
				<a href="<?php echo URL; ?>/dashboard" class="list-group-item list-group-item-action rounded <?php echo $currentPage == 'dashboard' ? 'active' : ''; ?>">
					<i class="bi bi-house-door me-2"></i> Dashboard
				</a>
				<a href="<?php echo URL; ?>/mahasiswa" class="list-group-item list-group-item-action rounded <?php echo $currentPage == 'mahasiswa' ? 'active' : ''; ?>">
					<i class="bi bi-people me-2"></i> Mahasiswa
				</a>
				<a href="<?php echo URL; ?>/dosen" class="list-group-item list-group-item-action rounded <?php echo $currentPage == 'dosen' ? 'active' : ''; ?>">
					<i class="bi bi-person-badge me-2"></i> Dosen
				</a>
				<a href="<?php echo URL; ?>/matakuliah" class="list-group-item list-group-item-action rounded <?php echo $currentPage == 'matakuliah' ? 'active' : ''; ?>">
					<i class="bi bi-journal-bookmark me-2"></i> Matakuliah
				</a>
				<a href="<?php echo URL; ?>/user" class="list-group-item list-group-item-action rounded <?php echo $currentPage == 'user' ? 'active' : ''; ?>">
					<i class="bi bi-person-gear me-2"></i> User
				</a>
			</nav>
		</aside>

		<div class="sidebar-overlay menu-toggle"></div>

		<div id="page-content-wrapper">
			<nav class="navbar bg-white border-bottom shadow-sm px-3 sticky-top">
				<button class="btn btn-outline-primary menu-toggle" type="button" aria-label="Tampilkan atau sembunyikan menu">
					<i class="bi bi-list fs-5"></i>
				</button>
				<span class="navbar-brand ms-3 mb-0 h1">Akademik</span>
				<div class="d-flex align-items-center gap-2 ms-auto">
					<span class="text-secondary d-none d-sm-inline">
						<i class="bi bi-person-circle me-1"></i><?php echo $_SESSION['user_namalengkap']; ?>
					</span>
					<a href="<?php echo URL; ?>/auth/logout" class="btn btn-outline-danger btn-sm">
						<i class="bi bi-box-arrow-right me-1"></i> Logout
					</a>
				</div>
			</nav>

			<main class="container-fluid p-3 p-md-4">
				<?php if (!empty($_SESSION['flash'])) { ?>
					<div class="alert alert-<?php echo e($_SESSION['flash']['type']); ?> alert-dismissible fade show" role="alert">
						<?php echo e($_SESSION['flash']['message']); ?>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
					</div>
					<?php unset($_SESSION['flash']); ?>
				<?php } ?>
				<?php require_once ROOT . "app/views/" . $view . ".php"; ?>
			</main>

			<footer class="bg-white border-top text-secondary px-4 py-3">
				Project 7 Pemrograman Berbasis Web
			</footer>
		</div>
	</div>

	<script src="<?php echo AST; ?>/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?php echo AST; ?>/js/app.js"></script>
</body>

</html>
