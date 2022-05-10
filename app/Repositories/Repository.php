<?php

namespace App\Repositories;

use App\Constants\AppConstant;
use Illuminate\Database\Eloquent\Model;
use Image;
use Storage;


class Repository
{

    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    // Get all instances of model
    public function all()
    {
        try {
            return $this->model->all();
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    // create a new record in the database
    public function create(array $data)
    {
        try {
            return $this->model->create($data);
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    // update record in the database
    public function update(array $data, $id)
    {
        try {
            $record = $this->model->findOrFail($id);
            return $record->update($data);
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    // remove record from the database
    public function delete($id)
    {
        try {
            return $this->model->destroy($id);
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

    // Get the associated model
    public function getModel()
    {
        try {
            return $this->model;
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    // Set the associated model
    public function setModel($model)
    {
        try {
            $this->model = $model;
            return $this;
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    // Eager load database relationships
    public function with($relations)
    {
        try {
            return $this->model->with($relations);
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    // Get all instances of model
    public function allActive()
    {
        try {
            return $this->model->all()->where('state',1);
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    public function getItems($where = [], $groupBy = [], $orderBy = 'ASC')
    {
        try {
            $model = $this->model->query();
            $model->orderBy('id', $orderBy);

            if (is_array($where) && count($where) > 0) {
                $model->where($where);
            }

            if (is_array($groupBy) && count($groupBy) > 0) {
                $model->groupBy($groupBy);
                $model->selectRaw('*, sum(qty) as group_sum');
            }

            return $model->get();
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }


    public function like($where, $keyword)
    {
        try {
            $model = $this->model->query();

            $model->where ( $where, 'LIKE', '%' . $keyword . '%' )->latest()->first();

            return $model->get();
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    public function addMedia($id, $file, $collection, $customProperties = [])
    {
        try {
            $collection = !$collection ? 'default' : $collection;
            $model = $this->model->findOrFail($id);

            if ($file) {
                $path = $this->moveFile($file);
                $model->addMedia($path)
                    ->withCustomProperties($customProperties)
                    ->toMediaCollection($collection);
            }
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    protected function moveFile($file)
    {

        try {
            $name = $file->getClientOriginalName();

            $fileParts = pathinfo($name);
            $ext = $fileParts['extension'];
            $name = $fileParts['filename'];
            $fileNameWithHash = $this->createFileName('', $name, $ext);
            $destination = storage_path() . '/media';

            $file->move($destination, $fileNameWithHash);

            return $destination . '/' . $fileNameWithHash;
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    public function clearMedia($id, $slug)
    {
        try {
            $model = $this->model->findOrFail($id);
            if ($model->getFirstMedia($slug)) {
                $model->media->each->delete($slug);
            }
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    private function createFileName($path, $fileName, $ext)
    {
        try {
            $fileName = $this->cleanFileName($fileName);
            $path = $path . $fileName;
            $hashKey = hash('ripemd160', $path . date("Y-m-d H:i:s"));
            return $fileName . '-' . $hashKey . '.' . $ext;
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    public function cleanFileName($fileName)
    {
        try {
            $fileName = strtolower(str_replace(' ', '-', $fileName)); // Replaces all spaces with hyphens.
            $fileName = preg_replace('/[^A-Za-z0-9\-]/', '', $fileName); // Removes special chars.
            return preg_replace('/-+/', '-', $fileName); // Replaces multiple hyphens with single one.
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    public function updateOrCreate($find = [], $update = [])
    {
        try {
            return $this->model->updateOrCreate($find, $update);
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }


    public function resizeAndStore($image, $path, $width, $height, $withOutPath = null)
    {
        try {
            $imageName = time().'-'.pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME).'.'.$image->extension();

            $img = Image::make($image->path());
            if($width!=null && $height!=null){
                $img->resize($width, $height, function ($constraint) {
                });
            }

            $img->stream();

            Storage::put('public/'.$path.'/'.$imageName, $img);
            if ($withOutPath != null) {
                return $imageName;
            } else {
                return $path.'/'.$imageName;
            }

        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    public function prev($id)
    {
        try {
            return $this->model->where('id', '<', $id)->where('state',1)->orderBy('id','desc')->first();
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    public function next($id)
    {
        try {
            return $this->model->where('id', '>', $id)->where('state',1)->orderBy('id')->first();
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    // show the record with the given id
    public function findFromSlug($slug, $field = 'slug')
    {
        try {
            return $this->model->where($field,$slug)->first();
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    public function userTheme()
    {
        try {
            if(auth()->user()->theme_dark==1){
                $theme=0;
            }else{
                $theme=1;
            }
            auth()->user()->update([
                'theme_dark'=>$theme
            ]);
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }
}
