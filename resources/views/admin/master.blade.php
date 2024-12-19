<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Administrator Vestnet</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/js/select.dataTables.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/quill/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/simplemde/simplemde.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vertical-layout-light/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/owl-carousel-2/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/owl-carousel-2/owl.theme.default.min.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/img/all-img/favicon.png')}}" />

    <link href="{{ asset('assets/admin/assets/bootstrap-table/bootstrap-table.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/assets/bootstrap-table/bootstrap-editable.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/assets/bootstrap-table/reorder-rows/bootstrap-table-reorder-rows.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/flag-icon-css/css/flag-icon.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/admin/dropify/dist/css/dropify.min.css') }}">
    @yield('css')
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <a class="navbar-brand brand-logo me-5" href="{{ url('administrator/dashboard/') }}">
                    <img src="{{ asset('assets/img/logo/logo-admin.png')}}" class="me-2" alt="" width="100px" height="50px">
                </a>
                <a class="navbar-brand brand-logo-mini" href="{{ url('administrator/dashboard/') }}">
                    <img src="{{ asset('assets/img/logo/logo-admin-2.png')}}" class="me-2" alt="" width="100px" height="50px">
                </a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                            <img src="{{ asset('assets/admin/images/logo_user.png') }}" alt="profile" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="{{ url('/administrator/logout') }}"
                                onclick="event.preventDefault(); document.getElementById('submit-form').submit();">
                                <i class="ti-power-off text-primary"></i>
                                Logout
                            </a>
                            <form id="submit-form" action="{{ url('/administrator/logout') }}" method="POST"
                                class="hidden">
                                @csrf
                                <input type="text" name="user_id" id="user_id" value="{{ Auth::user()->id }}" hidden>
                            </form>

                        </div>
                    </li>

                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            @include('admin.sidebar_menu')
            <!-- partial -->
            <div class="main-panel" style="flex-grow: 1;">
                @yield('content')
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © {{ Session::get('tahun') }}. <a href="{{ url('/') }}" target="_blank">Vestnet.</a> All rights reserved.</span>
                        {{-- <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ms-1"></i></span> --}}
                    </div>
                </footer>
            </div>
        </div>
        <!-- content-wrapper ends -->
            
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script src="{{ asset('assets/admin/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/owl-carousel-2/owl.carousel.min.js') }}"></script>

    <script src="{{ asset('assets/admin/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/select2/select2.min.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/admin/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/admin/js/dataTables.select.min.js') }}"></script>
    <script src="https://cdn.datatables.net/rowgroup/1.2.5/js/dataTables.rowGroup.min.js"></script>

    <script src="{{ asset('assets/admin/vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/simplemde/simplemde.min.js') }}"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/admin/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/admin/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/admin/js/template.js') }}"></script>
    <script src="{{ asset('assets/admin/js/settings.js') }}"></script>
    <script src="{{ asset('assets/admin/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('assets/admin/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/admin/js/Chart.roundedBarCharts.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('assets/admin/bootstrap-table/bootstrap-table.min.js') }}"></script>
    <script src="{{ asset('assets/admin/bootstrap-table/bootstrap-table-export.min.js') }}"></script>
    <script src="{{ asset('assets/admin/bootstrap-table/bootstrap-editable.min.js') }}"></script>
    <script src="{{ asset('assets/admin/bootstrap-table/bootstrap-table-editable.min.js') }}"></script>
    <script src="{{ asset('assets/admin/bootstrap-table/reorder-rows/bootstrap-table-reorder-rows.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/TableDnD/0.9.1/jquery.tablednd.js" integrity="sha256-d3rtug+Hg1GZPB7Y/yTcRixO/wlI78+2m08tosoRn7A=" crossorigin="anonymous"></script>

    <script src="{{ asset('assets/sweetalert/dist/sweetalert2.all.min.js') }}" type="text/javascript"></script>
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css"> --}}
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>


    <script src="{{ asset('assets/admin/js/file-upload.js') }}"></script>
    <script src="{{ asset('assets/admin/js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/admin/js/select2.js') }}"></script>
    <script src="{{ asset('assets/admin/js/editorDemo.js') }}"></script>
    <script src="{{ asset('assets/admin/js/owl-carousel.js') }}"></script>

    <script src="{{ asset('assets/admin/dropify/dist/js/dropify.min.js') }}"></script>
    <!-- End custom js for this page-->
    @yield('js')
</body>

</html>
