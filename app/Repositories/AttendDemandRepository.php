<?php
namespace App\Repositories;

use App\Models\AttendDemand;

class AttendDemandRepository
{
    public function create(array $data)
    {
        return AttendDemand::create($data);
    }

    public function update(array $data, $id)
    {
        $demand = AttendDemand::findOrFail($id);
        $demand->update($data);
        return $demand;
    }

    public function delete($id)
    {
        $demand = AttendDemand::findOrFail($id);
        return $demand->delete();
    }

    public function getById($id)
    {
        return AttendDemand::findOrFail($id);
    }

    public function getByIssue($issueId)
    {
        return AttendDemand::where('issue_id', $issueId)->get();
    }
}
