<?php
namespace App\Repositories;

use App\Models\FurloughRequest;
use App\Models\Lawyer;

class FurloughRequestRepository
{
    public function getAll()
    {
        return FurloughRequest::all();
    }

    public function create(array $data)
    {
        return FurloughRequest::create($data);
    }

    public function getById($id)
    {
        return FurloughRequest::findOrFail($id);
    }

    public function getAllMyFurlough()
    {
        return FurloughRequest::where('covet_by_id',auth()->user()->id)->get();
    }

    public function update($id, array $data)
    {
        $request = FurloughRequest::findOrFail($id);
        $request->update($data);
        return $request;
    }

    public function delete($id)
    {
        $request = FurloughRequest::findOrFail($id);
        return $request->delete();
    }

    public function getByLawyerId($lawyerId)
    {
        // نجيب user_id الخاص بالمحامي
        $lawyer = Lawyer::findOrFail($lawyerId);

        return FurloughRequest::where('covet_by_id', $lawyer->user_id)
            ->where('covet_by_type', Lawyer::class)
            ->get();
    }

}
