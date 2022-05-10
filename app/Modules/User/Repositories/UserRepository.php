<?php

namespace App\Modules\User\Repositories;

use App\Modules\User\Transformers\UserTransformer;
use App\Repositories\Repository;
use App\Models\User;

class UserRepository extends Repository
{
    use UserTransformer;

    public function __construct()
    {
        $this->model = new User();
    }

    // Get all instances of model
    public function allUsers()
    {
        try {
            return $this->model->where('id','<>',1)->get();
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    // Get all instances of model
    public function allActiveUsers()
    {
        try {
            return $this->model->where('is_active',1)->get();
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    public function toggleStatus($id)
    {
        try {
            $user= $this->model->findOrFail($id);
            if($user->is_active){
                $user->update(['is_active'=>0]);
            }else{
                $user->update(['is_active'=>1]);
            }
            return true;
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    public function userBooks($id)
    {
        try {
            return $this->model->findOrFail($id)->books;
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

}
