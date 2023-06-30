<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-9">
            <div class="card table-responsive">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0" style="font-size: 40px">
                        <b><?php echo e($title); ?></b>
                    </h5>

                </div>
                <div class="container mt-4 ">
                    <table id="data" class="table table-striped ">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tahun</th>
                                <th>Nilai</th>
                                <th>Status</th>
                                <th>Invoice</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                            ?>
                            <?php $__currentLoopData = $spp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($no++); ?></td>
                                    <td width="auto"><?php echo e($a->nama_lengkap); ?></td>
                                    <td width="20%"><?php echo e($a->nama_bulan); ?> <?php echo e($a->tahun); ?></td>
                                    <td width="auto">Rp. <?php echo e(number_format($a->nilai)); ?></td>
                                    <td width="auto"><?php echo e($a->status); ?></td>
                                    <td width="auto">
                                        <?php if($a->status == 'Pending'): ?>
                                            <a href="<?php echo e($a->pdf_url); ?>" class="btn btn-success"
                                                target="_blank">Invoice</a>
                                        <?php elseif($a->status == 'Lunas'): ?>
                                            <a href="/bulananPdfById/<?php echo e($a->id); ?>" target="_blank"
                                                                    class="btn btn-danger">PDF</a>
                                        <?php endif; ?>
                                    </td>
                                    <td width="auto"><?php echo e($a->created_at); ?></td>
                                    <td>
                                        <?php if($a->status == 'Pending'): ?>
                                            <button type="button" class="btn rounded-pill btn-icon btn-outline-danger"
                                                data-bs-toggle="modal" data-bs-target="#delete<?php echo e($a->id); ?>">
                                                <span class="fa fa-trash"></span>
                                            </button>
                                        <?php endif; ?>
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
                                                        <p>Anda yakin ingin menghapus <?php echo e($a->pembayaran); ?></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <a href="<?php echo e(url('/siswa/delete', $a->id)); ?> "
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
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pembayaran</h4>
                </div>
                <div class="card-body">
                    <form id="payment-form" class="" method="post" action="/sppAddProses">
                        <?php echo csrf_field(); ?>
                        <input type="text" name="tagihan_id" id="" value="<?php echo e($tagihan_id); ?>" hidden>
                        <input type="text" name="getNilai" id="" value="<?php echo e($getNilai); ?>" hidden>
                        <input type="text" name="kelas_id" id="" value="<?php echo e($kelas_id); ?>" hidden>
                        <input type="text" name="user_id" id="" value="<?php echo e($user_id); ?>" hidden>
                        
                        <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
                        <input type="hidden" name="result_type" id="result-type" value="">
                        <input type="hidden" name="result_data" id="result-data" value="">
                        <div class="row">


                            <div class="col-md-12">
                                <label>Bulan</label>
                                <select class="form-control selectpicker" title="Bulan" name="bulan[]" id="bulan"
                                    data-actions-box="true" data-virtual-scroll="false" data-live-search="true" multiple
                                    required>
                                    <?php $__currentLoopData = $bulan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($b->id); ?>"><?php echo e($b->nama_bulan); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <br>
                            </div>
                            <div class="col-md-12">

                                <label>Jumlah Total</label>
                                <td colspan="4"><b><input class="form-control" type="text" name="nilai"
                                            id="total" readonly></b>
                                </td>

                                <br>
                            </div>
                            <div class="col-md-12">
                                <label>Pembayaran</label>
                                <select id="metode_pembayaran" class="form-control" name="metode_pembayaran" required>
                                    <option value="">Pilih Metode Pembayaran</option>
                                    <?php if(request()->user()->role != 1): ?>
                                        <option value="Online">Online</option>
                                    <?php else: ?>
                                        <option value="Manual">Manual</option>
                                    <?php endif; ?>

                                </select>
                            </div>
                            <div class="col-md-12">
                                <div class="form-body">
                                    <br><br> &nbsp;<button type="submit" name="bayar" id="pay-button"
                                        class="btn btn-primary mb-2">BAYAR</button>
                                    <a class="btn btn-info mb-2"
                                        href="/pembayaran/search?&kelas_id=<?php echo e($kelas_id); ?>&nis=<?php echo e($nis); ?>">Kembali</a>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#bulan').change(function() {
                // console.log(nilai);
                var total = parseInt($('#bulan').val().length) * parseInt(<?php echo e($getNilai); ?>);
                var reverse = total.toString().split('').reverse().join(''),
                    ribuan = reverse.match(/\d{1,3}/g);
                ribuan = ribuan.join('.').split('').reverse().join('');
                $("#total").val('Rp. ' + ribuan);
            })
        })
    
    </script>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="<?php echo e(Helper::apk()->clientKey); ?>"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript">
        $('#pay-button').click(function(event) {
            if ($('#metode_pembayaran').val() == "Online") {
                event.preventDefault();
                $(this).attr("disabled", "disabled");
                var _total = $('#total').val();
                $.ajax({
                    method: "POST",
                    url: '/getToken',
                    cache: false,
                    data: {
                        _token: $('#_token').val(),
                        total: _total.replace("Rp.", '').replace(".", '').replace(".", '')

                    },
                    success: function(data) {
                        //location = data;
                        console.log('token = ' + data);

                        var resultType = document.getElementById('result-type');
                        var resultData = document.getElementById('result-data');

                        function changeResult(type, data) {
                            $("#result-type").val(type);
                            $("#result-data").val(JSON.stringify(data));
                            //resultType.innerHTML = type;
                            //resultData.innerHTML = JSON.stringify(data);
                        }
                        snap.pay(data, {

                            onSuccess: function(result) {
                                changeResult('success', result);
                                console.log(result.status_message);
                                console.log(result);
                                $("#payment-form").submit();
                            },
                            onPending: function(result) {
                                changeResult('pending', result);
                                console.log(result.status_message);
                                $("#payment-form").submit();
                            },
                            onError: function(result) {
                                changeResult('error', result);
                                console.log(result.status_message);
                                $("#payment-form").submit();
                            }
                        });
                    }
                });
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laravel\spp_hamdani\resources\views/backend/pembayaran/spp.blade.php ENDPATH**/ ?>