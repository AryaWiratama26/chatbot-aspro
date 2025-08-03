<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Website Praktikum')</title>
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

        .navbar .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
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
        }

        .nav-link {
            color: #d1d5db;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-link:hover {
            color: #f9fafb;
            background-color: rgba(255,255,255,0.1);
        }

        main {
            min-height: calc(100vh - 140px);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
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
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: #f9fafb;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        }

        .btn-lg {
            padding: 1rem 2rem;
            font-size: 1rem;
        }

        .card {
            background: #1f2937;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
            border: 1px solid #374151;
            overflow: hidden;
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-header {
            background: #374151;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #4b5563;
            font-weight: 600;
            color: #f9fafb;
        }

        .alert {
            padding: 1rem 1.5rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            border-left: 4px solid;
        }

        .alert-info {
            background-color: #1e3a8a;
            border-color: #3b82f6;
            color: #dbeafe;
        }

        .alert-danger {
            background-color: #7f1d1d;
            border-color: #dc2626;
            color: #fecaca;
        }

        .alert-success {
            background-color: #14532d;
            border-color: #16a34a;
            color: #bbf7d0;
        }

        .text-primary { color: #3b82f6; }
        .text-muted { color: #9ca3af; }
        .text-success { color: #22c55e; }
        .text-warning { color: #f59e0b; }

        .bg-primary { background-color: #3b82f6; }
        .bg-light { background-color: #374151; }
        .bg-dark { background-color: #111827; }

        .text-white { color: #f9fafb; }

        .shadow-sm { box-shadow: 0 2px 8px rgba(0,0,0,0.3); }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -0.75rem;
        }

        .col-lg-6, .col-lg-8, .col-lg-4 {
            padding: 0 0.75rem;
        }

        .col-lg-6 { flex: 0 0 50%; }
        .col-lg-8 { flex: 0 0 66.666667%; }
        .col-lg-4 { flex: 0 0 33.333333%; }

        .d-flex { display: flex; }
        .justify-content-between { justify-content: space-between; }
        .align-items-center { align-items: center; }
        .align-items-start { align-items: flex-start; }
        .text-center { text-align: center; }
        .w-100 { width: 100%; }
        .mb-3 { margin-bottom: 1rem; }
        .mb-4 { margin-bottom: 1.5rem; }
        .mb-5 { margin-bottom: 3rem; }
        .mt-5 { margin-top: 3rem; }
        .my-5 { margin: 3rem 0; }
        .me-2 { margin-right: 0.5rem; }
        .me-3 { margin-right: 1rem; }
        .ms-auto { margin-left: auto; }

        .display-4 {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1.2;
        }

        .h3 {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .lead {
            font-size: 1.125rem;
            font-weight: 400;
        }

        .small {
            font-size: 0.875rem;
        }

        .list-unstyled {
            list-style: none;
        }

        .min-vh-50 {
            min-height: 50vh;
        }

        .input-group {
            display: flex;
            border: 1px solid #4b5563;
            border-radius: 8px;
            overflow: hidden;
            background: #374151;
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

        .input-group-text {
            padding: 0.75rem 1rem;
            background-color: #4b5563;
            border: none;
            color: #9ca3af;
        }

        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .bg-success { background-color: #22c55e; }
        .bg-secondary { background-color: #6b7280; }

        .btn-close {
            background: none;
            border: none;
            font-size: 1.25rem;
            cursor: pointer;
            padding: 0;
            color: inherit;
        }

        .btn-close:hover {
            opacity: 0.7;
        }

        .d-grid {
            display: grid;
        }

        .gap-2 {
            gap: 0.5rem;
        }

        .fw-bold {
            font-weight: 600;
        }

        hr {
            border: none;
            border-top: 1px solid #374151;
            margin: 1rem 0;
        }

        .flex-grow-1 {
            flex-grow: 1;
        }

        footer {
            background: #111827;
            color: #9ca3af;
            padding: 2rem 0;
            text-align: center;
            margin-top: 3rem;
            border-top: 1px solid #374151;
        }

        .chatbot-widget {
            position: fixed;
            bottom: 80px;
            right: 20px;
            width: 380px;
            height: 500px;
            background: #1f2937;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.5);
            display: none;
            flex-direction: column;
            z-index: 1000;
            border: 1px solid #374151;
        }

        .chatbot-header {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            color: #f9fafb;
            padding: 1rem 1.5rem;
            border-radius: 16px 16px 0 0;
            border-bottom: 1px solid #374151;
        }

        .chatbot-messages {
            flex: 1;
            padding: 1rem;
            overflow-y: auto;
            background: #111827;
        }

        .message {
            margin-bottom: 1rem;
            display: flex;
            flex-direction: column;
        }

        .bot-message {
            align-items: flex-start;
        }

        .user-message {
            align-items: flex-end;
        }

        .message-content {
            max-width: 80%;
            padding: 0.75rem 1rem;
            border-radius: 12px;
            position: relative;
            word-wrap: break-word;
        }

        .bot-message .message-content {
            background: #374151;
            color: #f9fafb;
            border-bottom-left-radius: 4px;
        }

        .user-message .message-content {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: #f9fafb;
            border-bottom-right-radius: 4px;
        }

        .message-icon {
            margin-right: 0.5rem;
            color: #3b82f6;
        }

        .message-time {
            font-size: 0.75rem;
            color: #6b7280;
            margin-top: 0.25rem;
            padding: 0 0.5rem;
        }

        .bot-message .message-time {
            text-align: left;
        }

        .user-message .message-time {
            text-align: right;
        }

        .chatbot-input {
            padding: 1rem;
            border-top: 1px solid #374151;
            background: #1f2937;
            border-radius: 0 0 16px 16px;
        }

        .chatbot-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: #f9fafb;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 20px rgba(59, 130, 246, 0.4);
            transition: all 0.2s ease;
            z-index: 999;
            border: 2px solid #1e293b;
        }

        .chatbot-toggle:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 25px rgba(59, 130, 246, 0.6);
        }

        .chatbot-toggle i {
            font-size: 1.5rem;
        }

        /* Scrollbar styling for chatbot */
        .chatbot-messages::-webkit-scrollbar {
            width: 6px;
        }

        .chatbot-messages::-webkit-scrollbar-track {
            background: #111827;
        }

        .chatbot-messages::-webkit-scrollbar-thumb {
            background: #4b5563;
            border-radius: 3px;
        }

        .chatbot-messages::-webkit-scrollbar-thumb:hover {
            background: #6b7280;
        }

        /* Typing indicator styling */
        .typing-text {
            color: #9ca3af;
            font-style: italic;
        }

        #typing-indicator .message-content {
            background: #374151;
            color: #9ca3af;
            border-bottom-left-radius: 4px;
        }

        @media (max-width: 768px) {
            .col-lg-6, .col-lg-8, .col-lg-4 {
                flex: 0 0 100%;
            }
            
            .chatbot-widget {
                width: calc(100vw - 40px);
                right: 20px;
                left: 20px;
            }
            
            .display-4 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-laptop-code"></i>
                Website Praktikum
            </a>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} Website Praktikum. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('scripts')
</body>
</html>