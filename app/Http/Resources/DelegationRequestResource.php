<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DelegationRequestResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'              => $this->id,
            'session_id'      => $this->session_id,
            'status'              => $this->status,
            'original_lawyer_id'   => $this->original_lawyer_id,
            'delegete_lawyer_id'   => $this->delegete_lawyer_id,
            'admin_note'              => $this->admin_note,
            'delegation_file'              => asset($this->delegation_file),
            'originalLawyer'  => new LawyerResource($this->originalLawyer),
            'delegateLawyer'  => new LawyerResource($this->delegateLawyer),
            'session'         => $this->session,
        ];
    }
}
