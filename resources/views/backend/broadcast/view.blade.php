@extends('backend.layout.base')

@section('content')
    <div class="row">
        <div class="col-mb">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0" style="font-size: 40px">{{ $title }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label class="form-label" for="no_tlp">Nis / Siswa</label>
                                <select class="form-control selectpicker" name="no_tlp[]" id="no_tlp"
                                    data-actions-box="true" data-virtual-scroll="false" data-live-search="true" multiple
                                    required>

                                    @foreach ($siswa as $s)
                                        <option value="{{ $s->no_tlp }}">{{ $s->nama_lengkap }} - {{ $s->no_tlp }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <label class="form-label" for="message">Pesan</label>
                        <div class="col-md-12">

                            <textarea name="message" id="message" cols="80" rows="10"></textarea>
                        </div>

                        <div class="col-md-2">
                            <br>
                            <div id="open" class="position-absolute top-0 start-50 translate-middle"
                                style="margin-top: 5%">
                                <div id="loading-image" class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                            <button id="sendBroadcast" onclick="broadcastSend()" class="btn btn-primary">Kirim </button>
                            <a href="/broadcast" type="button" class="btn btn-danger">refresh</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <script>
            $("#loading-image").hide();

            function broadcastSend() {
                $('#sendBroadcast').attr('disabled', true)
                var selectedItem = $('.selectpicker').val();
                console.log(selectedItem);
                $.ajax({
                    type: 'GET',
                    url: '{{ route('broadcast.sendMessage') }}',
                    async: true,
                    data: {
                        nomor: selectedItem,
                        message: $("#message").val(),
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        $("#loading-image").show();
                    },
                    success: function(data) {

                        $("#loading-image").hide();
                        $('#sendBroadcast').removeAttr('disabled');
                        // $('#datatable').DataTable();

                    }
                });
            }
        </script>
    @endsection
