@extends('layouts.app')

@section('title', 'Website Praktikum')

@section('content')
<div class="hero-section" style="background: linear-gradient(135deg, #1e293b 0%, #334155 100%); padding: 4rem 0;">
    <div class="container">
        <div class="row" style="align-items: center; min-height: 50vh;">
            <div class="col-lg-6">
                <h1 class="display-4" style="color: #f9fafb; margin-bottom: 1.5rem;">
                    Selamat Datang di Website Praktikum
                </h1>
                <p class="lead" style="color: #d1d5db; margin-bottom: 2rem; font-size: 1.125rem;">
                    Dapatkan informasi terkini tentang jadwal, materi, dan pengumuman praktikum. 
                    Tanyakan apa saja kepada chatbot kami untuk mendapatkan bantuan instan!
                </p>
                <button class="btn btn-primary btn-lg" onclick="openChatbot()" style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); border: none; color: #f9fafb; padding: 1rem 2rem; border-radius: 8px; font-weight: 500; cursor: pointer; transition: all 0.2s ease;">
                    <i class="fas fa-comments me-2"></i>
                    Mulai Chat dengan Bot
                </button>
            </div>
            <div class="col-lg-6">
                <div class="text-center">
                    <div style="font-size: 8rem; color: #3b82f6; opacity: 0.8;">
                        <i class="fas fa-robot"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container" style="margin: 3rem auto;">
    <div class="row">
        <div class="col-lg-8">
            <h2 class="h3" style="margin-bottom: 1.5rem; color: #f9fafb; display: flex; align-items: center;">
                <i class="fas fa-bullhorn" style="color: #f59e0b; margin-right: 0.5rem;"></i>
                Pengumuman Terbaru
            </h2>
            
            @if($announcements->count() > 0)
                @foreach($announcements as $announcement)
                    <div class="card" style="margin-bottom: 1rem; background: #1f2937; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.3); border: 1px solid #374151;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <h5 style="color: #3b82f6; font-weight: 600; margin: 0;">{{ $announcement->title }}</h5>
                                <small style="color: #9ca3af; font-size: 0.875rem;">
                                    {{ $announcement->published_at->format('d/m/Y H:i') }}
                                </small>
                            </div>
                            <p style="margin: 0.5rem 0 0 0; color: #e5e7eb;">{{ $announcement->content }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-info" style="background-color: #1e3a8a; border-left: 4px solid #3b82f6; color: #dbeafe; padding: 1rem 1.5rem; border-radius: 8px;">
                    <i class="fas fa-info-circle me-2"></i>
                    Belum ada pengumuman terbaru.
                </div>
            @endif
        </div>
        
        <div class="col-lg-4">
            <div class="card" style="background: #1f2937; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.3); border: 1px solid #374151;">
                <div class="card-header" style="background: linear-gradient(135deg, #1e293b 0%, #334155 100%); color: #f9fafb; padding: 1rem 1.5rem; border-radius: 12px 12px 0 0;">
                    <h5 style="margin: 0; font-weight: 600;">
                        <i class="fas fa-question-circle me-2"></i>
                        Butuh Bantuan?
                    </h5>
                </div>
                <div class="card-body">
                    <p style="margin-bottom: 1rem; color: #e5e7eb;">Chatbot kami siap membantu Anda 24/7 untuk menjawab pertanyaan seputar:</p>
                    <ul class="list-unstyled" style="margin-bottom: 1.5rem;">
                        <li style="margin-bottom: 0.5rem; display: flex; align-items: center;">
                            <i class="fas fa-check" style="color: #22c55e; margin-right: 0.5rem;"></i>Jadwal praktikum
                        </li>
                        <li style="margin-bottom: 0.5rem; display: flex; align-items: center;">
                            <i class="fas fa-check" style="color: #22c55e; margin-right: 0.5rem;"></i>Materi pembelajaran
                        </li>
                        <li style="margin-bottom: 0.5rem; display: flex; align-items: center;">
                            <i class="fas fa-check" style="color: #22c55e; margin-right: 0.5rem;"></i>Syarat dan aturan
                        </li>
                        <li style="margin-bottom: 0.5rem; display: flex; align-items: center;">
                            <i class="fas fa-check" style="color: #22c55e; margin-right: 0.5rem;"></i>Pengumuman terkini
                        </li>
                    </ul>
                    <button class="btn btn-primary w-100" onclick="openChatbot()" style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); border: none; color: #f9fafb; padding: 0.75rem 1.5rem; border-radius: 8px; font-weight: 500; cursor: pointer; transition: all 0.2s ease;">
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
            <button class="btn-close" onclick="closeChatbot()" style="background: none; border: none; color: #f9fafb; font-size: 1.25rem; cursor: pointer;">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    
    <div class="chatbot-messages" id="chatbot-messages">
        <div class="message bot-message">
            <div class="message-content">
                <i class="fas fa-robot message-icon"></i>
                Halo! Saya asisten virtual praktikum. Ada yang bisa saya bantu? 😊
            </div>
            <div class="message-time">{{ now()->format('H:i') }}</div>
        </div>
    </div>
    
    <div class="chatbot-input">
        <div class="input-group">
            <input type="text" class="form-control" id="chatbot-input" 
                   placeholder="Ketik pertanyaan Anda..." maxlength="500">
            <button class="btn btn-primary" type="button" onclick="sendMessage()" style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); border: none; color: #f9fafb; padding: 0.75rem 1rem; border-radius: 0 8px 8px 0; font-weight: 500; cursor: pointer;">
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
<script>

