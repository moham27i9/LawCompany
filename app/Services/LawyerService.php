<?php

namespace App\Services;

use App\Repositories\LawyerRepository;
use App\Models\User;
use App\Events\NewNotificationEvent;
use App\Models\Lawyer;
use Illuminate\Support\Facades\DB;

class LawyerService
{
    protected $lawyerRepository;

    public function __construct(LawyerRepository $lawyerRepository)
    {
        $this->lawyerRepository = $lawyerRepository;
    }

  public function create(array $data)
{
    return DB::transaction(function () use ($data) {
        $user = auth()->user();

        if ($user->lawyer) {
            return null;
        }

        // التعامل مع الملف
        if (isset($data['certificate']) && $data['certificate'] instanceof \Illuminate\Http\UploadedFile) {
            $filename = 'lawyer_cert_' . $user->id . '.' . $data['certificate']->getClientOriginalExtension();
              $data['certificate']->storeAs('certificates', $filename, 'public');
            $data['certificate'] =  'storage/certificates/' . $filename;
        }

        return $this->lawyerRepository->create($data);
    });
}

    // app/Services/LawyerService.php

    public function getAll()
    {
        $lawyers = $this->lawyerRepository->getAll();
        if ($lawyers->isEmpty()) {
            return [];
        }

        $lawyersData = [];
        foreach ($lawyers as $lawyer) {
            $lawyersData[] = [
                'id' => $lawyer->id,
                'name' => $lawyer->user->name,
                'email' => $lawyer->user->email,

                'address' => $lawyer->user->profile->address,
                'phone' => $lawyer->user->profile->phone,
                'age' => $lawyer->user->profile->age,
                'image' => $lawyer->user->profile->image ? asset($lawyer->user->profile->image) : null,

                'license_number' => $lawyer->license_number,
                'experience_years' => $lawyer->experience_years,
                'type' => $lawyer->type,
                'specialization' => $lawyer->specialization,
                'certificate' => $lawyer->certificate ? asset($lawyer->certificate): null
            ];
        }
        return $lawyersData;
    }


public function getById($id)
{
    $lawyer = $this->lawyerRepository->getById($id);

    if ($lawyer) {
        return [
            'id'=>$lawyer->id,
            'name' => $lawyer->user->name,
            'email' => $lawyer->user->email,

            'address' => $lawyer->user->profile->address,
            'phone' => $lawyer->user->profile->phone,
            'age' => $lawyer->user->profile->age,
            'image' => $lawyer->user->profile->image ? asset($lawyer->user->profile->image) : null,

            'license_number' => $lawyer->license_number,
            'experience_years' => $lawyer->experience_years,
            'type' => $lawyer->type,
            'specialization' => $lawyer->specialization,
            'certificate' =>asset($lawyer->certificate),
        ];
    }

    return null;
}




public function update($id, $data)
{
    return $this->lawyerRepository->update($id, $data);
}

public function delete($id)
{
    $lawyer = $this->lawyerRepository->getById($id);
    $user = $lawyer->user;
    $user->role_id = 2;
    $user->save();

    return $this->lawyerRepository->delete($id);
}

  public function getLawyerIssues() {
        return $this->lawyerRepository->getIssuesForLawyer();
    }

  public function getLawyerSessions() {
        return $this->lawyerRepository->getSessionsForLawyer();
    }

    public function setSalary($lawyer_id, array $data)
    {
        return $this->lawyerRepository->updateSalary($lawyer_id, $data['salary']);
    }
}
