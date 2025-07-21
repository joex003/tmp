<?php
namespace App\Services;

use App\Exceptions\Custom;
use App\Models\Employee;
use Exception;

class UpdateEmployee
{
    public function update(array $data): array
    {
        $employee = Employee::where('id', auth()->id())->first();
        if (!$employee) {
            throw new Custom(__('messages.employee_not_found'), 404);
        }

        if (isset($data['name'])) {
            $employee->name = $data['name'];
        }

        if (isset($data['email'])) {
            $emailTaken = Employee::where('email', $data['email'])
                ->where('id', '!=', $employee->id)
                ->exists();

            if ($emailTaken) {
                throw new Custom(__('messages.email_taken'), 422);
            }

            $employee->email = $data['email'];
        }

        $employee->save();

        return [
            'status' => 'success',
            'message' => __('messages.profile_updated'),
        ];
    }

}
