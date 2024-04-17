<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ResponseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return ([
           
                
                    "date" => $this->date,
                    "user" => [
                        "id"=> $this->user->id,
                        "name" => $this->user->username,
                        "email" => $this->user->email,
                    ],
                    "answer" => [
                        "p" => "bb",
                        "alamat" => "bbb",
                        "tanggal lahir" => "bbb",
                        "gender" => "bbb",
                    ]
                ,
                
            
        ]);
    }
}
