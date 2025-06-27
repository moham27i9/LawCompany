@extends('layouts.app')

@section('content')
<div class="chat-container">
    <h4>الدردشة مع: {{ $receiver->name }}</h4>

    <div id="chat-box">
        @foreach($messages as $msg)
            <div class="{{ $msg->sender_id === auth()->id() ? 'text-end' : 'text-start' }}">
                <div class="chat-bubble">
                    <div class="sender-name">
                        {{ $msg->sender_id === auth()->id() ? 'أنا' : $receiver->name }}
                    </div>
                    <div class="text">{{ $msg->message }}</div>
                    <div class="msg-time">{{ \Carbon\Carbon::parse($msg->created_at)->format('H:i') }}</div>
                </div>
            </div>
        @endforeach
    </div>

    <form id="chat-form" class="chat-form-container">
        @csrf
        <input type="hidden" id="receiver_id" value="{{ $receiver->id }}">
        <input type="text" id="message" class="form-control" placeholder="اكتب رسالتك...">
        <button type="submit" class="btn">إرسال</button>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
{{-- <script src="https://unpkg.com/laravel-echo/dist/echo.iife.js"></script> --}}

<script>
    const userId = {{ auth()->id() }};
    const receiverId = document.getElementById('receiver_id').value;
    const chatBox = document.getElementById('chat-box');
    const form = document.getElementById('chat-form');
    const messageInput = document.getElementById('message');

    function appendMessage(sender, message, isMe = false, time = null) {
        const wrapper = document.createElement('div');
        wrapper.className = isMe ? 'text-end' : 'text-start';

        if (!time) {
            const now = new Date();
            time = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        }

        wrapper.innerHTML = `
            <div class="chat-bubble">
                <div class="sender-name">${sender}</div>
                <div class="text">${message}</div>
                <div class="msg-time">${time}</div>
            </div>
        `;

        chatBox.appendChild(wrapper);
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const message = messageInput.value.trim();
        if (!message) return;

        axios.get('/sanctum/csrf-cookie').then(() => {
            axios.post('/api/messages', {
                receiver_id: receiverId,
                message: message,
            }).then(res => {
                const now = new Date();
                const time = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                appendMessage('أنا', message, true, time);
                messageInput.value = '';
            }).catch(err => {
                console.error('فشل الإرسال', err);
            });
        });
    });


    window.Echo.private(`chat.${userId}`)
        .listen('NewMessage', (e) => {
            if (e.message.sender_id == receiverId) {
                const time = new Date(e.message.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                appendMessage(`{{ $receiver->name }}`, e.message.message, false, time);
            }
        });
        // window.Echo.private(`chat.${userId}`)
        // .listen('NewMessage', (e) => {
        //     console.log('📥 استقبلنا رسالة: ', e.message.message);
        //     appendMessage(e.message.sender.name ?? 'مستخدم', e.message.message);
        // });
        axios.get('/sanctum/csrf-cookie').then(() => {
        setInterval(() => {
        axios.get(`/api/messages/${receiverId}`)
            .then(res => {
                chatBox.innerHTML = '';
                res.data.forEach(msg => {
                    const isMe = msg.sender_id === userId;
                    const sender = isMe ? 'أنا' : '{{ $receiver->name }}';
                    const time = new Date(msg.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                    appendMessage(sender, msg.message, isMe, time);
                });
            }).catch(err => console.error('فشل تحميل المحادثة', err));
        }, 1000);
    });
</script>
@endpush

@push('styles')
<style>
    body {
        background: #ece5dd;
    }

    .chat-container {
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        max-width: 800px;
        margin: auto;
        padding: 20px;
        height: 90vh;
        display: flex;
        flex-direction: column;
    }

    #chat-box {
        flex: 1;
        overflow-y: auto;
        padding: 10px;
        background: #676767;
        border-radius: 10px;
        margin-bottom: 10px;
    }

    .chat-bubble {
        display: inline-block;
        max-width: 75%;
        padding: 10px 15px;
        border-radius: 20px;
        margin: 5px 0;
        position: relative;
        font-size: 18px;
        line-height: 1.5;
        word-wrap: break-word;
        animation: fadeIn 0.3s ease-in-out;
    }

    .text-start .chat-bubble {
        background: #ffffff;
        border: 1px solid #ccc;
        color: #333;
        border-bottom-left-radius: 0;
        align-self: flex-start;
    }

    .text-end .chat-bubble {
        background: #dcf8c6;
        color: #000;
        border-bottom-right-radius: 0;
        align-self: flex-end;
    }

    .sender-name {
        font-weight: bold;
        font-size: 13px;
        color: #555;
        margin-bottom: 4px;
    }

    .msg-time {
        font-size: 11px;
        color: #888;
        margin-top: 6px;
        text-align: left;
    }

    .chat-form-container {
        display: flex;
        gap: 10px;
    }

    .chat-form-container input.form-control {
        border-radius: 20px;
        padding: 10px 15px;
        border: 1px solid #ccc;
        outline: none;
        flex: 1;
    }

    .chat-form-container button {
        border-radius: 20px;
        background-color: #128c7e;
        border: none;
        color: white;
        padding: 10px 20px;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endpush
