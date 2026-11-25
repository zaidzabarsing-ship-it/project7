
<div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
    <div>
        <h2 class="fw-bold mb-1">Dosen</h2>
        <p class="text-secondary mb-0">Daftar data dosen.</p>
    </div>

    <a href="<?php echo URL; ?>/dosen/input" class="btn btn-primary align-self-start">
        <i class="bi bi-person-plus me-1"></i> Input Dosen
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>NO</th>
                    <th>NIP</th>
                    <th>NAMA</th>
                    <th>GOLONGAN</th>
                    <th>AKSI</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($data['rows'])) { ?>
                    <?php $no = 1; ?>

                    <?php foreach ($data['rows'] as $row) { ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($row['dosen_nip']); ?></td>
                            <td><?php echo htmlspecialchars($row['dosen_nama']); ?></td>
                            <td><?php echo htmlspecialchars($row['dosen_golongan'] ?? ''); ?></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="<?php echo URL; ?>/dosen/edit/<?php echo $row['dosen_id']; ?>"
                                       class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    <form action="<?php echo URL; ?>/dosen/delete/<?php echo $row['dosen_id']; ?>"
                                          method="post"
                                          onsubmit="return confirm('Yakin ingin menghapus data dosen ini?')">
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>

                <?php } else { ?>
                    <tr>
                        <td colspan="5" class="text-center text-secondary py-4">
                            Belum ada data dosen.
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
