<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('books')->insert([
//            [
//                'name'  =>  'Book 1',
////                'author_id' =>  1,
//                'category_id'   =>  1,
//                'shelf_id'  =>  1,
//                'image_path'    =>  'test',
//                'is_digit'  =>  FALSE,
//            ],
//        ]);
        $book = Book::create([
            'name' => 'Book 1',
            'category_id' => 1,
            'shelf_id' => 1,
            'image_path' => 'test',
            'is_digital' => 0,
        ]);
        $book2 = Book::create([
            'name' => 'Book 2',
            'category_id' => 2,
            'shelf_id' => 2,
            'image_path' => 'test2',
            'is_digital' => 1,
        ]);
        $book->authors()->attach(Author::first());
        $book2->authors()->attach(Author::first());
        $book->genres()->attach(Genre::first());
        $book2->genres()->attach(Genre::first());
    }
}
