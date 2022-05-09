<?php

namespace App\Modules\Book\Repositories;

use App\Modules\Book\Transformers\BookTransformer;
use App\Repositories\Repository;
use App\Modules\Book\Models\Book;
use Yajra\DataTables\DataTables;

class BookRepository extends Repository
{
    use BookTransformer;

    public function __construct()
    {
        $this->model = new Book();
    }

    public function dataTable()
    {
        try {
            return DataTables::of($this->all())
                ->editColumn('state', function ($model) {
                    return view('layouts.admin.components.datatable.state', ['model' => $model]);
                })
                ->editColumn('title', function ($model) {
                    return strlen($model->title)>45 ? substr($model->title,0,45).'..' : $model->title;
                })
                ->addColumn('action', function ($model) {
                    return view('admin.articles.includes.actions', ['model' => $model]);
                })->make(true);
        }
        catch (Exception $exc) {
            throw new BaseException(1023);
        }
    }

    // Get all instances of model
    public function allActive()
    {
        try {
            return $this->model->where('state',1)->get();
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    // show the record with the given id
    public function show($id)
    {
        try {
            return $this->model->findOrFail($id);
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    public function getSearchBooks($keyword, $status = null)
    {
        try {
            $result = Book::where(function($query) use ($keyword){
                    $query->where('title','LIKE', '%'. $keyword .'%')
                    ->orWhere('description','LIKE', '%'. $keyword .'%')
                    ->orWhere('content','LIKE', '%'. $keyword .'%');
                })->when($status != null, function($q) use ($status) {
                    return $q->where('state', $status);
                });

            return $result;

        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    public function getPopularBooks($limit = 4, $status = null)
    {
        try {
            $result = $this->model->where('state',1)->orderBy('views','desc')->get()->take($limit);

            return $result;

        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }
}
