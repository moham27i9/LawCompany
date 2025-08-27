<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{
    // صفحة checkout بسيطة
    public function checkout()
    {
        return view('paypal-checkout'); // تأكد أن لديك هذا view
    }

    // إنشاء الدفع وتحويل المستخدم لصفحة PayPal
    public function pay(Request $request)
    {
        $paypal = new PayPalClient;
        $paypal->setApiCredentials(config('paypal'));

        // الحصول على التوكن
        $token = $paypal->getAccessToken();
        if (!isset($token['access_token'])) {
            dd('PayPal error:', $token); // إذا فشل التوكن
        }

        $paypal->setAccessToken($token['access_token']);

        $response = $paypal->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => env('PAYPAL_CURRENCY', 'USD'),
                        "value" => $request->amount ?? 10, // المبلغ الافتراضي 10
                    ],
                ]
            ],
            "application_context" => [
                "cancel_url" => route('paypal.cancel'),
                "return_url" => route('paypal.success'),
            ],
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }

        return redirect()->route('paypal.cancel');
    }

    // صفحة نجاح الدفع
    public function success(Request $request)
    {
        $paypal = new PayPalClient;
        $paypal->setApiCredentials(config('paypal'));

        $token = $paypal->getAccessToken();
        if (!isset($token['access_token'])) {
            dd('PayPal error:', $token);
        }

        $paypal->setAccessToken($token['access_token']);

        $result = $paypal->capturePaymentOrder($request->token);

        if (isset($result['status']) && $result['status'] === 'COMPLETED') {
            return "✅ تم الدفع بنجاح!";
        }

        return "❌ فشل الدفع!";
    }

    // صفحة إلغاء الدفع
    public function cancel()
    {
        return "❌ تم إلغاء الدفع.";
    }
}
