<!DOCTYPE html>
<html>
<head>
    <title>المساعد القانوني</title>
</head>
<body>
    <h2>🧠 اسأل المساعد القانوني</h2>
    <form method="POST" action="{{ route('assistant.ask') }}">
        @csrf
        <textarea name="question" rows="6" cols="80" placeholder="اكتب سؤالك هنا..."></textarea>
        <br>
        <button type="submit">اسأل</button>
    </form>
</body>
</html>
