<div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
	<div>
		<h2 class="fw-bold mb-1">Mahasiswa</h2>
		<p class="text-secondary mb-0">Daftar data mahasiswa.</p>
	</div>
	<a href="<?php echo URL; ?>/mahasiswa/input" class="btn btn-primary align-self-start">
		<i class="bi bi-person-plus me-1"></i> Input Mahasiswa
	</a>
</div>

<div class="card border-0 shadow-sm">
	<div class="table-responsive">
		<table class="table table-hover align-middle mb-0">
			<thead class="table-light">
				<tr>
					<th>NO</th>
					<th>NIM</th>
					<th>NAMA</th>
					<th>ALAMAT</th>
					<th>AKSI</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($data['rows'] as $row) { ?>
					<tr>
						<td><?php echo $row['mhsw_id']; ?></td>
						<td><?php echo $row['mhsw_nim']; ?></td>
						<td><?php echo $row['mhsw_nama']; ?></td>
						<td><?php echo $row['mhsw_alamat']; ?></td>
						<td>
							<div class="d-flex gap-2">
								<a href="<?php echo URL; ?>/mahasiswa/edit/<?php echo $row['mhsw_id']; ?>" class="btn btn-warning btn-sm">
									<i class="bi bi-pencil-square"></i> Edit
								</a>
								<form action="<?php echo URL; ?>/mahasiswa/delete/<?php echo $row['mhsw_id']; ?>" method="post" onsubmit="return confirm('Yakin ingin menghapus data?')">
									<button type="submit" class="btn btn-danger btn-sm">
										<i class="bi bi-trash"></i> Delete
									</button>
								</form>
							</div>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
