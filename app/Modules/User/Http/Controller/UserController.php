<?php

namespace App\Modules\User\Http\Controller;

use App\Http\Controllers\Controller;
use App\Modules\User\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allUsers()
    {
        try {
            return $this->userService->allUsers();
        }
        catch (\Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggleStatus($id)
    {
        try {
            return $this->userService->toggleStatus($id);
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
    public function userBooks($id)
    {
        try {
            return $this->userService->userBooks($id);
        }
        catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allActiveUsersBooks()
    {
        try {
            return $this->userService->allActiveUsersBooks();
        }
        catch (\Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }
}
