@extends('backend.layout.base')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card table-responsive">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0" style="font-size: 40px">
                        <b>{{ $title }}</b>
                    </h5>
                    
                </div>
                <div class="container mt-4 ">
                    <table id="datatable" class="table table-striped ">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>Tahun</th>
                                <th>Jenis Pembayaran</th>
                                <th>Nilai</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($spp as $a)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td width="auto">{{ $a->nama_lengkap }}</td>
                                    <td width="auto">{{ $a->tahun }}</td>
                                    <td width="auto">{{ $a->pembayaran }}</td>
                                    <td width="auto">{{ $a->nilai }}</td>
                                    <td width="auto">{{ $a->status }}</td>
                                    <td width="auto">{{ $a->created_at }}</td>
                                    <td>

                                        <a href="/siswa/edit/{{ $a->id }}" type="button"
                                            class="btn btn-success">Edit</a>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $a->id }}">Delete</button>
                                    </td>
                                    <div class="modal fade" id="delete{{ $a->id }}" tabindex="-1" role="dialog"
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
                                                        <p>Anda yakin ingin menghapus {{ $a->jenis_pembayaran }}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <a href="{{ url('/siswa/delete', $a->id) }} "
                                                            class="btn btn-primary">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-3">



            <div class="card table-responsive">
                <div class="card-header">
                    <h4 class="card-title">Pembayaran</h4>
                </div>
                <div class="card-body">
                    <form id="form-spp" class="" method="post" action="">
                        <div class="row">
                            <div class="col-md-12">
                               
                                    <!--<div class="col-lg-5">-->

                                    <select class="form-control selectpicker" title="Bulan" name="bulan[]" id="bulan"
                                        data-actions-box="true" data-virtual-scroll="false" data-live-search="true" multiple
                                        required>
                                        <option value=""></option>
                                    </select>
                                    <br>
                            </div>
                            <div class="col-md-12">
                                <div class="form-control">
                                    <label>Jumlah Total</label>
                                    <td colspan="4"><b name="total" id="total">Rp.</b>
                                    </td>
                                </div>
                                <br>
                            </div>
                            <div class="col-md-12">
                                    <select id="metode-pembayaran" class="form-control" name="metode_pembayaran" required>
                                        <option value="">Pilih Metode Pembayaran</option>
                                        <option value="Online">Online</option>
                                        <option value="Manual">Bayar Ditempat</option>
                                    </select>
                            </div>
                            <div class="col-md-12">
                                <div class="form-body">
                                    <br><br> &nbsp;<input type="submit" name="bayar" value="BAYAR"
                                        class="btn btn-primary mb-2">
                                    <a class="btn btn-info mb-2" href="/pembayaran/search?&thajaran_id={{$thajaran_id}}&user_id={{$user_id}}">Kembali</a>
                                </div>
                            </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
