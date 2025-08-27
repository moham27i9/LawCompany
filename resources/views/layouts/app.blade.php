<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تطبيق الدردشة</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) إذا كنت تستخدم Vite --}}
</head>
<body style="font-family: Arial, sans-serif; padding: 20px; direction: rtl;">

    {{-- محتوى الصفحة --}}
    @yield('content')
 @stack('scripts') {{-- ✅ هذا مهم لتفعيل push --}}
 @stack('styles') {{-- ✅ هذا مهم لتفعيل push --}}

</body>
</html>
