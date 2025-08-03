<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Website Praktikum</title>
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
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -0.75rem;
            justify-content: center;
        }

        .col-md-6, .col-lg-4 {
            padding: 0 0.75rem;
        }

        .col-md-6 { flex: 0 0 50%; }
        .col-lg-4 { flex: 0 0 33.333333%; }

        .card {
            background: rgba(31, 41, 55, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.3);
            border: 1px solid rgba(59, 130, 246, 0.2);
            overflow: hidden;
        }

        .card-body {
            padding: 2.5rem;
        }

        .text-center {
            text-align: center;
        }

        .mb-4 {
            margin-bottom: 1.5rem;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        .text-primary {
            color: #3b82f6;
        }

        .text-muted {
            color: #9ca3af;
        }

        .h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #f9fafb;
            margin-bottom: 0.5rem;
        }

        .alert {
            padding: 1rem 1.5rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            border-left: 4px solid;
        }

        .alert-danger {
            background-color: #7f1d1d;
            border-color: #dc2626;
            color: #fecaca;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #e5e7eb;
        }

        .input-group {
            display: flex;
            border: 1px solid #4b5563;
            border-radius: 8px;
            overflow: hidden;
            background: #374151;
        }

        .input-group-text {
            padding: 0.75rem 1rem;
            background-color: #4b5563;
            border: none;
            color: #9ca3af;
            display: flex;
            align-items: center;
        }

        .form-control {
            flex: 1;
            padding: 0.75rem 1rem;
            border: none;
            outline: none;
            font-size: 0.875rem;
            background: #374151;
            color: #f9fafb;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }

        .form-control::placeholder {
            color: #9ca3af;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 0.875rem;
            width: 100%;
            justify-content: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: #f9fafb;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        }

        .text-decoration-none {
            text-decoration: none;
        }

        .text-decoration-none:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .col-md-6, .col-lg-4 {
                flex: 0 0 100%;
            }
            
            .card-body {
                padding: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <i class="fas fa-shield-alt text-primary" style="font-size: 3rem;"></i>
                            <h3 class="mt-3">Admin Login</h3>
                            <p class="text-muted">Masuk ke panel admin</p>
                        </div>

                        @if($errors->any())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('admin.login.post') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="{{ old('email') }}" required>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary mb-3">
                                <i class="fas fa-sign-in-alt"></i>
                                Login
                            </button>
                        </form>

                        <div class="text-center">
                            <a href="{{ route('home') }}" class="text-decoration-none" style="color: #3b82f6;">
                                <i class="fas fa-arrow-left"></i>
                                Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>