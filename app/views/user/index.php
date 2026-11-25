<div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
	<div>
		<h2 class="fw-bold mb-1">User</h2>
		<p class="text-secondary mb-0">Daftar akun pengguna sistem.</p>
	</div>
	<a href="<?php echo URL; ?>/user/input" class="btn btn-primary align-self-start">
		<i class="bi bi-person-plus me-1"></i> Input User
	</a>
</div>

<div class="card border-0 shadow-sm">
	<div class="table-responsive">
		<table class="table table-hover align-middle mb-0">
			<thead class="table-light">
				<tr>
					<th>NO</th>
					<th>EMAIL</th>
					<th>NAMA LENGKAP</th>
					<th>DIBUAT</th>
					<th>AKSI</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($data['rows'] as $row) { ?>
					<tr>
						<td><?php echo $row['user_id']; ?></td>
						<td><?php echo $row['user_email']; ?></td>
						<td><?php echo $row['user_namalengkap']; ?></td>
						<td><?php echo $row['created_at']; ?></td>
						<td>
							<div class="d-flex gap-2">
								<a href="<?php echo URL; ?>/user/edit/<?php echo $row['user_id']; ?>" class="btn btn-warning btn-sm">
									<i class="bi bi-pencil-square"></i> Edit
								</a>
								<?php if ((int) $_SESSION['user_id'] !== (int) $row['user_id']) { ?>
									<form action="<?php echo URL; ?>/user/delete/<?php echo $row['user_id']; ?>" method="post" onsubmit="return confirm('Yakin ingin menghapus data?')">
										<button type="submit" class="btn btn-danger btn-sm">
											<i class="bi bi-trash"></i> Delete
										</button>
									</form>
								<?php } ?>
							</div>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
