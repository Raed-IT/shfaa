<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DeviceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /*
         name
        SN
        is_active
        hospital_id
        count
        company
        section_id
         * */
        return [
            "id"=>$this->id,
            "name" => $this->name,
            "SN" => $this->SN,
            "hospital" =>$this->hospital->name,
            "company" => $this->company,
            "section" =>$this->section->name,
        ];
    }
}
