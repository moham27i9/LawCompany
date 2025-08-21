<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LawyerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'               => $this->id,
            'name'             => $this->user->name,
            'email'            => $this->user->email ?? null,
            'address'          => $this->user->profile->address ?? null,
            'phone'            => $this->user->profile->phone ?? null,
            'age'              => $this->user->profile->age ?? null,
            'image'            => $this->user->profile->image ?? null,
            'license_number'   => $this->license_number,
            'experience_years' => $this->experience_years,
            'type'             => 'lawyer',
            'specialization'   => $this->specialization,
            'certificate'      => $this->certificate,
        ];
    }
}
