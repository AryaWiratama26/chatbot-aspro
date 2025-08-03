<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel - Website Praktikum')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            line-height: 1.6;
            color: #e5e7eb;
            background-color: #111827;
        }

        .navbar {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            padding: 1rem 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
            border-bottom: 1px solid #374151;
        }

        .container-fluid {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .navbar-brand {
            color: #f9fafb;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar-nav {
            display: flex;
            list-style: none;
            gap: 1rem;
            align-items: center;
        }

        .navbar-text {
            color: rgba(249,250,251,0.9);
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 0.875rem;
        }

        .btn-outline-light {
            background: transparent;
            color: #f9fafb;
            border: 1px solid rgba(249,250,251,0.3);
        }

        .btn-outline-light:hover {
            background: rgba(249,250,251,0.1);
            border-color: rgba(249,250,251,0.5);
        }

        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.75rem;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -0.75rem;
        }

        .col-md-3, .col-md-9, .col-lg-2, .col-lg-10 {
            padding: 0 0.75rem;
        }

        .col-md-3 { flex: 0 0 25%; }
        .col-md-9 { flex: 0 0 75%; }
        .col-lg-2 { flex: 0 0 16.666667%; }
        .col-lg-10 { flex: 0 0 83.333333%; }

        .sidebar {
            background: #1f2937;
            min-height: calc(100vh - 80px);
            border-right: 1px solid #374151;
            box-shadow: 2px 0 8px rgba(0,0,0,0.3);
        }

        .position-sticky {
            position: sticky;
            top: 0;
        }

        .pt-3 {
            padding-top: 1rem;
        }

        .nav {
            list-style: none;
        }

        .nav-item {
            margin-bottom: 0.25rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1rem;
            color: #9ca3af;
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .nav-link:hover {
            color: #f9fafb;
            background-color: #374151;
        }

        .nav-link.active {
            color: #3b82f6;
            background-color: #1e3a8a;
            border-left: 3px solid #3b82f6;
        }

        .ms-sm-auto {
            margin-left: auto;
        }

        .px-md-4 {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        .pt-3 {
            padding-top: 1rem;
        }

        .pb-2 {
            padding-bottom: 0.5rem;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        .border-bottom {
            border-bottom: 1px solid #374151;
        }

        .h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #f9fafb;
        }

        .alert {
            padding: 1rem 1.5rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            border-left: 4px solid;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .alert-success {
            background-color: #14532d;
            border-color: #22c55e;
            color: #bbf7d0;
        }

        .alert-danger {
            background-color: #7f1d1d;
            border-color: #dc2626;
            color: #fecaca;
        }

        .alert-dismissible {
            position: relative;
        }

        .fade {
            transition: opacity 0.15s linear;
        }

        .show {
            opacity: 1;
        }

        .btn-close {
            background: none;
            border: none;
            font-size: 1.25rem;
            cursor: pointer;
            padding: 0;
            color: inherit;
            opacity: 0.7;
        }

        .btn-close:hover {
            opacity: 1;
        }

        .d-inline {
            display: inline;
        }

        @media (max-width: 768px) {
            .col-md-3, .col-md-9 {
                flex: 0 0 100%;
            }
            
            .sidebar {
                min-height: auto;
                border-right: none;
                border-bottom: 1px solid #374151;
            }
            
            .ms-sm-auto {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-shield-alt"></i>
                Admin Panel
            </a>
            <ul class="navbar-nav">
                <li class="navbar-text">
                    <i class="fas fa-user"></i>
                    {{ Auth::guard('admin')->user()->name }}
                </li>
                <li>
                    <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-3 col-lg-2 sidebar">
                <div class="position-sticky pt-3">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                               href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.knowledge.*') ? 'active' : '' }}" 
                               href="{{ route('admin.knowledge.index') }}">
                                <i class="fas fa-brain"></i>
                                Knowledge Base
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.announcements.*') ? 'active' : '' }}" 
                               href="{{ route('admin.announcements.index') }}">
                                <i class="fas fa-bullhorn"></i>
                                Pengumuman
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">@yield('page-title')</h1>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
    @yield('scripts')
</body>
</html>