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
                        <img src="{{ asset('storage/images/user/user.png') }}" width="120" height="100"
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
                        <h6 class="fw-normal">Total 4 users</h6>
                        <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Vinnie Mostowy" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="../../assets/img/avatars/5.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Allen Rieske" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="../../assets/img/avatars/12.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Julee Rossignol" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="../../assets/img/avatars/6.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Kaith D'souza" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="../../assets/img/avatars/15.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="John Doe" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="../../assets/img/avatars/1.png" alt="Avatar">
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="role-heading">
                            <h4 class="mb-1">Administrator</h4>
                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal"
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
                        <h6 class="fw-normal">Total 7 users</h6>
                        <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Jimmy Ressula" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="../../assets/img/avatars/4.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="John Doe" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="../../assets/img/avatars/1.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Kristi Lawker" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="../../assets/img/avatars/2.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Kaith D'souza" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="../../assets/img/avatars/15.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Danny Paul" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="../../assets/img/avatars/7.png" alt="Avatar">
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="role-heading">
                            <h4 class="mb-1">Manager</h4>
                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal"
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
                        <h6 class="fw-normal">Total 5 users</h6>
                        <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Andrew Tye" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="../../assets/img/avatars/6.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Rishi Swaat" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="../../assets/img/avatars/9.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Rossie Kim" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="../../assets/img/avatars/12.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Kim Merchent" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="../../assets/img/avatars/10.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Sam D'souza" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="../../assets/img/avatars/13.png" alt="Avatar">
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="role-heading">
                            <h4 class="mb-1">Users</h4>
                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal"
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
                        <h6 class="fw-normal">Total 3 users</h6>
                        <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Kim Karlos" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="../../assets/img/avatars/3.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Katy Turner" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="../../assets/img/avatars/9.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Peter Adward" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="../../assets/img/avatars/15.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Kaith D'souza" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="../../assets/img/avatars/10.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="John Parker" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="../../assets/img/avatars/11.png" alt="Avatar">
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="role-heading">
                            <h4 class="mb-1">Support</h4>
                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal"
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
