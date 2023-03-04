<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email' => $this->email,
            'username' => $this->username,
            'role' => $this->role,
            $this->mergeWhen($request->route('path') === 'company', [
                'company' => [
                    'name' => $this->company ? $this->company->name : null,
                    'about' => $this->company ? $this->company->about : null,
                    'address' => $this->company ? $this->company->address : null,
                    'phone_number' => $this->company ? $this->company->phone_number : null,
                ]
            ]),
            'created_at' => $this->created_at->timestamp,
            'updated_at' => $this->updated_at->timestamp,
        ];
    }
}
