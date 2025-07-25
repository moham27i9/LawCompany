<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLawyerRequest;
use App\Http\Requests\SetLawyerSalaryRequest;
use App\Http\Requests\UpdateLawyerRequest;
use App\Services\LawyerService;
use App\Traits\ApiResponseTrait;

class LawyerController extends Controller
{
    use ApiResponseTrait;

    protected $lawyerService;

    public function __construct(LawyerService $lawyerService)
    {
        $this->lawyerService = $lawyerService;
    }

    public function store(CreateLawyerRequest $request)
    {
        $lawyer = $this->lawyerService->create($request->validated());
        if(!$lawyer )
        return $this->errorResponse('this user is actually registered as lawyer!', 422);
        return $this->successResponse($lawyer, 'Lawyer created successfully');
    }

    // app/Http/Controllers/LawyerController.php

public function index()
{
    $lawyers = $this->lawyerService->getAll();
    return $this->successResponse($lawyers, 'All lawyers retrieved');
}

public function show($id)
{
    $lawyer = $this->lawyerService->getById($id);
    return $this->successResponse($lawyer, 'Lawyer retrieved');
}

public function update(UpdateLawyerRequest $request)
{
    $lawyer = $this->lawyerService->update(auth()->user()->lawyer->id, $request->validated());

    return $this->successResponse($lawyer, 'Profile updated successfully');
}

public function destroy($id)
{
    $this->lawyerService->delete($id);
    return $this->successResponse(null, 'Lawyer deleted');
}

public function profile()
{
    $lawyer = $this->lawyerService->getById(auth()->user()->lawyer->id);
    return $this->successResponse($lawyer, 'Your profile');
}


    public function showMyIssue() {
        $issues = $this->lawyerService->getLawyerIssues();
            return $this->successResponse($issues, 'Your issues retrieved');
             return $this->errorResponse('something wrong!!', 422);
    }

    public function showLawyerIssues($id) {
        $issues = $this->lawyerService->getLwIssues($id);
            return $this->successResponse($issues, 'Lawyer issues retrieved');
             return $this->errorResponse('something wrong!!', 422);
    }


    public function showMySession() {
        $sessions = $this->lawyerService->getLawyerSessions();
            return $this->successResponse($sessions, 'Your sessions retrieved');
             return $this->errorResponse('something wrong!!', 422);
    }


    public function setSalary(SetLawyerSalaryRequest $request, $lawyer_id)
    {
        $lawyer = $this->lawyerService->setSalary($lawyer_id, $request->validated());

        if ($lawyer) {
            return $this->successResponse($lawyer, 'تم تعديل الراتب بنجاح');
        }

        return $this->errorResponse('فشل في تعديل الراتب', 422);
    }

    public function show_myconsultations_lawyer()
    {

        $consultations = $this->lawyerService->show_myconsultations_lawyer();

        if ($consultations) {
            return $this->successResponse($consultations, 'تمت استعادة الاستشارات بنجاح');
        }

        return $this->errorResponse('فشل في استعادة الاستشارات ', 422);
    }

}

