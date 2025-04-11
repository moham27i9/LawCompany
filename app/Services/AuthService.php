<?php

namespace App\Services;
use App\Models\Role;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    use ApiResponseTrait;
    protected $authRepo;

    public function __construct(AuthRepository $authRepo)
    {
        $this->authRepo = $authRepo;
    }

    public function register(array $data)
    {
        $userRoleId = Role::where('name', 'user')->value('id');
        $user = $this->authRepo->createUser([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $userRoleId,
        ]);
        $token = $user->createToken('auth_token')->plainTextToken;

       
        return $this->successResponse( $user, 'User registered successfully' );  
        return $this->errorResponse('User registered failed', 500);
    }

    public function login(array $credentials)
    {
        if (!Auth::attempt($credentials)) {
          
            return $this->errorResponse('Invalid credentials', 401);
           
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;
        return $this->successResponse(
            ['token' => $token],
            'Login successful',
            200
        );
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        if($id != 1 || $user->role_id !=1){

            $user->delete(); 
            return $this->successResponse(null, 'تم حذف المستخدم وكل البيانات المرتبطة به',200);
        }
         else
         return $this->errorResponse(null, 'لا يمكن حذف المستخدم صاحب دور المدير',422);

    }


    
    public function list()
    {
        $users = $this->authRepo->getAll();
        return $this->successResponse($users, 'success');  
    }

    
    public function show($id)
    {
        $user = $this->authRepo->find($id);
        return $this->successResponse($user, 'success');  
    }

    
}
