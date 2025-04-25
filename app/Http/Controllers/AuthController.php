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
    


}
