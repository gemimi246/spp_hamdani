@extends('backend.layout.base')

@section('content')

<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0" style="font-size: 40px">{{ $title }}</h5>
            </div>
            <div class="card-body">
                <form action="/tagihan/add" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">


                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="thajaran_id">Tahun Ajaran</label>
                                <select class="form-control" name="thajaran_id" id="thajaran_id" required>
                                    <option value="">-- Pilih --</option>
                                    @foreach ($thajaran as $s)
                                    <option value="{{ $s->id }}">{{ $s->tahun }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="jenis_pembayaran">Jenis Pembayaran</label>
                                <select class="form-control" name="jenis_pembayaran" id="jenis_pembayaran" required>
                                    <option value="">-- Pilih --</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="user_id">Nis / Siswa</label>
                                <select class="form-control selectpicker" name="user_id[]" id="user_id" data-actions-box="true" data-virtual-scroll="false" data-live-search="true" multiple required>

                                    @foreach ($siswa as $s)
                                    <option value="{{ $s->id }}">{{ $s->nama_lengkap }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="nilai">Nominal</label>
                                <input type="number" class="form-control" id="nilai" name="nilai" placeholder="Masukan Nilai" required />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <br>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="/tagihan" type="button" class="btn btn-success">Kembali</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function onChangeSelect(url, id, name) {
        // send ajax request to get the cities of the selected province and append to the select tag
        console.log(id);
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                id: id
            },
            success: function(data) {
                $('#' + name).empty();
                $('#' + name).append('<option>-- Pilih Salah Satu --</option>');
                console.log(name);
                $.each(data, function(key, value) {

                    $('#' + name).append('<option value="' + key.id + '">' + value.jenis_pembayaran + '</option>');
                });
            }
        });
    }
    $(function() {
        $('#thajaran_id').on('change', function() {
            onChangeSelect('{{ route("jenisPembayaran") }}', $(this).val(), 'jenis_pembayaran');
        });
    });
    $(function() {
        $('#thajaran_id').on('change', function() {
            onChangeSelect('{{ route("jenisPembayaran") }}', $(this).val(), 'jenis_pembayaran');
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
@endsection