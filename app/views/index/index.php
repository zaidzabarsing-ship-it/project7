<div class="row align-items-center g-4 py-lg-5">
	<div class="col-12 col-lg-7">
		<span class="badge text-bg-primary mb-3">Project 7 &middot; MVC</span>
		<h1 class="display-5 fw-bold">Framework MVC sederhana untuk pembelajaran PHP</h1>
		<p class="lead text-secondary">
			Pelajari alur request dari router menuju controller, model, view, dan layout
			melalui aplikasi Sistem Akademik.
		</p>
		<div class="d-flex flex-wrap gap-2">
			<a href="<?php echo URL; ?>/auth/login" class="btn btn-primary btn-lg">
				<i class="bi bi-box-arrow-in-right me-1"></i> Login
			</a>
			<a href="<?php echo URL; ?>/index/show" class="btn btn-outline-secondary btn-lg">
				Contoh Route
			</a>
		</div>
	</div>
	<div class="col-12 col-lg-5">
		<div class="card border-0 shadow-sm">
			<div class="card-body p-4">
				<h5 class="fw-bold">Alur MVC</h5>
				<ol class="text-secondary mb-0">
					<li class="mb-2">URL diterima oleh Bootstrap.</li>
					<li class="mb-2">Controller menentukan proses.</li>
					<li class="mb-2">Model mengakses database.</li>
					<li>View ditampilkan melalui layout.</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<div class="alert alert-light border mt-4">
	<i class="bi bi-code-slash text-primary me-2"></i>
	<?php echo $data['row_index']; ?>
</div>
