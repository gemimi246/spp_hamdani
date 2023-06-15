<?php $__env->startSection('content'); ?>
    <?php
    
    date_default_timezone_set('Asia/Jakarta');
    
    $b = time();
    $hour = date('G', $b);
    
    if ($hour >= 0 && $hour <= 11) {
        $congrat = 'Selamat Pagi :)';
    } elseif ($hour >= 12 && $hour <= 14) {
        $congrat = 'Selamat Siang :) ';
    } elseif ($hour >= 15 && $hour <= 17) {
        $congrat = 'Selamat Sore :) ';
    } elseif ($hour >= 17 && $hour <= 18) {
        $congrat = 'Selamat Petang :) ';
    } elseif ($hour >= 19 && $hour <= 23) {
        $congrat = 'Selamat Malam :) ';
    }
    
    ?>
    <div class="row">
        <div class="col-md-12 col-lg-4 mb-4">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-8">
                        <div class="card-body">
                            <h6 class="card-title mb-1 text-nowrap"><?php echo e($congrat); ?>

                                <?php echo e(request()->user()->nama_lengkap); ?>

                            </h6>
                            <small class="d-block mb-3 text-nowrap">Total Pembayaran</small>
                            <h5 class="card-title text-primary mb-1">Rp. <?php echo e(number_format($totalById)); ?></h5>
                            
                            <a href="javascript:;" class="btn btn-sm btn-primary">View profile</a>
                        </div>
                    </div>
                    <div class="col-4 pt-3 ps-0">
                        <img src="<?php echo e(asset('storage/images/user/user.png')); ?>" width="120" height="100"
                            style="margin-bottom: 30%;" class="rounded-start" alt="">
                    </div>
                </div>
            </div>
        </div>
        <!-- New Visitors & Activity -->
        <div class="col-lg-8 mb-4">
            <div class="row">


                <div class="col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                    <div class="card-title">
                                        <h5 class="text-nowrap mb-2">Pembayaran Bulanan</h5>
                                        
                                    </div>
                                    <div class="mt-sm-auto">
                                        
                                        <h3 class="mb-0">Rp. <?php echo e(number_format($totalBulanan)); ?></h3>
                                    </div>
                                </div>
                                
                                <div id="profileReportChart"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                    <div class="card-title">
                                        <h5 class="text-nowrap mb-2">Pembayaran Lainya</h5>
                                        
                                    </div>
                                    <div class="mt-sm-auto">
                                        
                                            
                                        <h3 class="mb-0">Rp. <?php echo e(number_format($totalLainya)); ?></h3>
                                    </div>
                                </div>
                                <div id="profileReportChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ New Visitors & Activity -->



        <!-- Total Income -->

        <!--/ Total Income -->
    </div>

    <div class="report-list-item rounded-2">


        <!--/ Conversion rate -->

        <div class="row">
            <div class="col-md-6 col-lg-8 mb-4 mb-md-0">
                <div class="card">
                    <div class="table-responsive text-nowrap">
                        <table class="table text-nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Alamat</th>
                                    <th class="text-center">Rank Payment</th>

                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php
                                    $no = 1;
                                    $rank = 1;
                                ?>
                                <?php $__currentLoopData = $rankpayment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($no++); ?></td>
                                        <td>
                                            <?php echo e($rp->nama_lengkap); ?>

                                        </td>
                                        <td><?php echo e($rp->nama_kelas); ?></td>
                                        <td>
                                            <?php echo e($rp->alamat); ?>

                                        </td>
                                        <td class="text-center"><span
                                                class="badge bg-label-primary "><?php echo e($rank++); ?></span></td>

                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Total Balance -->
            <div class="col-md- col-lg-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Total Balance</h5>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="totalBalance" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalBalance">
                                <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-start">
                            <div class="d-flex pe-4">
                                <div class="me-3">
                                    <span class="badge bg-label-warning p-2"><i
                                            class="bx bx-wallet text-warning"></i></span>
                                </div>
                                <div>
                                    <h6 class="mb-0">$2.54k</h6>
                                    <small>Wallet</small>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="me-3">
                                    <span class="badge bg-label-secondary p-2"><i
                                            class="bx bx-dollar text-secondary"></i></span>
                                </div>
                                <div>
                                    <h6 class="mb-0">$4.2k</h6>
                                    <small>Paypal</small>
                                </div>
                            </div>
                        </div>
                        <div id="totalBalanceChart" class="border-bottom mb-3"></div>
                        <div class="d-flex justify-content-between">
                            <small class="text-muted">You have done <span class="fw-bold">57.6%</span> more
                                sales.<br>Check your new badge in your profile.</small>
                            <div>
                                <span class="badge bg-label-warning p-2"><i
                                        class="bx bx-chevron-right text-warning"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.base', ['title' => 'Dashboard - Administrator - Laravel 9'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laravel\spp_hamdani\resources\views/backend/dashboard/index.blade.php ENDPATH**/ ?>