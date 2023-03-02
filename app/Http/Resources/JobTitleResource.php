<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobTitleResource extends JsonResource
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
            'id' => $this->id ?? '',
            'name' => $this->name ?? '',
            'created_at' => $this->created_at->timestamp ?? '',
            'updated_at' => $this->updated_at->timestamp ?? '',
        ];
    }
}
