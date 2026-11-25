<div class="mb-4">
	<h2 class="fw-bold mb-1">Edit Mahasiswa</h2>
	<p class="text-secondary mb-0">Perbarui data mahasiswa.</p>
</div>

<div class="row">
	<div class="col-12 col-lg-7">
		<div class="card border-0 shadow-sm">
			<div class="card-body p-4">
				<form action="<?php echo URL; ?>/mahasiswa/update" method="post">
					<input type="hidden" name="mhsw_id" value="<?php echo $data['row']['mhsw_id']; ?>">
					<div class="mb-3">
						<label for="mhsw_nim" class="form-label">NIM</label>
						<input type="text" class="form-control" id="mhsw_nim" name="mhsw_nim" value="<?php echo $data['row']['mhsw_nim']; ?>">
					</div>
					<div class="mb-3">
						<label for="mhsw_nama" class="form-label">Nama</label>
						<input type="text" class="form-control" id="mhsw_nama" name="mhsw_nama" value="<?php echo $data['row']['mhsw_nama']; ?>">
					</div>
					<div class="mb-3">
						<label for="mhsw_alamat" class="form-label">Alamat</label>
						<textarea class="form-control" id="mhsw_alamat" name="mhsw_alamat" rows="4"><?php echo $data['row']['mhsw_alamat']; ?></textarea>
					</div>
					<div class="d-flex gap-2">
						<button type="submit" class="btn btn-primary">
							<i class="bi bi-floppy me-1"></i> Update
						</button>
						<a href="<?php echo URL; ?>/mahasiswa" class="btn btn-secondary">
							<i class="bi bi-x-circle me-1"></i> Batal
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
