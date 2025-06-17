<?php

namespace App\Repositories;

use App\Models\Document;

class DocumentRepository
{
    public function getAll()
    {
        return Document::with('session')->get();
    }

    public function find($id)
    {
        return Document::findOrFail($id);
    }

    public function create(array $data,$session_id)
    {
        $data['session_id']=$session_id;
        return Document::create($data);
    }

    public function update(array $data,$session_id,$docId)
    {
        $document = Document::where('session_id',$session_id)->findOrFail($docId)->first();
        $document->update($data);
         $document->save();
        return $document;
    }

    public function delete($session_id,$docId)
    {
        $document = Document::where('session_id', $session_id)->findOrFail($docId)->first();
        return $document->delete();
    }
}
