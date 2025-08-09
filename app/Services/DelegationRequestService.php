<?php
namespace App\Services;

use App\Repositories\DelegationRequestRepository;
use Illuminate\Support\Facades\Storage;

class DelegationRequestService
{
    protected $repository;

    public function __construct(DelegationRequestRepository $repository)
    {
        $this->repository = $repository;
    }

    public function submitRequest(array $data,$session_id)
    {
     
                if (isset($data['delegation_file']) && $data['delegation_file'] instanceof \Illuminate\Http\UploadedFile) {
            $filename = 'delegations' . $session_id . '.' . $data['delegation_file']->getClientOriginalExtension();
            $filePath = $data['delegation_file']->storeAs('storage/delegations', $filename, 'public');
            $data['delegation_file'] = $filePath;

        }
          $data['session_id'] = $session_id;
          $data['original_lawyer_id'] = auth()->user()->lawyer->id;
        return $this->repository->create($data);
    }

    public function updateRequest($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function deleteRequest($id)
    {
        return $this->repository->delete($id);
    }

    public function getRequestById($id)
    {
        return $this->repository->find($id);
    }

    public function getAllRequests()
    {
        return $this->repository->getAll();
    }


    public function approveRequest($id, array $data)
    {
        $approved =$this->repository->updateStatus($id, [
            'status' => 'approved',
            'delegate_lawyer_id' => $data['delegate_lawyer_id'],
            'admin_note' => $data['admin_note'] ?? null
        ]);

        return  $approved;
    }

    public function rejectRequest($id, $note = null)
    {
           $delegation = $this->getRequestById($id);
           if( $delegation->status !== 'rejected' && $delegation->status !== 'approved') 
           {

               return $this->repository->updateStatus($id, [
                   'status' => 'rejected',
                   'admin_note' => $note
               ]);
           }
           else{
            return null;
           }
    }
}   
