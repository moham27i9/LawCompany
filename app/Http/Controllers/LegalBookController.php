<?php
// app/Http/Controllers/LegalBookController.php
namespace App\Http\Controllers;

use App\Http\Requests\LegalBookRequest;
use App\Http\Requests\StoreLegalBookRequest;
use App\Services\LegalBookService;
use App\Traits\ApiResponseTrait;

class LegalBookController extends Controller
{
    Use ApiResponseTrait;
    protected $service;

    public function __construct(LegalBookService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $books = $this->service->getAll()->map(function ($book) {// أو Storage::url() إذا كنت تستخدم symlink
            return $this->successResponse($book);
        });

    }


    public function store(StoreLegalBookRequest $request)
    {
        $book = $this->service->store($request->validated());
         return $this->successResponse($book, 'Book added successfully');
    }

    public function show($id)
    {
        $book = $this->service->getById($id);
        $book->book = asset('storage/' . $book->book);
         return $this->successResponse($book);
    }


    public function update(StoreLegalBookRequest $request, $id)
    {
        $book = $this->service->update($id, $request->validated());
         return $this->successResponse($book, 'Book updated successfully');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
         return $this->successResponse(null, 'Book deleted successfully');
    }


    public function save($bookId)
    {
        $userId = auth()->user()->id;

        $this->service->save($userId, $bookId);

        return $this->successResponse(null, 'تم حفظ الكتاب بنجاح.');
    }

    public function unsave($bookId)
    {
        $userId = auth()->user()->id;

        $this->service->unsave($userId, $bookId);

        return $this->successResponse(null, 'تم إزالة الكتاب من المحفوظات.');
    }

    public function getSavedBooks()
    {
        $userId = auth()->id();
        $books = $this->service->getUserSavedBooks($userId);

        return $this->successResponse($books, 'قائمة الكتب المحفوظة');
    }


}

