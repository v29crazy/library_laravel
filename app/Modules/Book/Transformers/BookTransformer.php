<?php

namespace App\Modules\Book\Transformers;

use App\Modules\Book\Models\Book;

trait BookTransformer
{
    public function transformBook(Book $book)
    {
        return [
            'id'      => (int) $book->id,
            'title'   => $book->title,
            'image'   => $book->image,
            'description'   => $book->description,
            'content'   => $book->content,
            'status'  => (object) [
                'status_value' => $book->state
            ],
        ];
    }

}

