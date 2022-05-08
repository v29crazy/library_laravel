<?php

namespace App\Services;

class Services
{

    protected $serverError = ['message' => 'Internal Server Error'];

    protected function _renderView(string $view, array $data = [])
    {
        return view($view, $data)->render();
    }

    protected function _information( $message = "Informational Response")
    {
        return response()->json(['message' => $message], 100);
    }
    protected function _success( $message = "Request Response")
    {
        return response()->json(['message' => $message], 200);
    }
    protected function _redirection( $message = "Redirection Response")
    {
        return response()->json(['message' => $message], 300);
    }
    protected function _client_error( $message = "Client Error Response")
    {
        return response()->json(['message' => $message], 400);
    }

    protected function _server_error( $message = "Server Error Response")
    {
        return response()->json(['message' => $message], 500);
    }
}
