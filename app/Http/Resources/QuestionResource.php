<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'form_id' => $this->form_id,
            'name' => $this->name,
            'choice_type' => $this->choice_type,
            'choices' => $this->choices,
            'is_required' => $this->is_required,
     // Assuming you have FormResource to transform form data
        ];
    }
}
