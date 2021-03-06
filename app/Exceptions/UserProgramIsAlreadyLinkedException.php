<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class UserProgramIsAlreadyLinkedException extends Exception
{
    /**
     * Report the exception.
     *
     * @return bool|null
     */
    public function report()
    {
        //
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response()->json([
            'errors'    =>  [
                'message'   =>  'User program is linked to a payment'
            ],
            'status'    =>  Response::HTTP_UNAUTHORIZED
        ], Response::HTTP_UNAUTHORIZED);
    }
}
