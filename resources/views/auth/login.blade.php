@extends('layouts.app')

@section('content')
<div class="container">
    <h2>تسجيل الدخول</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="email">البريد الإلكتروني</label>
            <input id="email" type="email" name="email" required autofocus>
        </div>

        <div>
            <label for="password">كلمة المرور</label>
            <input id="password" type="password" name="password" required>
        </div>

        <div>
            <button type="submit">دخول</button>
        </div>
    </form>
</div>
@endsection
