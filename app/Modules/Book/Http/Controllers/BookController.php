<?php

namespace App\Modules\Book\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Book\Http\Requests\UpdateRequest;
use App\Modules\Book\Http\Requests\CreateRequest;
use Illuminate\Http\Request;
use App\Modules\Book\Services\BookService;

class BookController extends Controller
{
    private $bookService;

    public function __construct()
    {
        $this->bookService = new BookService();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return $this->bookService->allActiveOwn();
        }
        catch (\Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        try {
            return $this->bookService->allActive();
        }
        catch (\Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        try {
            return $this->bookService->create($request);
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return $this->bookService->show($id);
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            return $this->bookService->update($request, $id);
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            return $this->bookService->delete($id);
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }
}
