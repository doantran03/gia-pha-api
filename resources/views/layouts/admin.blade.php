<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>@yield('title', 'Dashboard - Gia Phả')</title>
        <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link href="{{ asset('assets/css/select2.css') }}" rel="stylesheet">
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        {{-- TOAST --}}
        @if(session('success') || session('error'))
            @php
                $message = session('success') ?? session('error');
                $type = session('success') ? 'success' : 'danger';
            @endphp
            <div class="toast-container position-fixed top-0 end-0 p-3">
                <div id="appToast" class="toast align-items-center text-bg-{{ $type }} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ $message }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
            </div>
        @endif

        {{-- HEADER --}}
        @include('layouts.partials.header')
        
        <div id="layoutSidenav">
            {{-- SIDEBAR --}}
            @include('layouts.partials.sidebar')
            
            <div id="layoutSidenav_content">
                {{-- MAIN CONTENT --}}
                <main>
                    <div class="container-fluid px-4">
                        @yield('content')
                    </div>
                </main>

                {{-- FOOTER --}}
                @include('layouts.partials.footer')
            </div>
        </div>

        {{-- TOAST SCRIPT --}}
        @if(session('success') || session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const toastEl = document.getElementById('appToast');
                const toast = new bootstrap.Toast(toastEl, {
                    delay: 3000
                });
                toast.show();
            });
        </script>
        @endif
        
        {{-- SCRIPT --}}
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/js/app.js') }}"></script>
        <script src="{{ asset('assets/js/scripts.js') }}"></script>
        <script src="{{ asset('assets/js/select2.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/demo/chart-area-demo.js') }}"></script>
        <script src="{{ asset('assets/demo/chart-bar-demo.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/js/datatables-simple-demo.js') }}"></script>
    </body>
</html>