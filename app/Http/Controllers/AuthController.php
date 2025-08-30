<?php

namespace App\Http\Controllers;
use App\Traits\ApiResponseTrait;
use App\Services\AuthService;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Http\Requests\UpdateUserRoleRequest;
use App\Models\RefreshToken;

class AuthController extends Controller
{
    use ApiResponseTrait;
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterUserRequest $request)
    {
        return $this->authService->register($request->validated());
    }

    public function login(LoginUserRequest $request)
    {
        return $this->authService->login($request->validated());
    }


    //logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

       return $this->successResponse( null,'Logged out successfully' );  
         
    }

    public function destroy($id)
    {

      return $this->authService->delete($id);
       
       
    }

    public function index()
    {
        return $this->authService->list();
    }
    public function show($id)
    {
        return $this->authService->show($id);
    }
    public function getRole()
    {
        $user = auth()->user();
        return $this->authService->showRole($user->id);
    }
    
    public function testMail()
    {
        Mail::to('test@lawfirm.com')->send(new TestMail());

        return 'تم إرسال البريد بنجاح!';
    }
  

    public function changeRole(UpdateUserRoleRequest $request, $id)
    {
        return $this->authService->changeUserRole($id, $request->validated());
    }
    
    public function refreshToken(Request $request)
{
    $request->validate([
        'refresh_token' => 'required'
    ]);

    $hashed = hash('sha256', $request->refresh_token);

    $record = RefreshToken::where('token', $hashed)
        ->where('expires_at', '>', now())
        ->first();

    if (!$record) {
        return $this->errorResponse('Invalid or expired refresh token', 401);
    }

    // إنشاء Access Token جديد
    $accessToken = $record->user->createToken('api-token')->plainTextToken;

    return $this->successResponse([
        'access_token' => $accessToken
    ], 'Access token refreshed');
}

public function showLoginForm()
{
    return view('auth.login');
}

   public function getClientCount()
    {
        $count = $this->authService->clientCount();
         return $this->successResponse($count, ' client count retrieved ');
    }

    public function saveFcmToken(Request $request)
{
    $request->validate([
        'fcm_token' => 'required|string',
    ]);

    $user = auth()->user();
       $user->fcm_tokens->fcm_token = $request->fcm_token;
    $user->save();

    return response()->json(['message' => 'FCM token saved successfully']);
}

}