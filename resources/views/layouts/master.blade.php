<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Training</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Logo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}"
             href="{{ route('products.index') }}">Item 1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Item 2</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="content">
        <div class="container px-md-5 pt-3 pb-5">
            <h2>@yield('title')</h2>
            <hr>

            <div class="row">
                @yield('content')
            </div>
        </div>
    </main>

    @if (session('success'))
        <div class="position-fixed end-0 p-3" style="z-index: 1055; top: 4rem;">
            <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toastEl = document.getElementById('successToast');
            if (toastEl) {
                const toast = new bootstrap.Toast(toastEl, {
                    delay: 2000
                });
                toast.show();
            }
        });
    </script>

    @stack('js')
</body>

</html>
