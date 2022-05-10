<?php

namespace App\Modules\User\Services;

use App\Modules\User\Repositories\UserRepository;
use Auth;
use App\Services\Services;
use App\Modules\User\Transformers\UserTransformer;

class UserService extends Services
{
    use UserTransformer;
    protected $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository();
    }

    public function allUsers()
    {
        try {
            $books = $this->userRepo->allUsers();
            return $this->transformUser($books);
        }
        catch (\Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }

    public function toggleStatus($id)
    {
        try {
            return $this->userRepo->toggleStatus($id);
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    public function userBooks($id)
    {
        try {
            $books =  $this->userRepo->userBooks($id);
            return $this->transformUserBooks($books);
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    public function allActiveUsersBooks()
    {
        try {
            $books = $this->userRepo->allActiveUsers();
            return $this->transformActiveUserBooks($books);
        }
        catch (\Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }
}


