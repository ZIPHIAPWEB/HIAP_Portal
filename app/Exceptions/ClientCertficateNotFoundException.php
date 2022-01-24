<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class ClientCertficateNotFoundException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'message'   =>  'No certificate data to be download'
        ], Response::HTTP_NOT_FOUND);
    }
}
