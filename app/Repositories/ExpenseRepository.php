<?php
namespace App\Repositories;

use App\Models\Expense;

class ExpenseRepository
{
    public function all()
    {
        return Expense::all();
    }

    public function find($id)
    {
        return Expense::findOrFail($id);
    }

    public function create(array $data)
    {
        return Expense::create($data);
    }

    public function update($id, array $data)
    {
        $expense = $this->find($id);
        $expense->update($data);
        $expense->save();
        return $expense;
    }

    public function delete($id)
    {
        return Expense::destroy($id);
    }
}
