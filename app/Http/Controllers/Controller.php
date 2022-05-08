<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $serverError = ['message' => 'Internal Server Error'];

    protected function _renderView(string $view, array $data = [])
    {
        return view($view, $data)->render();
    }

    protected function _success( $message = "Request Successful")
    {
        return response()->json(['message' => $message], 200);
    }

    protected function _serverError( $message = "Internal Server Error")
    {
        return response()->json(['message' => $message], 500);
    }
}
