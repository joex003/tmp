<?php

namespace App\Services;

use App\Models\Employee;
use App\Exceptions\Custom;
use Exception;

class DeleteEmployee
{
    public function delete(): void
    {
        $employee = auth()->user();

        if (!$employee) {
            throw new Custom(__('messages.employee_not_found'), 404);
        }

        try {
            $employee->delete();
        } catch (Exception $e) {
            throw new Custom(__('messages.deletion_failed'), 500);
        }
    }
}
