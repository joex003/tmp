<?php
namespace App\Services;

use App\Exceptions\CustomException;
use App\Models\Employee;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class UpdateEmployee
{
    public function update(array $data): array
    {
        try {
            $employee = auth()->user();
            $employee->update($data);
            return [
                'status' => 'success',
                'message' => __('messages.profile_updated'),
            ];
        } catch (CustomException $error) {
            throw new CustomException(__('messages.update_failed'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
