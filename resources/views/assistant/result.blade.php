<!DOCTYPE html>
<html>
<head>
    <title>النتيجة</title>
</head>
<body>
    <h3>سؤالك:</h3>
    <p>{{ $question }}</p>

    <h3>إجابة المساعد:</h3>
    <p>{{ $answer }}</p>

    <a href="{{ route('assistant.form') }}">🔁 سؤال جديد</a>
</body>
</html>
