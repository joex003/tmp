<?php

namespace App\Services;

use App\Models\Employee;
use App\Exceptions\CustomException;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class DeleteEmployee
{
    public function delete(): void
    {
        try {
            $employee = auth()->user();
            $employee->delete();
        } catch (Exception $e) {
            throw new CustomException(__('messages.deletion_failed'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
