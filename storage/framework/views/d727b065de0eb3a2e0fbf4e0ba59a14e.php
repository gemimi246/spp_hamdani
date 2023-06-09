

<?php $__env->startSection('content'); ?>
    <div class="card table-responsive">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0" style="font-size: 40px">
                <b><?php echo e($title); ?></b>
            </h5>
            
        </div>
        <div class="container mt-4 ">
            <table id="datatable" class="table table-striped ">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pemilik</th>
                        <th>Alamat</th>
                        <th>Nomor Telephon</th>
                        <th>Title</th>
                        <th>Nama Aplikasi</th>
                        <th>Logo</th>
                        <th>Copy Right</th>
                        <th>Versi</th>
             
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                    ?>
                    <?php $__currentLoopData = $aplikasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($no++); ?></td>
                            <td width="auto"><?php echo e($a->nama_owner); ?></td>
                            <td width="auto"><?php echo e($a->alamat); ?></td>
                            <td width="auto"><?php echo e($a->tlp); ?></td>
                            <td width="auto"><?php echo e($a->title); ?></td>
                            <td width="auto"><?php echo e($a->nama_aplikasi); ?></td>
                            <td width="auto"><?php echo e($a->logo); ?></td>
                            <td width="auto"><?php echo e($a->copy_right); ?></td>
                            <td width="auto"><?php echo e($a->versi); ?></td>
                         
                            
                            <td>
                                <a href="/aplikasi/edit/<?php echo e($a->id); ?>" type="button" class="btn btn-success">Edit</a>
                                
                            </td>
                            
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laravel\spp_hamdani\resources\views/backend/aplikasi/view.blade.php ENDPATH**/ ?>