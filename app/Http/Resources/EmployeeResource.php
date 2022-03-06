<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'roll' => $this->roll,
            'designation' => $this->designation,
            'department' => $this->department,
            'educations' => EmployeeEducationResource::collection($this->educations),
            'experiences' => EmployeeExperienceResource::collection($this->experiences),
            'date_added' => date('d-M-Y h:i a', strtotime($this->created_at)),
            'date_updated' => date('d-M-Y h:i a', strtotime($this->updated_at))
        ];
    }
}
