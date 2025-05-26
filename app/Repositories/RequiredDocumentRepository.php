<?php

namespace App\Repositories;

use App\Models\RequiredDocument;

class RequiredDocumentRepository
{
    public function getAll()
    {
        return RequiredDocument::with('issue')->latest()->get();
    }

    public function findById($id)
    {
        return RequiredDocument::findOrFail($id);
    }

    public function create(array $data)
    {
        if (isset($data['file']) && $data['file'] instanceof \Illuminate\Http\UploadedFile) {
            $filename = time() . '_' . uniqid() . '.' . $data['file']->getClientOriginalExtension();
            $data['file']->storeAs('required_docs', $filename, 'public');
            $data['file'] = 'storage/required_docs/' . $filename;
        }

        return RequiredDocument::create($data);
    }

    public function update($id, array $data)
    {
        $doc = $this->findById($id);

        if (isset($data['file']) && $data['file'] instanceof \Illuminate\Http\UploadedFile) {
            $filename = time() . '_' . uniqid() . '.' . $data['file']->getClientOriginalExtension();
            $data['file']->storeAs('required_docs', $filename, 'public');
            $data['file'] = 'storage/required_docs/' . $filename;
        }

        $doc->update($data);
        $doc->save();
        return $doc;
    }

    public function delete($id)
    {
        return RequiredDocument::destroy($id);
    }

    public function updateFile($id, $userId,$file)
{
    $document = RequiredDocument::with('issue')->findOrFail($id);

    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
    $file->storeAs('required_docs', $filename, 'public');

    $document->update([
        'file' => 'storage/required_docs/' . $filename,
        'status' => 'pending', // إعادة التقييم بعد الرفع
        'note' => null, // إعادة التقييم بدون ملاحظة قديمة
    ]);

    return $document;
}

}
