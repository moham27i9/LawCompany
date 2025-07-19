<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Report')</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 30px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #313fd3;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }
        .logo {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #6059c4;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1.company-name {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        h2 {
            text-align: center;
            margin-top: 0;
        }
        table {
            border-collapse: collapse;
            margin-top: 15px;
            width: 100%;
        }
        th, td {
            border: 1px solid #444;
            padding: 8px;
            text-align: center;
        }
        ul {
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="header">
    <img src="{{ public_path('logoCompany/yagmor.jpg') }}" alt="Company Logo" class="logo">
    <div class="company-info">
        <h1 class="company-name">Yagmour Law </h1>
    </div>
</div>

    @yield('content')

</body>
</html>
