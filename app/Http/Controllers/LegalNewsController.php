<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLegalNewsRequest;
use App\Services\LegalNewsService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class LegalNewsController extends Controller
{
   Use ApiResponseTrait;
    protected $service;

    public function __construct(LegalNewsService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $news = $this->service->getAll();
            return $this->successResponse($news);

    }


    public function store(StoreLegalNewsRequest $request)
    {
        $New = $this->service->store($request->validated());
         return $this->successResponse($New, 'New added successfully');
    }

    public function show($id)
    {
        $New = $this->service->getById($id);
         return $this->successResponse($New);
    }


    public function update(StoreLegalNewsRequest $request, $id)
    {
        $New = $this->service->update($id, $request->validated());
         return $this->successResponse($New, 'New updated successfully');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
         return $this->successResponse(null, 'New deleted successfully');
    }
    public function get_latest()
    {
         return $this->successResponse($this->service->get_latest(), 'Get New Latest successfully');
    }


    public function save($newId)
    {
        $userId = auth()->user()->id;

        $this->service->save($userId, $newId);

        return $this->successResponse(null, 'تم حفظ الخبر بنجاح.');
    }

    public function unsave($newId)
    {
        $userId = auth()->user()->id;

        $this->service->unsave($userId, $newId);

        return $this->successResponse(null, 'تم إزالة الخبر من المحفوظات.');
    }

    public function getSavedNews()
    {
        $userId = auth()->id();
        $news = $this->service->getUserSavedNews($userId);

        return $this->successResponse($news, 'قائمة الاخبار المحفوظة');
    }
}
