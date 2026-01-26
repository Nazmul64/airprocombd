<!doctype html>
<html lang="en" class="semi-dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('backend/assets/images/favicon-32x32.png') }}" type="image/png" />

    <!-- Plugins CSS -->
    <link href="{{ asset('backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet"/>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/css/icons.css') }}" rel="stylesheet" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Theme Styles -->
    <link href="{{ asset('backend/assets/css/dark-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/css/light-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/css/semi-dark.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/css/header-colors.css') }}" rel="stylesheet" />

    <!-- Custom CSS -->
    <link href="{{ asset('backend/assets/css/custom.css') }}" rel="stylesheet" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">


    <!-- Toastr & Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


    <!-- Page Title -->
    <title>Admin Dashboard</title>

    <!-- Toastr Notifications -->
    @if (Session::has('success') || Session::has('error'))
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    timeOut: 5000
                };

                @if (Session::has('error'))
                    toastr.error("{{ Session::get('error') }}");
                @endif

                @if (Session::has('success'))
                    toastr.success("{{ Session::get('success') }}");
                @endif
            });
        </script>
    @endif
</head>
<body>
    <!-- Wrapper -->
    <div class="wrapper">
        <!-- Header -->
        @include('Admin.pages.header')

        <!-- Sidebar -->
        @include('Admin.pages.sidebar')

        <!-- Main Content -->
        <main class="page-content">
            @yield('content')
        </main>

        <!-- Overlay -->
        <div class="overlay nav-toggle-icon"></div>

        <!-- Back To Top -->
        <a href="javascript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>

        <!-- Theme Switcher -->
        <div class="switcher-body">
            <button class="btn btn-primary btn-switcher shadow-sm" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                <i class="bi bi-paint-bucket me-0"></i>
            </button>
            <div class="offcanvas offcanvas-end shadow border-start-0 p-2" data-bs-scroll="true"
                data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling">
                <div class="offcanvas-header border-bottom">
                    <h5 class="offcanvas-title">Theme Customizer</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    <h6 class="mb-0">Theme Variation</h6>
                    <hr>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="themeOption" id="LightTheme">
                        <label class="form-check-label" for="LightTheme">Light</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="themeOption" id="DarkTheme">
                        <label class="form-check-label" for="DarkTheme">Dark</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="themeOption" id="SemiDarkTheme" checked>
                        <label class="form-check-label" for="SemiDarkTheme">Semi Dark</label>
                    </div>
                    <hr>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="themeOption" id="MinimalTheme">
                        <label class="form-check-label" for="MinimalTheme">Minimal Theme</label>
                    </div>
                    <hr>
                    <h6 class="mb-0">Header Colors</h6>
                    <hr>
                    <div class="header-colors-indigators">
                        <div class="row row-cols-auto g-3">
                            @for ($i = 1; $i <= 8; $i++)
                                <div class="col">
                                    <div class="indigator headercolor{{ $i }}" id="headercolor{{ $i }}"></div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Dependencies -->
    <script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pace.min.js') }}"></script>

    <!-- ChartJS -->
    <script src="{{ asset('backend/assets/plugins/chartjs/js/Chart.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/chartjs/js/Chart.extension.js') }}"></script>

    <!-- ApexCharts -->
    <script src="{{ asset('backend/assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>

    <!-- Vector Maps -->
    <script src="{{ asset('backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

    <!-- App Scripts -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    <script src="{{ asset('backend/assets/js/index.js') }}"></script>
    <script src="{{ asset('backend/assets/js/chartjs.js') }}"></script>
    <script src="{{ asset('backend/assets/js/apexcharts.js') }}"></script>
    <script src="{{ asset('backend/assets/js/vector-maps.js') }}"></script>
    <script src="{{ asset('backend/assets/js/custom.js') }}"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {{-- jQuery --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- DataTables JS --}}
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>


    <script>
        new PerfectScrollbar(".review-list");
        new PerfectScrollbar(".chat-talk");
    </script>
    <script>
$(document).ready(function () {
    let table = $('#commissionTable').DataTable({
        pageLength: 10,
        lengthChange: false,
        ordering: true,
        responsive: true,
        dom: 'lrtip',
        language: {
            emptyTable: "❌ Sorry 😔 কোনো ডাটা পাওয়া যায়নি!",
            zeroRecords: "❌ Sorry 😔 মিলে যাওয়া কোনো রেকর্ড পাওয়া যায়নি!",
            info: "Total _TOTAL_ data",
            infoEmpty: "No data available",
            infoFiltered: "(filtered from _MAX_ total records)"
        }
    });

    let typingTimer;
    let typingIndicator = $('#typingIndicator');

    $('#customSearchBox').on('keyup', function () {
        typingIndicator.show(); // Show typing...
        clearTimeout(typingTimer);

        let query = this.value;
        table.search(query).draw();

        // Hide typing... after 1 sec of inactivity
        typingTimer = setTimeout(function () {
            typingIndicator.hide();
        }, 1000);
    });
});
</script>
</body>
</html>
