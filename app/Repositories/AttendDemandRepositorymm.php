<?php

use App\Models\AttendDemand;

class AttendDemandRepository
{
    public function allForIssue($issue_id)
    {
        return AttendDemand::where('issue_id', $issue_id)->get();
    }

    public function find($id)
    {
        return AttendDemand::findOrFail($id);
    }

    public function create(array $data,$lawyer_id)
    {
        return AttendDemand::create([
            'date' => $data['date'],
            'issue_id' => $data['issue_id'],
            'lawyer_id' =>$lawyer_id,
        ]);
    }

    public function update(array $data, $id)
    {
        $attendDemand = AttendDemand::findOrFail($id);

        $attendDemand->update([
            'date' => $data['date'] ?? $attendDemand->date,
            'issue_id' => $data['issue_id'] ?? $attendDemand->issue_id,
        ]);

        return $attendDemand;
    }

    public function delete($id)
    {
        $attendDemand = AttendDemand::findOrFail($id);
        $attendDemand->delete();
        return true;
    }
}

