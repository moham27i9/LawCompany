<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h2>Chat Room</h2>

    <div>
       <p>الرسائل</p>
    </div>

    <form id="chat-form">
        <input type="text" id="message-input" placeholder="اكتب رسالة...">
        <button type="submit">إرسال</button>
    </form>

    <!-- Pusher -->
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <!-- Laravel Echo -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.15.3/echo.iife.js"></script>

    <script>
        // تهيئة Echo
        window.Echo = new Echo({
            broadcaster: "pusher",
            key: "{{ env('PUSHER_APP_KEY') }}",
            cluster: "{{ env('PUSHER_APP_CLUSTER') }}",
            wsHost: window.location.hostname,
            wsPort: 8080,
            forceTLS: false,
            enabledTransports: ["ws", "wss"],
        });

        // الاستماع للرسائل الجديدة
        window.Echo.channel("chat")
            .listen("MessageSent", (e) => {
                let el = document.createElement("p");
                el.innerHTML = `<strong>${e.message.user.name}:</strong> ${e.message.content}`;
                document.getElementById("messages").appendChild(el);
            });

        // إرسال الرسائل
        document.getElementById("chat-form").addEventListener("submit", function(e) {
            e.preventDefault();
            let message = document.getElementById("message-input").value;

            fetch("{{ route('messages.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({ content: message }),
            }).then(res => res.json())
              .then(() => document.getElementById("message-input").value = "");
        });
    </script>
</body>
</html>
