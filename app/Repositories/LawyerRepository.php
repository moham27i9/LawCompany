<?php

namespace App\Repositories;

use App\Models\Lawyer;

class LawyerRepository
{
    public function create(array $data)
    {
        return Lawyer::create([
            'user_id' => auth()->user()->id,
            'license_number' => $data['license_number'],
            'experience_years' => $data['experience_years'],
            'type' => $data['type'],
            'specialization' => $data['specialization'],
            'certificate' => $data['certificate'],
        ]);
    }


    // app/Repositories/LawyerRepository.php

public function getAll()
{
    return Lawyer::all(); // لجلب معلومات المستخدم المرتبط
    // return Lawyer::with('user')->get(); // لجلب معلومات المستخدم المرتبط
}

public function getById($id)
{
    return Lawyer::findOrFail($id);
}

public function update($id, array $data)
{
    $lawyer = Lawyer::findOrFail($id);
    $lawyer->update($data);
    return $lawyer;
}

public function delete($id)
{
    $lawyer = Lawyer::findOrFail($id);
    $lawyer->delete();

    // حذف المستخدم المرتبط إذا أردت
    // User::destroy($lawyer->user_id);

    return true;
}

}
