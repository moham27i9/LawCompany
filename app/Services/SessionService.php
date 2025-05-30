<?php

namespace App\Services;

use App\Repositories\SessionRepository;

class SessionService
{
    protected $sessionRepository;

    public function __construct(SessionRepository $sessionRepository)
    {
        $this->sessionRepository = $sessionRepository;
    }

    public function all()
    {
        return $this->sessionRepository->all();
    }

    public function getById($id)
    {
        return $this->sessionRepository->getById($id);
    }

    public function create(array $data, $issueId)
    {
        $data['issue_id'] = $issueId;
        return $this->sessionRepository->create($data);
    }

    public function update($id, $data)
    {
        return $this->sessionRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->sessionRepository->delete($id);
    }




}
