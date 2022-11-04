<?php

namespace App\Http\Resources;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class JournalResource extends JsonResource
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
            'id'  =>  $this->id,
            'user_id'  =>  $this->user_id,
            'book'  =>  $this->book_id,
            'start_date'    =>  $this->start_date,
            'end_date'    =>  $this->end_date,
            'status'    =>  $this->status,
        ];
    }
}
