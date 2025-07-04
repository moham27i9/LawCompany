<?php

namespace App\Repositories;

use App\Models\Report;

class ReportRepository
{
    public function create(array $data)
    {
        return Report::create($data);
    }

    public function getAll()
    {
        return Report::with('employee')->get();
    }

    public function getById($id)
    {
        return Report::with('employee')->findOrFail($id);
    }

    public function delete($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();
        return true;
    }
}
