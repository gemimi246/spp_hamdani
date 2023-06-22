<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-mb">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0" style="font-size: 40px"><?php echo e($title); ?></h5>
                </div>
                <div class="card-body">
                    <?php if(request()->user()->role != 2): ?>
                        <form action="/pembayaran/search" method="GET" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label class="form-label" for="kelas_id">Kelas</label>
                                        <select class="form-select" name="kelas_id" id="kelas_id" required>
                                            <option value="" selected>-- Pilih --</option>
                                            <?php $__currentLoopData = $kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($s->id); ?>"><?php echo e($s->nama_kelas); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div id="open" class="position-absolute top-0 start-50 translate-middle"
                                        style="margin-top: 5%">
                                        <div id="loading-image" class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="">Nis / Siswa</label>
                                        <select class="form-select" name="nis" id="nis"
                                            aria-label="Default select example"></select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <br>
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                    <a href="/pembayaran" type="button" class="btn btn-danger">refresh</a>
                                </div>
                        </form>
                    <?php endif; ?>
                </div>

            </div>
        </div>
        <div class="col-xl">
            <div class="card mb-4">
                <?php if($siswa != null): ?>
                    <div class="card-body">
                        <div class="card shadow mb-4 border-bottom-success" id="infosiswa" value="0">
                            <!-- Card Header - Accordion -->
                            <a href="#informasisiswa" class="d-block bg-success border border-success card-header py-3"
                                data-toggle="collapse" role="button" aria-expanded="true"
                                aria-controls="collapseCardExample">
                                <h6 class="m-0 font-weight-bold text-white">Informasi Siswa</h6>
                            </a>
                            <!-- Card Content - Collapse -->
                            <div class="collapse show" id="informasisiswa">
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <tbody>

                                            <tr>
                                                <td>Nis </td>
                                                <td>: <?php echo $siswa->nis; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Nama Lengkap</td>
                                                <td>: <span id="nm-siswa"><?php echo $siswa->nama_lengkap; ?></span></td>
                                            </tr>
                                            <tr>
                                                <td>Kelas</td>
                                                <td>: <?php echo $siswa->nama_kelas; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>: <?php echo $siswa->email; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Nomor Telephone</td>
                                                <td>: <?php echo $siswa->no_tlp; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Lahir</td>
                                                <td>: <?php echo $siswa->tgl_lahir; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td>: <?php echo $siswa->alamat; ?></td>
                                            </tr>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($pembayaran_bulanan != null): ?>
                    <div class="card-body">
                        <div class="card shadow mb-4 border-bottom-warning" id="tagihanbulanan" value="0">
                            <!-- Card Header - Accordion -->
                            <a href="#tagihanbulan" class="d-block bg-warning border border-warning card-header py-3"
                                data-toggle="collapse" role="button" aria-expanded="true"
                                aria-controls="collapseCardExample">
                                <h6 class="m-0 font-weight-bold text-white">Tagihan Bulanan</h6>
                            </a>
                            <!-- Card Content - Collapse -->

                            <div class="collapse show" id="tagihanbulan">

                                <div class="table-responsive">
                                    <div class="card-body">
                                        <table class="table table-striped" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>NO</th>
                                                    <th>Tahun Ajaran</th>
                                                    <th>Jenis Pembayaran</th>
                                                    <th>Dibayar</th>
                                                    <th class="text-center">Status Bayar</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                            $id = 1;

                            foreach ($pembayaran_bulanan as $u) {
                            ?>
                                                <tr>
                                                    <td><?php echo $id++; ?></td>
                                                    <td><?php echo $u->tahun; ?></td>
                                                    <td><?php echo $u->pembayaran; ?></td>
                                                    <td>Rp. <?php echo e(number_format($u->total_bayar)); ?></td>
                                                    <td class="text-center">
                                                        <?php if($u->status_bayar == 'Belum Lunas'): ?>
                                                            <span class="badge bg-label-danger" style="width: 57%;">Belum
                                                                Lunas</span>
                                                        <?php else: ?>
                                                            <span class="badge bg-label-primary"
                                                                style="width: 57%;">Lunas</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td hidden id="getidtagihan"><?php echo e($u->id); ?></td>

                                                    <td>
                                                        <?php if($u->status_bayar == 'Belum Lunas'): ?>
                                                            <a href="/pembayaran/spp/<?php echo e($u->id); ?>"
                                                                class="btn btn-primary">Bayar</a>
                                                        <?php else: ?>
                                                            <button onclick="printExcelById()"
                                                                class="btn btn-success">Excel</button>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if($pembayaran_lainya != null): ?>
                    <div class="card-body">
                        <div class="card shadow mb-4 border-bottom-info" id="tagihanlainya" value="0">
                            <!-- Card Header - Accordion -->
                            <a href="#tagihanlainya" class="d-block bg-info border border-info card-header py-3"
                                data-toggle="collapse" role="button" aria-expanded="true"
                                aria-controls="collapseCardExample">
                                <h6 class="m-0 font-weight-bold text-white">Tagihan Lainya</h6>
                            </a>
                            <!-- Card Content - Collapse -->

                            <div class="collapse show" id="tagihanlainya">
                                <div class="table-responsive">
                                    <div class="card-body">
                                        <table class="table table-striped" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>NO</th>
                                                    <th>Tahun Ajaran</th>
                                                    <th>Jenis Pembayaran</th>
                                                    <th>Dibayar</th>
                                                    <th class="text-center">Status Bayar</th>
                                                    <th>Bayar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                            $id = 1;

                            foreach ($pembayaran_lainya as $u) {
                            ?>
                                                <tr>
                                                    <td hidden id="getIdLainya"><?php echo e($u->id); ?></td>
                                                    <td><?php echo $id++; ?></td>
                                                    <td><?php echo $u->tahun; ?></td>
                                                    <td><?php echo $u->pembayaran; ?></td>

                                                    <td>
                                                        <?php if($u->status_payment == null): ?>
                                                            Rp. 0
                                                        <?php else: ?>
                                                            Rp. <?php echo e(number_format($u->nilai)); ?>

                                                        <?php endif; ?>
                                                    </td>
                                                    
                                                    <td class="text-center">
                                                        <?php if($u->status_payment == null): ?>
                                                            <span class="badge bg-label-danger" style="width: 57%;">Belum
                                                                Lunas</span>
                                                        <?php elseif($u->status_payment == 'Pending'): ?>
                                                            <span class="badge bg-label-warning"
                                                                style="width: 57%;">Pending</span>
                                                        <?php else: ?>
                                                            <span class="badge bg-label-primary"
                                                                style="width: 57%;">Lunas</span>
                                                        <?php endif; ?>
                                                    </td>

                                                    <td>
                                                        <?php if($u->status_payment == 'Pending'): ?>
                                                            <a href="<?php echo e($u->pdf_url); ?>" class="btn btn-success"
                                                                target="_blank">Invoice</a>
                                                        <?php elseif($u->status_payment == 'Lunas'): ?>
                                                            <button onclick="printExcelByIdLainya()"
                                                                class="btn btn-success" target="_blank">Excel</button>
                                                        <?php else: ?>
                                                            <a href="/pembayaran/payment/<?php echo e($u->id); ?>"
                                                                class="btn btn-primary">Bayar</a>
                                                        <?php endif; ?>

                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script>
        $("#loading-image").hide();
        $('#kelas_id').change(function() {
            var klsid = $(this).val();
            if (klsid) {
                $.ajax({
                    type: "GET",
                    url: "/siswaByKelas/" + klsid,
                    dataType: 'JSON',
                    beforeSend: function() {
                        $("#loading-image").show();
                        
                    },
                    success: function(res) {
                        if (res) {
                            $("#nis").empty();
                            $("#nis").append('<option>---Pilih Siswa---</option>');
                            $.each(res, function(kode, value) {
                                $("#nis").append('<option value="' + value.nis + '">' + value
                                    .nama_lengkap +
                                    '</option>');
                            });
                        } else {
                            $("#nis").empty();
                        }
                        $("#loading-image").hide();
                    }
                });
            } else {
                $("#nis").empty();
            }
        });

        function printExcelById() {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "<?php echo e(url('cetakExcelById')); ?>/",
                data: {
                    tagihan_id: $("#getidtagihan").text(),
                },

                success: function(response) {
                    // console.log(response.file);
                    window.open(response.file, '_blank');
                },
                error: function() {
                    alert("error");
                }
            });
            return false;
        }

        function printExcelByIdLainya() {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "<?php echo e(url('cetakExcelById')); ?>/",
                data: {
                    tagihan_id: $("#getIdLainya").text(),
                },

                success: function(response) {
                    // console.log(response.file);
                    window.open(response.file, '_blank');
                },
                error: function() {
                    alert("error");
                }
            });
            return false;
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laravel\spp_hamdani\resources\views/backend/pembayaran/view.blade.php ENDPATH**/ ?>