<?php

namespace App\Repositories;

use App\Models\Issue;
use App\Models\Lawyer;

class LawyerRepository
{
    public function create(array $data)
    {
           // التعامل مع ملف الشهادة

        return Lawyer::create([
            'user_id' => auth()->user()->id,
            'license_number' => $data['license_number'],
            'experience_years' => $data['experience_years'],
            'type' => $data['type'],
            'specialization' => $data['specialization'],
            'certificate' => $data['certificate'],
        ]);
    }


public function getAll()
{
    return Lawyer::all();
}

public function getById($id)
{
    return Lawyer::findOrFail($id);
}

public function update($id, array $data)
{
    $lawyer = Lawyer::findOrFail($id);

    // التعامل مع ملف الشهادة
    if (isset($data['certificate']) && $data['certificate'] instanceof \Illuminate\Http\UploadedFile) {
        $filename = 'lawyer_cert_' . $lawyer->user_id . '.' . $data['certificate']->getClientOriginalExtension();
        $data['certificate']->storeAs('certificates', $filename, 'public');
        $certificatePath = 'storage/certificates/' . $filename;
    } else {
        $certificatePath = $lawyer->certificate;
    }

    $lawyer->update([
        'license_number'    => $data['license_number']    ?? $lawyer->license_number,
        'experience_years'  => $data['experience_years']  ?? $lawyer->experience_years,
        'certificate'       => $certificatePath,
        'specialization'    => $data['specialization']    ?? $lawyer->specialization,
    ]);

    $profile = $lawyer->user->profile;
    $lawyerProfile = [];

    if ($profile) {
        $profileData = [
            'age'             => $data['age']             ?? $profile->age,
            'phone'           => $data['phone']           ?? $profile->phone,
            'address'         => $data['address']         ?? $profile->address,
            'scientificLevel' => $data['scientificLevel'] ?? $profile->scientificLevel,
        ];

        // التعامل مع الصورة
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $filename = 'user77_' . $lawyer->user_id . '.' . $data['image']->getClientOriginalExtension();
            $data['image']->storeAs('profile_images', $filename, 'public');
            $profileData['image'] = 'storage/profile_images/' . $filename;
        }

        $profile->update($profileData);

        $lawyerProfile = [
            'license_number'    => $lawyer->license_number,
            'experience_years'  => $lawyer->experience_years,
            'certificate'       => $lawyer->certificate,
            'specialization'    => $lawyer->specialization,
            'age'               => $profile->age,
            'phone'             => $profile->phone,
            'address'           => $profile->address,
            'scientificLevel'   => $profile->scientificLevel,
            'image'             => $profile->image ? asset($profile->image) : null,
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

  public function getIssuesForLawyer() {
      $issues = auth()->user()->lawyer->issues;
        return  $issues;
    }

  public function getIssueslawyer($id) {
      $issues = Lawyer::with('issues')->where('id',$id)->get();
        return  $issues;
    }
  public function getSessionsForLawyer() {
      $sessions = auth()->user()->lawyer->sessions;
        return  $sessions;
    }

    public function updateSalary($lawyer_id, $salary)
    {
        $lawyer = Lawyer::findOrFail($lawyer_id);
        $lawyer->salary = $salary;
        $lawyer->save();

        return [
            'id' => $lawyer->id,
            'name' => $lawyer->user->name ?? 'غير معروف',
            'salary' => $lawyer->salary,
            'profile' => $lawyer->user->profile,
        ];
    }

}
