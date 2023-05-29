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
                                    <label class="form-label" for="thajaran_id">Tahun Ajaran</label>
                                    <select class="form-control" name="thajaran_id" id="thajaran_id" required>
                                        <option value="" selected>-- Pilih --</option>
                                        @foreach ($thajaran as $s)
                                            <option value="{{ $s->id }}">{{ $s->tahun }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="mb-3 nis">
                                    <label class="form-label" for="">Nis / Siswa</label>
                                    <select class="form-control selectpicker" name="user_id" id="user_id" required>
                                        <option value="" selected>-- Pilih --</option>

                                        @foreach ($getSiswa as $s)
                                            <option value="{{ $s->id }}">{{ $s->nama_lengkap }}</option>
                                        @endforeach

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
                                            <?php foreach ($siswa as $u) { ?>
                                            <tr>
                                                <td>Nis </td>
                                                <td>: <?php echo $u->nis; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Nama Lengkap</td>
                                                <td>: <span id="nm-santri"><?php echo $u->nama_lengkap; ?></span></td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>: <?php echo $u->email; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Nomor Telephone</td>
                                                <td>: <?php echo $u->no_tlp; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Lahir</td>
                                                <td>: <?php echo $u->tgl_lahir; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td>: <?php echo $u->alamat; ?></td>
                                            </tr>

                                            <?php } ?>
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
                                                        <a href="/pembayaran/spp/{{ $u->id}}" class="btn btn-primary">Bayar</a>
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
@endsection
