<?php
// app/Repositories/InterviewRepository.php
namespace App\Repositories;

use App\Models\Interview;

class InterviewRepository
{
    public function create(array $data, $jobAppId)
    {
        $data['jobApp_id'] = $jobAppId;
        return Interview::create($data);
    }

    public function update(array $data, $id)
    {
        $interview = Interview::findOrFail($id);
        $interview->update($data);
        return $interview;
    }

    public function find($id)
    {
        return Interview::with([
            'jobApplication' => function ($query) {
                $query->select('id', 'HirReq_id', 'status'); // فقط الأعمدة المطلوبة
            },
            'jobApplication.hiringRequest' => function ($query) {
                $query->select('id', 'jopTitle'); // فقط اسم الوظيفة
            }
        ])->findOrFail($id);
    }


    public function delete($id)
    {
        return Interview::findOrFail($id)->delete();
    }

    public function getByJobApp($jobAppId)
    {
        return Interview::where('jobApp_id', $jobAppId)->get();
    }


    public function updateResult($id, array $data)
{
    $interview = Interview::findOrFail($id);

    $interview->update([
        'result' => $data['result'],
        'note' => $data['note'] ?? null,
    ]);

    return $interview;
}


}
