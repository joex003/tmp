<?php
namespace App\Services;
use App\Models\Employee;

class GetAllEmployees
{
    public function getall()
    {
        return Employee::select('name', 'email')->paginate(3);
    }
}