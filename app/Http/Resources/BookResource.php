<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Models\Shelf;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $author = $this->authors()->first();
        $genre = $this->genres()->first();
        return [
            'id'    =>  $this->id,
            'name'    =>  $this->name,
            'category'    =>  $this->category_id,
            'shelf'  =>  Shelf::find($this->shelf_id)->name,
            'image_path'  =>  $this->image_path,
            'number_of_pages'  =>  $this->number_of_pages,
            'is_digit'  =>  $this->is_digit,
            'book_path'  =>  $this->book_path,
            'author'   =>  $author?->name,
            'genre'   =>  $genre?->name,
        ];
    }
}
