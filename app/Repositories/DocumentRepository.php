<?php

namespace App\Repositories;

use App\Models\Document;
use Cache;

class DocumentRepository
{
    public function getAll()
    {
            return Cache::remember('documents_all', now()->addMinutes(10), function () {
                return Document::with('session')->get();
            });
    }

    public function find($id)
    {
        return Document::findOrFail($id);
    }

    public function create(array $data,$session_id)
    {
        $data['session_id']=$session_id;
        Cache::forget('documents_all');
        return Document::create($data);
    }

    public function update(array $data,$session_id,$docId)
    {
        $document = Document::where('session_id',$session_id)->findOrFail($docId)->first();
        $document->update($data);
         $document->save();
          Cache::forget('documents_all');
        return $document;
    }

    public function delete($session_id,$docId)
    {
        $document = Document::where('session_id', $session_id)->findOrFail($docId)->first();
         Cache::forget('documents_all');
        return $document->delete();
    }
}
