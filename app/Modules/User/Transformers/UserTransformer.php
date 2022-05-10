<?php

namespace App\Modules\User\Transformers;

use App\Models\User;

trait UserTransformer
{
    public function transformUser(object $users)
    {
        $formattedUsers=[];

        foreach ($users as $user){
            $formatUser['id'] = (int) $user->id;
            $formatUser['name']   = $user->name;
            $formatUser['email']   = $user->email;
            $formatUser['is_active'] = $user->is_active;
            $formatUser['is_admin'] = $user->is_admin;
            $formatUser['created_at'] = $user->created_at;
            array_push($formattedUsers, $formatUser);
        }

        return $formattedUsers;
    }

    public function transformActiveUserBooks(object $users)
    {
        $formattedBooks=[];

        foreach ($users as $user){
            foreach ($user->books as $book){
                $formatBook['id'] = (int) $book->id;
                $formatBook['title']   = $book->title;
                $formatBook['image']   = $book->image;
                $formatBook['description'] = $book->description;
                $formatBook['content'] = $book->content;
                $formatBook['user_id'] = $book->user->id;
                $formatBook['user_name'] = $book->user->name;
                $formatBook['created_at'] = $book->created_at;
                array_push($formattedBooks, $formatBook);
            }
        }

        return $formattedBooks;
    }

    public function transformUserBooks(object $books)
    {
        $formattedBooks=[];

        foreach ($books as $book){
            $formatBook['id'] = (int) $book->id;
            $formatBook['title']   = $book->title;
            $formatBook['image']   = $book->image;
            $formatBook['description'] = $book->description;
            $formatBook['content'] = $book->content;
            $formatBook['user_id'] = $book->user->id;
            $formatBook['user_name'] = $book->user->name;
            $formatBook['created_at'] = $book->created_at;
            array_push($formattedBooks, $formatBook);
        }

        return $formattedBooks;
    }
}

