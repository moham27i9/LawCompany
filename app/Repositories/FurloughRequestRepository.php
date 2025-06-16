<?php
namespace App\Repositories;

use App\Models\FurloughRequest;

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
