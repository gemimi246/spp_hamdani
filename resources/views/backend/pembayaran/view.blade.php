@extends('backend.layout.base')

@section('content')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0" style="font-size: 40px">{{ $title }}</h5>
                </div>
                <div class="card-body">
                    <form action="/pembayaran/search" method="GET" enctype="multipart/form-data">
                        @csrf
                        <div class="row">



                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label class="form-label" for="kelas_id">Kelas</label>
                                    <select class="form-control" name="kelas_id" id="kelas_id" required>
                                        <option value="" selected>-- Pilih --</option>
                                        @foreach ($kelas as $s)
                                            <option value="{{ $s->id }}">{{ $s->nama_kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="mb-3 nis">
                                    <label class="form-label" for="">Nis / Siswa</label>
                                    <select class="form-control" name="user_id" id="user_id" data-live-search="true" required>
                                        <option value="" selected>-- Pilih --</option>



                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <br>
                                <button type="submit" class="btn btn-primary">Cari</button>
                                <a href="/pembayaran" type="button" class="btn btn-danger">refresh</a>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl">
            <div class="card mb-4">
                @if ($siswa != null)
                    <div class="card-body">
                        <div class="card shadow mb-4 border-bottom-success" id="infosantri" value="0">
                            <!-- Card Header - Accordion -->
                            <a href="#informasisantri" class="d-block bg-success border border-success card-header py-3"
                                data-toggle="collapse" role="button" aria-expanded="true"
                                aria-controls="collapseCardExample">
                                <h6 class="m-0 font-weight-bold text-white">Informasi Siswa</h6>
                            </a>
                            <!-- Card Content - Collapse -->
                            <div class="collapse show" id="informasisantri">
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <tbody>

                                            <tr>
                                                <td>Nis </td>
                                                <td>: <?php echo $siswa->nis; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Nama Lengkap</td>
                                                <td>: <span id="nm-santri"><?php echo $siswa->nama_lengkap; ?></span></td>
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
                @else
                @endif
                @if ($pembayaran_bulanan != null)
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
                                                    <th>Status Bayar</th>
                                                    <th>Bayar</th>
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
                                                    <td></td>
                                                    <td>

                                                    <td>
                                                        <a href="/pembayaran/spp/{{ $u->id }}"
                                                            class="btn btn-primary">Bayar</a>
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
                                                    <th>Status Bayar</th>
                                                    <th>Bayar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                            $id = 1;

                            foreach ($pembayaran_lainya as $u) {
                            ?>
                                                <tr>
                                                    <td><?php echo $id++; ?></td>
                                                    <td><?php echo $u->tahun; ?></td>
                                                    <td><?php echo $u->pembayaran; ?></td>
                                                    <td></td>
                                                    <td>

                                                    <td>
                                                        <a href="/pembayaran/payment/{{ $u->id }}"
                                                            class="btn btn-primary">Bayar</a>
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
                @else
                @endif
            </div>
        </div>
    </div>
    <script>
        $('#kelas_id').change(function() {
            var klsid = $(this).val();
            if (klsid) {
                $.ajax({
                    type: "GET",
                    url: "/siswaByKelas/" + klsid,
                    dataType: 'JSON',
                    success: function(res) {
                        if (res) {
                            $("#user_id").empty();
                            $("#user_id").append('<option>---Pilih Siswa---</option>');
                            $.each(res, function(kode, value) {
                                // console.log(nama_lengkap.nama_lengkap);
                                $("#user_id").append('<option value="' + value.id + '">' + value.nama_lengkap +
                                    '</option>');
                            });
                        } else {
                            $("#user_id").empty();
                        }
                    }
                });
            } else {
                $("#user_id").empty();
            }
        });
    </script>
@endsection
