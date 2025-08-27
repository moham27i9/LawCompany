<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>الدفع عبر PayPal</title>
</head>
<body>
    <h2>إدخال المبلغ للدفع عبر PayPal</h2>

    <form action="{{ route('paypal.pay') }}" method="POST">
        @csrf
        <label>المبلغ ({{ env('PAYPAL_CURRENCY','USD') }}):</label>
        <input type="number" step="0.01" name="amount" value="10.00" required>
        <button type="submit">ادفع الآن</button>
    </form>
</body>
</html>
