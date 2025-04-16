<!DOCTYPE html>
<html>
<head>
    <title>إشعارات الوقت الحقيقي</title>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
</head>
<body>
    <h1>الإشعارات:</h1>
    <div id="notifications"></div>

    <script>
        // تفعيل سجل الأخطاء
        Pusher.logToConsole = true;

        // إعداد الاتصال بـ Pusher
        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
            forceTLS: true
        });

        // الاشتراك في قناة عامة
        var channel = pusher.subscribe('law-application');

        // الاستماع لحدث الإشعار
        channel.bind('lawyer.created', function(data) {
            document.getElementById("notifications").innerHTML +=
                `<div style="padding: 8px; background: #eee; margin: 5px;">تم إضافة المحامي: ${data.name}</div>`;
        });
    </script>
</body>
</html>
