<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class JobResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $collection = new Collection();

        $this->collection->map(function ($value) use ($collection) {
            $collection->push([
                'id' => $value->id,
                'company' => new CompanyResource($value->company),
                'job_title' => new JobTitleResource($value->jobTitle),
                'description' => $value->description,
                'status' => $value->status->key,
                'created_at' => $value->created_at->timestamp,
                'updated_at' => $value->updated_at->timestamp,
            ]);
        });

        return $collection->toArray();
    }
}
