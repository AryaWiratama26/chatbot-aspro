@extends('layouts.app')

@section('title', 'Website Praktikum')

@section('content')
<div class="hero-section">
    <div class="container">
        <div class="row align-items-center min-vh-50">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold text-primary mb-4">
                    Selamat Datang di Website Praktikum
                </h1>
                <p class="lead text-muted mb-4">
                    Dapatkan informasi terkini tentang jadwal, materi, dan pengumuman praktikum. 
                    Tanyakan apa saja kepada chatbot kami untuk mendapatkan bantuan instan!
                </p>
                <button class="btn btn-primary btn-lg" onclick="openChatbot()">
                    <i class="fas fa-comments me-2"></i>
                    Mulai Chat dengan Bot
                </button>
            </div>
            <div class="col-lg-6">
                <div class="text-center">
                    <i class="fas fa-robot text-primary" style="font-size: 8rem;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-8">
            <h2 class="h3 mb-4">
                <i class="fas fa-bullhorn text-warning me-2"></i>
                Pengumuman Terbaru
            </h2>
            
            @if($announcements->count() > 0)
                @foreach($announcements as $announcement)
                    <div class="card mb-3 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <h5 class="card-title text-primary">{{ $announcement->title }}</h5>
                                <small class="text-muted">
                                    {{ $announcement->published_at->format('d/m/Y H:i') }}
                                </small>
                            </div>
                            <p class="card-text">{{ $announcement->content }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Belum ada pengumuman terbaru.
                </div>
            @endif
        </div>
        
        <div class="col-lg-4">
            <div class="card bg-light">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-question-circle me-2"></i>
                        Butuh Bantuan?
                    </h5>
                </div>
                <div class="card-body">
                    <p>Chatbot kami siap membantu Anda 24/7 untuk menjawab pertanyaan seputar:</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success me-2"></i>Jadwal praktikum</li>
                        <li><i class="fas fa-check text-success me-2"></i>Materi pembelajaran</li>
                        <li><i class="fas fa-check text-success me-2"></i>Syarat dan aturan</li>
                        <li><i class="fas fa-check text-success me-2"></i>Pengumuman terkini</li>
                    </ul>
                    <button class="btn btn-primary w-100" onclick="openChatbot()">
                        <i class="fas fa-robot me-2"></i>
                        Chat Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chatbot Widget -->
<div id="chatbot-widget" class="chatbot-widget">
    <div class="chatbot-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-robot me-2"></i>
                <strong>Asisten Praktikum</strong>
            </div>
            <button class="btn btn-sm btn-light" onclick="closeChatbot()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    
    <div class="chatbot-messages" id="chatbot-messages">
        <div class="message bot-message">
            <div class="message-content">
                <i class="fas fa-robot me-2"></i>
                Halo! Saya asisten virtual praktikum. Ada yang bisa saya bantu? 😊
            </div>
            <div class="message-time">{{ now()->format('H:i') }}</div>
        </div>
    </div>
    
    <div class="chatbot-input">
        <div class="input-group">
            <input type="text" class="form-control" id="chatbot-input" 
                   placeholder="Ketik pertanyaan Anda..." maxlength="500">
            <button class="btn btn-primary" type="button" onclick="sendMessage()">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>
</div>

<!-- Chatbot Toggle Button -->
<div class="chatbot-toggle" onclick="toggleChatbot()">
    <i class="fas fa-comments"></i>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/chatbot.js') }}"></script>
@endsection