@extends('backend.layout.base')

@section('content')
    <div class="card table-responsive">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0" style="font-size: 40px">
                <b>{{ $title }}</b>
            </h5>

        </div>

        <div class="row ">
            
            <div class="col-md-5 ">
                
                <div class="row justify-content-end">
                  
                    
                    <div class="col-md-5">
                        
                        <select class="form-control" name="kelas_id_from" id="kelas_id_from" onchange="tampil_data()"
                            required>
                            <option value="" selected>-- Pilih Kelas --</option>
                            @foreach ($kelas as $s)
                                <option value="{{ $s->id }}">{{ $s->nama_kelas }}</option>
                            @endforeach
                        </select>

                    </div>
                    {{-- <label class="form-label" for="kelas_id">Kelas</label> --}}
                    <div class="col-md-5">
                        {{-- <label class="form-label" for="kelas_id">Kelas</label> --}}
                        <select class="form-control" name="jurusan_id_from" id="jurusan_id_from" onchange="tampil_data()"
                            required>
                            <option value="" selected>-- Pilih Jurusan --</option>
                            @foreach ($jurusan as $j)
                                <option value="{{ $j->id }}">{{ $j->nama_jurusan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="col-md-2 mb-3">
                
                <button class="btn btn-primary" id="movekelasbyId" style="width: 100%;">Move</button>
            </div>
            <div class="col-md-5">
                <div class="row">
                   
                    <div class="col-md-5">
                        {{-- <label class="form-label" for="kelas_id">Kelas</label> --}}
                        <select class="form-control" name="kelas_id_from" id="kelas_id_from" onchange="tampil_data()"
                            required>
                            <option value="" selected>-- Pilih Kelas --</option>
                            @foreach ($kelas as $s)
                                <option value="{{ $s->id }}">{{ $s->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        {{-- <label class="form-label" for="kelas_id">Kelas</label> --}}
                        <select class="form-control" name="jurusan_id_from" id="jurusan_id_from" onchange="tampil_data()"
                            required>
                            <option value="" selected>-- Pilih Jurusan --</option>
                            @foreach ($jurusan as $j)
                                <option value="{{ $j->id }}">{{ $j->nama_jurusan }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>
        </div>
        <br>


        <div class="row">
            
            <div class="col-md-6">
                
                <div class="container mt-4 ">
                    <h5 for="">From </h5>
                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAll"></th>
                                <th>No</th>
                                <th>Kelas</th>
                                <th>Nama Lengkap</th>
                            </tr>
                        </thead>
                        <tbody id="show_data">

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-6 ">
                <div class="container mt-4 float-end">
                    <h5 for="">To </h5>
                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAllTo"></th>
                                <th>No</th>
                                <th>Kelas</th>
                                <th>Nama Lengkap</th>
                            </tr>
                        </thead>
                        <tbody id="show_data">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <script>
        tampil_data();
        // $('#datatables').DataTable();
        function tampil_data() {

            // console.log($("#thajaran_id").val());
            $.ajax({
                type: 'GET',
                url: '{{ route('kelas.load_data_moveKelas') }}',
                async: true,
                data: {
                    jurusan_id: $("#jurusan_id").val(),
                    kelas_id: $("#kelas_id").val(),
                },
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    var no = 1;
                    for (i = 0; i < data.length; i++) {
                        html += '<tr>' +
                            '<td>' + '<input type="checkbox" class="checkbox" name="getid[]" value="' + data[
                                i].id + '">' +
                            '</td>' +
                            '<td>' + no++ + '</td>' +
                            '<td>' + data[i].nama_kelas + '</td>' +
                            '<td>' + data[i].nama_lengkap + '</td>' +
                            '</tr>';
                    }
                    $('#show_data').html(html);

                    // $('#datatable').DataTable();

                }
            });
        }
        $(document).ready(function() {
            // $(".checkbox").prop('checked', false);
            $('#checkAll').on('click', function(e) {
                console.log($(this).is(':checked', true));
                if ($(this).is(':checked', true)) {
                    // tampil_data();
                    $(".checkbox").prop('checked', true);
                } else {
                    // tampil_data();

                    $(".checkbox").prop('checked', false);
                }
                // tampil_data();
            });

            $('#movekelasbyId').on('click', function(e) {
                // console.log(e);
                var checkboxes_value = [];

                $('.checkbox').each(function() {
                    //if($(this).is(":checked")) { 
                    if (this.checked) {
                        checkboxes_value.push($(this).val());
                    }
                });
                checkboxes_value = checkboxes_value.toString();
                // console.log(checkboxes_value);
                $.ajax({

                    type: 'POST',
                    url: '{{ route('kelas.moveproses') }}',
                    async: true,
                    data: {
                        _token: "{{ csrf_token() }}",
                        user_id: checkboxes_value,
                        kelas_id_from: $('#kelas_id_from').val(),
                        jurusan_id_from: $('#jurusan_id_from').val(),
                    },
                    dataType: 'json',
                    success: function(data) {

                    }
                });
            });
        })
    </script>
@endsection