function addMessage(content, isBot = true, timestamp = null) {
    const messagesContainer = document.getElementById('chatbot-messages');
    const messageDiv = document.createElement('div');
    messageDiv.className = `message ${isBot ? 'bot-message' : 'user-message'}`;
    
    const currentTime = timestamp || new Date().toLocaleTimeString('id-ID', { 
        hour: '2-digit', 
        minute: '2-digit' 
    });
    
    if (isBot) {
        messageDiv.innerHTML = `
            <div class="message-content">
                <i class="fas fa-robot message-icon"></i>
                ${content.replace(/\n/g, '<br>')}
            </div>
            <div class="message-time">${currentTime}</div>
        `;
    } else {
        messageDiv.innerHTML = `
            <div class="message-content">
                ${content}
            </div>
            <div class="message-time">${currentTime}</div>
        `;
    }
    
    messagesContainer.appendChild(messageDiv);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
}

function sendMessage() {
    const input = document.getElementById('chatbot-input');
    const message = input.value.trim();
    
    if (message) {
        
        addMessage(message, false);
        input.value = '';
        
        const typingDiv = document.createElement('div');
        typingDiv.className = 'message bot-message';
        typingDiv.id = 'typing-indicator';
        typingDiv.innerHTML = `
            <div class="message-content">
                <i class="fas fa-robot message-icon"></i>
                <span class="typing-text">Mengetik...</span>
            </div>
        `;
        document.getElementById('chatbot-messages').appendChild(typingDiv);
        document.getElementById('chatbot-messages').scrollTop = document.getElementById('chatbot-messages').scrollHeight;
        
        fetch('/chatbot', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                message: message
            })
        })
        .then(response => response.json())
        .then(data => {
            const typingIndicator = document.getElementById('typing-indicator');
            if (typingIndicator) {
                typingIndicator.remove();
            }
            
            addMessage(data.response, true, data.timestamp);
        })
        .catch(error => {
            const typingIndicator = document.getElementById('typing-indicator');
            if (typingIndicator) {
                typingIndicator.remove();
            }
            
            addMessage('Maaf, terjadi kesalahan. Silakan coba lagi atau hubungi admin.', true);
            console.error('Error:', error);
        });
    }
}

function openChatbot() {
    document.getElementById('chatbot-widget').style.display = 'flex';
}

function closeChatbot() {
    document.getElementById('chatbot-widget').style.display = 'none';
}

function toggleChatbot() {
    const widget = document.getElementById('chatbot-widget');
    if (widget.style.display === 'flex') {
        closeChatbot();
    } else {
        openChatbot();
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('chatbot-input');
    if (input) {
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    }
});
</script>
@endsection