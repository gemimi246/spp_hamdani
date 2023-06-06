@extends('backend.layout.base')

@section('content')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0" style="font-size: 40px">{{ $title }}</h5>
                </div>
                @foreach ($payment as $p)
                    <div class="card-body">
                        <form action="/kelas/proses" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="full_name">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" value="{{$p->nama_lengkap}}"
                                            placeholder="Masukan Nama Kelas" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="full_name">Pembayaran</label>
                                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{$p->pembayaran}}"
                                            placeholder="Masukan Keterangan" required />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <br>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="/siswa" type="button" class="btn btn-success">Kembali</a>
                                </div>
                        </form>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection
