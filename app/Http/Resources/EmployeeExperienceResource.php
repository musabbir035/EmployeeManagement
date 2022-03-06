<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeExperienceResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'organization' => $this->organization,
            'from_date' => date('d-m-Y', strtotime($this->from_date)),
            'to_date' => date('d-m-Y', strtotime($this->to_date)),
            'designation' => $this->designation,
            'duties' => $this->duties,
        ];
    }
}
