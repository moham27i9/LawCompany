<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>Laravel FCM Chat</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://www.gstatic.com/firebasejs/10.12.5/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.12.5/firebase-messaging-compat.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            direction: rtl;
            background: #f5f5f5;
        }
        h3 {
            text-align: center;
        }
        #chat {
            border: 1px solid #ccc;
            border-radius: 10px;
            height: 400px;
            overflow-y: auto;
            padding: 10px;
            background: #fff;
            margin-bottom: 10px;
        }
        .bubble {
            max-width: 30%;
            padding: 10px 15px;
            margin: 5px 0;
            border-radius: 20px;
            position: relative;
            word-wrap: break-word;
        }
        .me {
            background: #5da6ea;
            color: #fff;
            margin-left: auto;
            border-bottom-right-radius: 0;
        }
        .other {
            background: #e0e0e0;
            color: #000;
            margin-right: auto;
            border-bottom-left-radius: 0;
        }
        input, button {
            padding: 8px;
            margin: 5px 0;
            font-size: 14px;
        }
        #message {
            width: 70%;
        }
        button {
            cursor: pointer;
        }
        label {
            margin-right: 10px;
        }
        #token {
            font-family: monospace;
            word-break: break-all;
        }
    </style>
</head>
<body>
<h3>دردشة FCM (تجريب)</h3>

<div>
    <label>أنا (sender_id): <input id="sender_id" value="1"></label>
    <label>المستلم (receiver_id): <input id="receiver_id" value="2"></label>
    <button id="load">تحميل المحادثة</button>
</div>

<div id="chat"></div>

<div>
    <input id="message" placeholder="اكتب رسالة...">
    <button id="send">إرسال</button>
</div>

<hr>
<p>FCM Token: <span id="token"></span></p>

<script>
    console.log("💡 الصفحة جاهزة، نبدأ تهيئة Firebase...");

    const firebaseConfig = {
        apiKey: "{{ env('FIREBASE_API_KEY') }}",
        authDomain: "{{ env('FIREBASE_AUTH_DOMAIN') }}",
        projectId: "{{ env('FIREBASE_PROJECT_ID') }}",
        storageBucket: "{{ env('FIREBASE_STORAGE_BUCKET') }}",
        messagingSenderId: "{{ env('FIREBASE_MESSAGING_SENDER_ID') }}",
        appId: "{{ env('FIREBASE_APP_ID') }}",
    };

    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();
    console.log("✅ Firebase Initialized");

    async function registerServiceWorker() {
        try {
            console.log("💡 تسجيل Service Worker...");
            const registration = await navigator.serviceWorker.register('/firebase-messaging-sw.js');
            console.log("✅ Service Worker مسجل:", registration);
            const swReady = await navigator.serviceWorker.ready;
            console.log("✅ Service Worker جاهز:", swReady);
            return swReady;
        } catch (error) {
            console.error("❌ خطأ عند تسجيل Service Worker:", error);
            throw error;
        }
    }

    async function initFcm() {
        try {
            console.log("💡 طلب إذن الإشعارات...");
            const permission = await Notification.requestPermission();
            console.log("🔔 Permission result:", permission);

            if (permission !== "granted") {
                console.warn("⚠️ المستخدم لم يمنح الإذن!");
                return;
            }

            const swRegistration = await registerServiceWorker();

            const currentToken = await messaging.getToken({
                vapidKey: "BFdvvcgx6jQSS_yZ-Fm4CuLhiOhIgrfi7l4lnQVy7vtPF7gMwCNLK0VHI9k7INrBQNu_muZx5MQwki5TT6AzwQs",
                serviceWorkerRegistration: swRegistration
            });

            if (currentToken) {
                console.log("✅ تم إنشاء التوكن:", currentToken);
                document.getElementById('token').textContent = currentToken;
                await sendTokenToServer(currentToken);
            } else {
                console.warn("⚠️ لم يتم إنشاء توكن");
            }
        } catch (error) {
            console.error("❌ FCM init error", error);
        }
    }
const sender_id = document.getElementById('sender_id').value;

    async function sendTokenToServer(token) {
        console.log("💡 إرسال التوكن للسيرفر...");
        try {
            await fetch("/api/fcm/token", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ token: token,user_id: sender_id  })
            });
            console.log("✅ تم حفظ التوكن في السيرفر");
        } catch (error) {
            console.error("❌ فشل إرسال التوكن للسيرفر", error);
        }
    }

    messaging.onMessage((payload) => {
        console.log("📩 رسالة واردة:", payload);
        const notificationTitle = payload.notification?.title || 'رسالة جديدة';
        const notificationOptions = {
            body: payload.notification?.body || '',
            icon: payload.notification?.icon || '/icon.png'
        };
        new Notification(notificationTitle, notificationOptions);
    });

    initFcm();

    async function loadConversation() {
        const a = document.getElementById('sender_id').value;
        const b = document.getElementById('receiver_id').value;
        const res = await fetch(`/api/messages/${a}/${b}`);
        const json = await res.json();

        const box = document.getElementById('chat');
        box.innerHTML = '';
        json.data.forEach(m => {
            const div = document.createElement('div');
            div.className = 'bubble ' + (String(m.sender_id) === String(a) ? 'me' : 'other');
            div.textContent = m.message;
            box.appendChild(div);
        });
        box.scrollTop = box.scrollHeight;
    }

    document.getElementById('load').addEventListener('click', loadConversation);

    document.getElementById('send').addEventListener('click', async () => {
        const sender_id = document.getElementById('sender_id').value;
        const receiver_id = document.getElementById('receiver_id').value;
        const message = document.getElementById('message').value.trim();
        if (!message) return;

        await fetch('/api/messages', {
            method: 'POST',
            headers: { 
                'Content-Type': 'application/json', 
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content 
            },
            body: JSON.stringify({ sender_id, receiver_id, message })
        });

        document.getElementById('message').value = '';
        loadConversation();
    });
</script>
</body>
</html>
