<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Services\createEmployee;
use App\Services\UpdateEmployee;
use App\Http\Requests\RegisterEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Services\LoginEmployee;
use App\Http\Requests\LoginEmployeeRequest;
use App\Services\DeleteEmployee;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\CustomException;
use App\Services\GetAllEmployees;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
class EmployeeController extends Controller
{
    public function register(RegisterEmployeeRequest $request, CreateEmployee $createEmployee): JsonResponse|RedirectResponse
    {
        $validated = $request->validated();
        $result = $createEmployee->create($validated, true);
        Auth::login($result['employee']);

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => __('messages.registration_success'),
                'data' => [
                    'employee' => [
                        'id' => $result['employee']->id,
                        'name' => $result['employee']->name,
                        'email' => $result['employee']->email,
                        'hiredAt' => $result['employee']->created_at,
                    ],
                    'token' => $result['token'],
                ],
            ], Response::HTTP_CREATED);
        }
        return redirect()->route('employee.home')->with('success', __('messages.registration_success'));
    }



    public function update(UpdateEmployeeRequest $request, UpdateEmployee $updateEmployee): JsonResponse|RedirectResponse
    {
        $validated = $request->validated();
        $updateEmployee->update($validated);
        $message = __('messages.profile_updated');
        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => $message,
            ]);
        }

        return redirect()->route('employee.home')->with('success', $message);
    }


    public function login(LoginEmployeeRequest $request, LoginEmployee $loginEmployee): JsonResponse|RedirectResponse #consistency
    {
        $validated = $request->validated();

        $result = $loginEmployee->login($validated, true);

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => __('messages.login_success'),
                'token' => $result['token'],
            ], Response::HTTP_OK);
        }

        return redirect()->route('employee.home')
            ->with('success', __('messages.login_success'));
    }

    public function delete(DeleteEmployee $deleteEmployee): JsonResponse|RedirectResponse
    {
        $deleteEmployee->delete();

        if (request()->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => __('messages.employee_deleted'),
            ], Response::HTTP_OK);
        }

        Auth::logout();
        return redirect()->route('register')
            ->with('success', __('messages.employee_deleted'));

    }


    public function getAll(GetAllEmployees $getAllEmployees)
    {
        $employees = $getAllEmployees->getall();

        if (request()->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'employees' => $employees
            ]);
        }

        return view('employee.viewallEmployees', compact('employees'));
    }

}
