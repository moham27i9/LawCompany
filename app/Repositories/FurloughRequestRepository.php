<?php
namespace App\Repositories;

use App\Models\FurloughRequest;

class FurloughRequestRepository
{
    public function getAll()
    {
        return FurloughRequest::with('covet_by.user')->get();
    }
    
    public function create(array $data)
    {
        return FurloughRequest::create($data);
    }
    
    public function getById($id)
    {
        return FurloughRequest::with('covet_by.user')->findOrFail($id);
    }
    
    public function getAllMyFurlough()
    {

    $user = auth()->user();

    return FurloughRequest::with('covet_by')
        ->get()
        ->filter(function ($furlough) use ($user) {
            return optional($furlough->covet_by)->user->id === $user->id;
        });


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
}
