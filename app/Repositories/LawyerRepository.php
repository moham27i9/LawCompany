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

    $lawyer->update([
        'license_number'    => $data['license_number']    ?? $lawyer->license_number,
        'experience_years'  => $data['experience_years']  ?? $lawyer->experience_years,
        'certificate'       => $data['certificate']       ?? $lawyer->certificate,
        'specialization'    => $data['specialization']    ?? $lawyer->specialization,
    ]);

    $profile = $lawyer->user->profile;
    $lawyerProfile=[];
    if ($profile) {
        $profileData = [
            'age'             => $data['age']             ?? $profile->age,
            'phone'           => $data['phone']           ?? $profile->phone,
            'address'         => $data['address']         ?? $profile->address,
            'scientificLevel' => $data['scientificLevel'] ?? $profile->scientificLevel,
        ];

        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $filename = 'user77_' . $lawyer->user_id . '.' . $data['image']->getClientOriginalExtension();
            $data['image']->storeAs('public/profile_images', $filename);
            $profileData['image'] = 'storage/profile_images/' . $filename;
        }
        $profile->update($profileData);

        $lawyerProfile = [
        'license_number'    => $data['license_number']    ?? $lawyer->license_number,
        'experience_years'  => $data['experience_years']  ?? $lawyer->experience_years,
        'certificate'       => $data['certificate']       ?? $lawyer->certificate,
        'specialization'    => $data['specialization']    ?? $lawyer->specialization,
        'age'             => $data['age']             ?? $profile->age,
        'phone'           => $data['phone']           ?? $profile->phone,
        'address'         => $data['address']         ?? $profile->address,
        'scientificLevel' => $data['scientificLevel'] ?? $profile->scientificLevel,
        'image' => $profile->image ? asset($profile->image) : null,
        ];
    }
    return $lawyerProfile;
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
