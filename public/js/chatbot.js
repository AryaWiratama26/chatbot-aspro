$(document).ready(function() {
    // Set CSRF token for AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Auto-resize chatbot input
    $('#chatbot-input').on('input', function() {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    });

    // Handle Enter key press
    $('#chatbot-input').on('keypress', function(e) {
        if (e.which === 13 && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });
});

function toggleChatbot() {
    const widget = $('#chatbot-widget');
    const toggle = $('.chatbot-toggle');
    
    if (widget.is(':visible')) {
        closeChatbot();
    } else {
        openChatbot();
    }
}

function openChatbot() {
    $('#chatbot-widget').show();
    $('.chatbot-toggle').hide();
    $('#chatbot-input').focus();
    scrollToBottom();
}

function closeChatbot() {
    $('#chatbot-widget').hide();
    $('.chatbot-toggle').show();
}

function sendMessage() {
    const input = $('#chatbot-input');
    const message = input.val().trim();
    
    if (!message) return;
    
    // Add user message to chat
    addMessage(message, 'user');
    
    // Clear input
    input.val('');
    
    // Show typing indicator
    showTypingIndicator();
    
    // Send message to server
    $.ajax({
        url: '/chatbot',
        method: 'POST',
        data: {
            message: message
        },
        success: function(response) {
            hideTypingIndicator();
            addMessage(response.response, 'bot', response.timestamp);
        },
        error: function(xhr) {
            hideTypingIndicator();
            let errorMessage = 'Maaf, terjadi kesalahan. Silakan coba lagi.';
            
            if (xhr.status === 422) {
                const errors = xhr.responseJSON.errors;
                if (errors.message) {
                    errorMessage = errors.message[0];
                }
            }
            
            addMessage(errorMessage, 'bot');
        }
    });
}

function addMessage(content, type, timestamp = null) {
    const messagesContainer = $('#chatbot-messages');
    const time = timestamp || new Date().toLocaleTimeString('id-ID', {
        hour: '2-digit',
        minute: '2-digit'
    });
    
    const messageHtml = `
        <div class="message ${type}-message">
            <div class="message-content">
                ${type === 'bot' ? '<i class="fas fa-robot me-2"></i>' : ''}
                ${content}
            </div>
            <div class="message-time">${time}</div>
        </div>
    `;
    
    messagesContainer.append(messageHtml);
    scrollToBottom();
}

function showTypingIndicator() {
    const typingHtml = `
        <div class="message bot-message chatbot-typing">
            <div class="message-content">
                <div class="typing-indicator">
                    <i class="fas fa-robot me-2"></i>
                    <span class="typing-dot"></span>
                    <span class="typing-dot"></span>
                    <span class="typing-dot"></span>
                </div>
            </div>
        </div>
    `;
    
    $('#chatbot-messages').append(typingHtml);
    $('.chatbot-typing').show();
    scrollToBottom();
}

function hideTypingIndicator() {
    $('.chatbot-typing').remove();
}

function scrollToBottom() {
    const messagesContainer = $('#chatbot-messages');
    messagesContainer.scrollTop(messagesContainer[0].scrollHeight);
}

// Handle window resize
$(window).on('resize', function() {
    if ($(window).width() <= 768) {
        // Mobile adjustments
        $('#chatbot-widget').css({
            'width': 'calc(100vw - 40px)',
            'left': '20px',
            'right': '20px'
        });
    } else {
        // Desktop adjustments
        $('#chatbot-widget').css({
            'width': '350px',
            'left': 'auto',
            'right': '20px'
        });
    }
});