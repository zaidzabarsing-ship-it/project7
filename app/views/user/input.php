<div class="mb-4">
	<h2 class="fw-bold mb-1">Input User</h2>
	<p class="text-secondary mb-0">Masukkan akun pengguna baru.</p>
</div>

<div class="row">
	<div class="col-12 col-lg-7">
		<div class="card border-0 shadow-sm">
			<div class="card-body p-4">
				<form action="<?php echo URL; ?>/user/simpan" method="post">
					<div class="mb-3">
						<label for="user_email" class="form-label">Email</label>
						<input type="email" class="form-control" id="user_email" name="user_email">
					</div>
					<div class="mb-3">
						<label for="user_password" class="form-label">Password</label>
						<input type="password" class="form-control" id="user_password" name="user_password">
					</div>
					<div class="mb-3">
						<label for="user_namalengkap" class="form-label">Nama Lengkap</label>
						<input type="text" class="form-control" id="user_namalengkap" name="user_namalengkap">
					</div>
					<div class="d-flex gap-2">
						<button type="submit" class="btn btn-primary">
							<i class="bi bi-floppy me-1"></i> Simpan
						</button>
						<a href="<?php echo URL; ?>/user" class="btn btn-secondary">
							<i class="bi bi-x-circle me-1"></i> Batal
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
