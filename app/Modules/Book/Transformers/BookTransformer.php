<?php

namespace App\Modules\Book\Transformers;

use App\Modules\Book\Models\Book;

trait BookTransformer
{
    public function transformBook(object $books)
    {
        $formattedBooks=[];

        foreach ($books as $book){
            $book->user_id= $book->user->name;
            $formatBook['id'] = (int) $book->id;
            $formatBook['title']   = $book->title;
            $formatBook['image']   = $book->image;
            $formatBook['description'] = $book->description;
            $formatBook['content'] = $book->content;
            $formatBook['user_id'] = $book->user_id;
            $formatBook['user_name'] = $book->user->name;
            array_push($formattedBooks, $formatBook);
        }

        return $formattedBooks;
    }

}

