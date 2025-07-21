<?php

namespace App\Exceptions;

use Exception;

class Custom extends Exception
{
    //
    public function __construct($message = "", $code = 500)
    {
        parent::__construct($message, $code);
    }
    public function render($request)
    {
        return response()->view('errors.custom', [
            'message' => $this->getMessage()
        ], $this->getCode() ?? 500);
    }
}
