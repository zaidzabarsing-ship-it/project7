<div class="card border-0 shadow-sm login-card">
	<div class="card-body p-4 p-md-5">
		<div class="text-center mb-4">
			<i class="bi bi-person-circle text-primary display-4"></i>
			<h2 class="fw-bold mt-2 mb-1">Login</h2>
			<p class="text-secondary mb-0">Masuk ke dashboard Sistem Akademik.</p>
		</div>

		<?php if ($data['error']) { ?>
			<div class="alert alert-danger">
				<i class="bi bi-exclamation-circle me-1"></i> <?php echo $data['error']; ?>
			</div>
		<?php } ?>

		<form action="<?php echo URL; ?>/auth/proses" method="post">
			<div class="mb-3">
				<label for="user_email" class="form-label">Email</label>
				<div class="input-group">
					<span class="input-group-text"><i class="bi bi-envelope"></i></span>
					<input type="email" class="form-control" id="user_email" name="user_email" placeholder="admin@mail.com" required>
				</div>
			</div>
			<div class="mb-4">
				<label for="user_password" class="form-label">Password</label>
				<div class="input-group">
					<span class="input-group-text"><i class="bi bi-lock"></i></span>
					<input type="password" class="form-control" id="user_password" name="user_password" placeholder="Masukkan password" required>
				</div>
			</div>
			<button type="submit" class="btn btn-primary w-100">
				<i class="bi bi-box-arrow-in-right me-1"></i> Login
			</button>
		</form>
	</div>
</div>
