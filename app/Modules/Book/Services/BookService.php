<?php

namespace App\Modules\Book\Services;

use App\Modules\Book\Repositories\BookRepository;
use Auth;
use App\Services\Services;

class BookService extends Services
{
    protected $bookRepo;

    public function __construct()
    {
        $this->bookRepo = new BookRepository();
    }

    public function allActive()
    {
        try {
            return $this->bookRepo->allActive();
        }
        catch (\Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }

    public function create(object $request)
    {
        try {
            if($request->hasFile('cover')){
                $image = $request->file('cover');
                $imageNamePath = $this->bookRepo->resizeAndStore($image,'book-covers',770,460);
                $request->request->set('image', $imageNamePath);
            }
            if(!isset($request->state)){
                $request->request->set('state', 0);
            }
            $request->request->set('hits', 0);
            if ($book = $this->bookRepo->create($request->all())) {
                return response(['message'=> 'Book Added!'],200);
            }
            return $this->_server_error();
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    public function update(object $request,$id)
    {
        try {
            if($request->hasFile('cover')){
                $image = $request->file('cover');
                $imageNamePath = $this->bookRepo->resizeAndStore($image,'book-covers',770,460);
                $request->request->set('image', $imageNamePath);
            }
            if ($this->bookRepo->update($request->all(),$id)) {
                return response(['message'=> 'Book Updated!'],200);
            }
            return $this->_server_error();
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            if ($this->bookRepo->delete($id)) {
                return response(['message'=> 'Book Deleted!'],200);
            }
            return $this->_server_error();
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    public function dataTable()
    {
        try {
            return $this->bookRepo->dataTable();
        }
        catch (\Exception $exc) {
            throw $exc;
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    public function show($id)
    {
        try {
            return $this->bookRepo->show($id);
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    public function prev($id)
    {
        try {
            return $this->bookRepo->prev($id);
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    public function next($id)
    {
        try {
            return $this->bookRepo->next($id);
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    public function getSearchBooks($keyword, $status = 1)
    {
        try {
            return $this->bookRepo->getSearchBooks($keyword, $status);
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    public function getPopularBooks($limit = 4, $status = 1)
    {
        try {
            return $this->bookRepo->getPopularBooks($limit, $status);
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    public function findFromSlug($slug)
    {
        try {
            return $this->bookRepo->findFromSlug($slug);
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }
}


