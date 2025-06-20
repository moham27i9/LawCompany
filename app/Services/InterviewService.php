<?php
// app/Services/InterviewService.php
namespace App\Services;

use App\Repositories\InterviewRepository;
use Carbon\Carbon;
class InterviewService
{
    protected $repo;

    public function __construct(InterviewRepository $repo)
    {
        $this->repo = $repo;
    }

    public function create($data, $jobAppId)
    {
        return $this->repo->create($data, $jobAppId);
    }





public function update(array $data, $id)
{
    $interview = $this->repo->find($id);

    $interviewDate = Carbon::parse($interview->date);
    $now = Carbon::now();

    // الفرق بالأيام
    if ($now->diffInDays($interviewDate) < 1) {

        $remainingTime = $interviewDate->diffInHours($now);
        abort(403, 'عذرا ! لا يمكن تعديل وقت المقابلة قبل أقل من 24 ساعة من موعدها. الوقت المتبقي: ' . $remainingTime . ' ساعة.');
    }

    return $this->repo->update($data, $id);
}



    public function get($id)
    {
        return $this->repo->find($id);
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }

    public function getByJobApp($jobAppId)
    {
        return $this->repo->getByJobApp($jobAppId);
    }

    public function updateResult(array $data, $id)
    {
        $interview = $this->repo->updateResult($id, $data);
        if (auth()->user()->id !== $interview->jobApplication->user_id) {
            abort(403, 'غير مسموح لك بتعديل هذه المقابلة.');
        }
        return $interview;
    }


}

