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
    $currentRoleId = $user->role_id;

    $newRoleName = strtolower($data['role_name']); // نستقبل الاسم

    // نحاول إيجاد الدور من قاعدة البيانات
    $newRole = Role::whereRaw('LOWER(name) = ?', [$newRoleName])->first();

    if (!$newRole) {
        return $this->errorResponse('الدور غير موجود', 404, null);
    }

    $newRoleId = $newRole->id;

    if ($currentRoleId == 1) {
        return $this->errorResponse('لا يمكن تغيير دور الأدمن!', 422, null);
    }

    if ($newRoleId == $currentRoleId) {
        return $this->successResponse($user, 'الدور الحالي هو نفسه', 200);
    }

    // موظف → محامي
    if ($user->employee && $newRoleName == 'lawyer') {
        $user->employee->delete();
    }

    if ($user->employee && $newRoleName == 'intern') {
        $user->employee->delete();
    }

    // محامي → موظف
    if ($user->lawyer && in_array($newRoleName, ['hr', 'accountant'])) {
        $user->lawyer->delete();
        $user->notify(new ChangeRoleNotification('موظف'));
    }

    // تحديث الدور
    $user->role_id = $newRoleId;
    $user->save();

    // إرسال إشعار بالدور الجديد
    $roleNameForNotification = match ($newRoleName) {
        'lawyer'     => 'محامي',
        'hr'         => 'HR',
        'accountant' => 'محاسب',
        'user'       => 'مستخدم',
        default      => 'تم تغيير الدور'
    };

    $user->notify(new ChangeRoleNotification($roleNameForNotification));

    return $this->successResponse(null, 'تم تغيير الدور بنجاح', 200);
}

public function showRole($id)
{
    $role = $this->authRepo->findrole($id);
    return $this->successResponse($role, 'success');
}

}
