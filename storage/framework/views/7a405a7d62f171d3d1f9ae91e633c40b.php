<?php $__env->startSection('content'); ?>
    <div class="card table-responsive">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0" style="font-size: 40px">
                <b><?php echo e($title); ?></b>
            </h5>
            <a href="/tagihanAdd" type="button" class="btn rounded-pill btn-primary justify-content-end"
                style="margin-left: 70%;">Add</a>
        </div>
        <div class="container mt-4 ">
            <table id="datatable" class="table table-striped ">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User</th>
                        <th>Kelas</th>
                        <th>Tahun Ajaran</th>
                        <th>Jenis Pembayaran</th>
                        <th>Nilai</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                    ?>
                    <?php $__currentLoopData = $tagihan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($no++); ?></td>
                            <td width="auto"><?php echo e($a->nama_lengkap); ?></td>
                            <td width="auto"><?php echo e($a->nama_kelas); ?></td>
                            <td width="auto"><?php echo e($a->tahun); ?></td>
                            <td width="auto"><?php echo e($a->pembayaran); ?></td>
                            <td width="auto">Rp. <?php echo e(number_format($a->nilai)); ?></td>
                            <td width="auto"><?php echo e($a->status); ?></td>
                            <td width="auto"><?php echo e($a->created_at); ?></td>
                            <td>

                                <a href="/siswa/edit/<?php echo e($a->id); ?>" type="button" class="btn btn-success">Edit</a>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#delete<?php echo e($a->id); ?>">Delete</button>
                            </td>
                            <div class="modal fade" id="delete<?php echo e($a->id); ?>" tabindex="-1" role="dialog"
                                aria-labelledby="deletemodal" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addNewDonaturLabel">Hapus Siswa
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Anda yakin ingin menghapus <?php echo e($a->jenis_pembayaran); ?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <a href="<?php echo e(url('/tagihan/delete', $a->id)); ?> "
                                                    class="btn btn-primary">Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laravel\spp_hamdani\resources\views/backend/tagihan/view.blade.php ENDPATH**/ ?>