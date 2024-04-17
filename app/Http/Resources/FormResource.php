<?php

namespace App\Http\Resources;

use App\Http\Resources\QuestionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FormResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return([
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'allowed_domains' => $this->allowed_domains,
            'description' => $this->description,
            'limit_one_response' => $this-> limit_one_response,
            'creator_id' => $this->creator_id,
            'creator_name' => $this->creator->username,
            'questions' => QuestionResource::collection($this->questions),
             
        ]);
    }
}
