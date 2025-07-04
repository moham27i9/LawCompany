<?php

namespace App\Repositories;

use App\Models\RequiredDocument;

class RequiredDocumentRepository
{
    public function getAll()
    {
        return RequiredDocument::get();
    }

    public function findById($id)
    {
        return RequiredDocument::findOrFail($id);
    }

    public function create(array $data,$issue_id)
    {
        if (isset($data['file']) && $data['file'] instanceof \Illuminate\Http\UploadedFile) {
            $filename = time() . '_' . uniqid() . '.' . $data['file']->getClientOriginalExtension();
            $filePath=$data['file']->storeAs('storage/required_docs', $filename, 'public');
            $data['file'] = $filePath;
        }
         $data['issue_id'] =$issue_id;
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
  if (isset($file['file']) && $file['file'] instanceof \Illuminate\Http\UploadedFile) {
            $filename =  time() . '_' . uniqid() . '.' . $file['file']->getClientOriginalExtension();
            $filePath = $file['file']->storeAs('storage/req-documents', $filename, 'public');
            $file['file'] = $filePath;
        }
        $file['user_id'] =  $userId;
    $document->update([
        'file' => 'storage/required_docs/' . $filename,
        'status' => 'pending', // إعادة التقييم بعد الرفع
        'note' => null, // إعادة التقييم بدون ملاحظة قديمة
    ]);

    return $document;
}

    public function getByIssueAndUser($issueId, $userId)
    {
        return \App\Models\RequiredDocument::where('issue_id', $issueId)
            ->whereHas('issue', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->get();
    }


}
