<?php

namespace App\Services;
use App\Models\Role;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ChangeRoleNotification;

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

       
        return $this->successResponse( ['token' => $token], 'User registered successfully' );  
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
         return $this->errorResponse('لا يمكن حذف المستخدم صاحب دور المدير',422,null);

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

    public function changeUserRole($userId, array $data)
    {
        $user = User::with(['employee', 'lawyer'])->findOrFail($userId);
        $newRoleId = $data['role_id'];
        $currentRoleId = $user->role_id;
    
        if ($newRoleId == $currentRoleId) return $user;
    
        if ($user->role_id == 1) {
            return $this->errorResponse('can\'t change this role!',422,null);
        }
        if ($user->employee && $newRoleId == 5) {
            // حذف من جدول الموظفين قبل تغيير الدور
            $user->employee->delete();
        }
        
        if ($user->lawyer && in_array($newRoleId, [3, 4])) {
            // حذف من جدول المحامين قبل التغيير
            $user->lawyer->delete();
            $user->notify(new ChangeRoleNotification('موظف'));
        }
        $user->role_id = $newRoleId;
        $user->save();
        if($newRoleId == 5)
        $user->notify(new ChangeRoleNotification('محامي'));
        if($newRoleId == 3)
        $user->notify(new ChangeRoleNotification('HR'));
        if($newRoleId == 4)
        $user->notify(new ChangeRoleNotification('محاسب'));

    
        return $this->successResponse(null, 'change role successfully ',200);
    }
    
    

}
