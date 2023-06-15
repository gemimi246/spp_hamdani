@extends('backend.layout.base', ['title' => 'Dashboard - Administrator - Laravel 9'])

@section('content')
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
                            <h6 class="card-title mb-1 text-nowrap">{{ $congrat }}
                                {{ request()->user()->nama_lengkap }}
                            </h6>
                            <small class="d-block mb-3 text-nowrap">Total Pembayaran</small>
                            <h5 class="card-title text-primary mb-1">Rp. {{ number_format($totalById) }}</h5>
                            {{-- <small class="d-block mb-4 pb-1 text-muted">78% of target</small> --}}
                            <a href="javascript:;" class="btn btn-sm btn-primary">View profile</a>
                        </div>
                    </div>
                    <div class="col-4 pt-3 ps-0">
                        <img src="{{ asset('') }}storage/images/users/{{ request()->user()->image }}" width="120" height="100"
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
                                        {{-- <span class="badge bg-label-warning rounded-pill">Year 2021</span> --}}
                                    </div>
                                    <div class="mt-sm-auto">
                                        {{-- <small class="text-success text-nowrap fw-semibold"><i class="bx bx-chevron-up"></i>
                                            68.2%</small> --}}
                                        <h3 class="mb-0">Rp. {{ number_format($totalBulanan) }}</h3>
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
                                        {{-- <span class="badge bg-label-warning rounded-pill">Year 2021</span> --}}
                                    </div>
                                    <div class="mt-sm-auto">
                                        {{-- <small class="text-success text-nowrap fw-semibold"><i class="bx bx-chevron-up"></i> --}}
                                        {{-- 68.2%</small> --}}
                                        <h3 class="mb-0">Rp. {{ number_format($totalLainya) }}</h3>
                                    </div>
                                </div>
                                <div id="profileReportChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-xl-3 col-lg-3 col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <h6 class="fw-normal">Total <b>{{$kepalasekolah}}</b> </h6>
                        <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                            @foreach ($kepalasekolahimage as $ksi)
                                
                            
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="{{ $ksi->nama_lengkap }}" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="{{ asset('') }}storage/images/users/{{ $ksi->image }}" alt="Avatar">
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="role-heading">
                            <h4 class="mb-1">Super Admin</h4>
                            <a href="/admin" 
                                class="role-edit-modal"><small>Edit Role</small></a>
                        </div>
                        <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <h6 class="fw-normal">Total {{$admintotal}}</h6>
                        <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                            @foreach ($adminimg as $aim)
                                
                           
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="{{ $ksi->nama_lengkap }}" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="{{ asset('') }}storage/images/users/{{ $ksi->image }}"  alt="Avatar">
                            </li>
                             @endforeach
                        </ul>
                    </div>
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="role-heading">
                            <h4 class="mb-1">Admin</h4>
                            <a href="/admin" 
                                class="role-edit-modal"><small>Edit Role</small></a>
                        </div>
                        <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <h6 class="fw-normal">Total {{$siswatotal}}</h6>
                        <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                            @foreach ($siswaimg as $aim)
                                
                           
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="{{ $ksi->nama_lengkap }}" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="{{ asset('') }}storage/images/users/{{ $ksi->image }}"  alt="Avatar">
                            </li>
                             @endforeach
                        </ul>
                    </div>
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="role-heading">
                            <h4 class="mb-1">Siswa</h4>
                            <a href="/siswa" 
                                class="role-edit-modal"><small>Edit Role</small></a>
                        </div>
                        <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <h6 class="fw-normal">Total All {{$alluserstotal}} Users</h6>
                        <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                            @foreach ($allusersimg as $aim)
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="{{ $ksi->nama_lengkap }}" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="{{ asset('') }}storage/images/users/{{ $ksi->image }}"  alt="Avatar">
                            </li>
                             @endforeach
                        </ul>
                    </div>
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="role-heading">
                            <h4 class="mb-1">User ALL</h4>
                            <a href="#" 
                                class="role-edit-modal"><small>Edit Role</small></a>
                        </div>
                        <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    <div class="report-list-item rounded-2 ">


        <!--/ Conversion rate -->

        <div class="row">
            <div class="col-md-12 col-lg-12 mb-4 mb-md-0">
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
                                @php
                                    $no = 1;
                                    $rank = 1;
                                @endphp
                                @foreach ($rankpayment as $rp)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            {{ $rp->nama_lengkap }}
                                        </td>
                                        <td>{{ $rp->nama_kelas }}</td>
                                        <td>
                                            {{ $rp->alamat }}
                                        </td>
                                        <td class="text-center"><span
                                                class="badge bg-label-primary ">{{ $rank++ }}</span></td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Total Balance -->

        </div>
    @endsection
