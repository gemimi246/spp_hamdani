<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">

    <!--  Brand demo (display only for navbar-full and hide on below xl) -->

    <!-- ! Not required for layout-without-menu -->
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0  d-xl-none ">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

        <!-- Search -->
        
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Language -->


            <!--/ Language -->


            <!-- Style Switcher -->
            

            <!-- Notification -->
            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" aria-expanded="false">
                    <i class="bx bx-cart bx-sm"></i>
                    <span class="badge bg-danger rounded-pill badge-notifications">10</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end py-0">
                    <li class="dropdown-menu-header border-bottom">
                        <div class="dropdown-header d-flex align-items-center py-3">
                            <h5 class="text-body mb-0 me-auto">Cart</h5>
                            <a href="javascript:void(0)" class="dropdown-notifications-all text-body"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Mark all as read"><i
                                    class="bx fs-4 bx bx-cart bx-sm"></i></a>
                        </div>
                    </li>
                    <li class="dropdown-notifications-list scrollable-container">
                        <ul class="list-group list-group-flush">
                            
                        </ul>
                    </li>
                    <li class="dropdown-menu-footer border-top">
                        <a href="javascript:void(0);"
                            class="dropdown-item d-flex justify-content-center text-primary p-2 h-px-40">
                            View all Cart
                        </a>
                    </li>
                </ul>
            </li>
            <!--/ Notification -->

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <?php if(request()->user()->role == 1): ?>
                        <div class="avatar avatar-online">
                            <img src="<?php echo e(asset('')); ?>storage/images/users/<?php echo e(request()->user()->image); ?>"
                                alt="" class="w-px-40 rounded-circle">
                        </div>
                    <?php elseif(request()->user()->email_verified_at == null): ?>
                        <div class="avatar avatar-online">
                            <img src="<?php echo e(asset('/storage/images/users/users_.png')); ?>" alt=""
                                class="w-px-40 rounded-circle">
                        </div>
                    <?php else: ?>
                        <div class="avatar avatar-online">
                            <img src="<?php echo e(request()->user()->image); ?>" alt="" class="w-px-40 rounded-circle">
                        </div>
                    <?php endif; ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="/">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <?php if(request()->user()->role == 1): ?>
                                        <div class="avatar avatar-online">
                                            <img src="<?php echo e(asset('')); ?>storage/images/users/<?php echo e(request()->user()->image); ?>"
                                                alt="" class="w-px-40 rounded-circle">
                                        </div>
                                    <?php elseif(request()->user()->email_verified_at == null): ?>
                                        <div class="avatar avatar-online">
                                            <img src="<?php echo e(asset('/storage/images/users/users_.png')); ?>" alt=""
                                                class="w-px-40 rounded-circle">
                                        </div>
                                    <?php else: ?>
                                        <div class="avatar avatar-online">
                                            <img src="<?php echo e(request()->user()->image); ?>" alt=""
                                                class="w-px-40 rounded-circle">
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">
                                        <?php echo e(request()->user()->full_name); ?>

                                    </span>
                                    <?php if(request()->user()->role == 1): ?>
                                        <small class="text-muted">Admin</small>
                                    <?php else: ?>
                                        <small class="text-muted">Anggota</small>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item"
                            href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/pages/profile-user">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">My Profile</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item"
                            href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/invoice/list">
                            <i class="bx bx-credit-card me-2"></i>
                            <span class="align-middle">Billing</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="<?php echo e(route('logout')); ?>">
                            <i class='bx bx-log-in me-2'></i>
                            <span class="align-middle">Logout</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>

    <!-- Search Small Screens -->
    <div class="navbar-search-wrapper search-input-wrapper  d-none">
        <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..."
            aria-label="Search...">
        <i class="bx bx-x bx-sm search-toggler cursor-pointer"></i>
    </div>

</nav>
<!-- / Navbar -->
<?php /**PATH D:\laravel\spp_hamdani\resources\views/backend/layout/navbar.blade.php ENDPATH**/ ?>