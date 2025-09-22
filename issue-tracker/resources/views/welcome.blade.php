<!-- resources/views/welcome.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Issue Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Issue Tracker</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container text-center mt-5">
        <h1 class="display-4 fw-bold">Welcome to Mini Issue Tracker 🚀</h1>
        <p class="lead text-muted">Track, manage, and resolve issues with ease.</p>

        @auth
            <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-lg mt-3">Go to Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-success btn-lg mt-3">Get Started</a>
        @endauth
    </div>

    <footer class="text-center mt-5 text-muted">
        <p>&copy; {{ date('Y') }} Mini Issue Tracker. All rights reserved.</p>
    </footer>

</body>
</html>
