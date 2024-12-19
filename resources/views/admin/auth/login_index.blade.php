<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Administrator Vestnet</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/img/all-img/favicon.png')}}" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="{{ asset('assets/img/logo/logo.png')}}" alt="vestnet" width="150px">
                            </div>
                            <h4>Selamat datang!</h4>
                            <h6 class="font-weight-light">Masuk untuk melanjutkan.</h6>

                            <form class="pt-3" method="POST" action="{{ url('/administrator/login-attempt') }}">
                                @if (Session::get('error'))
                                    <div class="row grid-margin">
                                        <div class="col-12">
                                            <div class="alert alert-danger" role="alert">
                                                <span> {{ Session::get('error') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if (Session::has('message'))
                                    <div class="row grid-margin">
                                        <div class="col-12">
                                            <div class="alert alert-warning" role="alert">
                                                <span>{{ Session::get('message') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if (Session::has('success'))
                                    <div class="row grid-margin">
                                        <div class="col-12">
                                            <div class="alert alert-success" role="alert">
                                                <span>{{ Session::get('success') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <input type="username" class="form-control form-control-lg" id="username" name="username" placeholder="Email/Username">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password">
                                </div>
                                <div class="mt-3">
                                    @csrf
                                    <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"><span>LOGIN</span></button>
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input" id="remember_me"
                                                name="remember_me" value="1">Ingat saya</label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('assets/admin/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/admin/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/admin/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/admin/js/template.js') }}"></script>
    <script src="{{ asset('assets/admin/js/settings.js') }}"></script>
    <script src="{{ asset('assets/admin/js/todolist.js') }}"></script>
    <!-- endinject -->
</body>

</html>
