<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Services\createEmployee;
use App\Services\UpdateEmployee;
use App\Http\Requests\RegisterEmployee;
use App\Http\Requests\UpdateEmployeeDTO;
use Symfony\Component\HttpFoundation\Response;
use App\Services\LoginEmployee;
use App\Http\Requests\LoginEmployeeRequest;
use App\Services\DeleteEmployee;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\Custom;
use App\Services\GetAllEmployees;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
class EmployeeController extends Controller
{
    //
    protected $createEmployee;
    protected $updateEmployee;
    protected $loginEmployee;
    protected $deleteEmployee;
    protected $getAllEmployees;
    public function __construct(createEmployee $createEmployee, UpdateEmployee $updateEmployee, LoginEmployee $loginEmployee, DeleteEmployee $deleteEmployee, GetAllEmployees $getAllEmployees)
    {
        $this->createEmployee = $createEmployee;
        $this->updateEmployee = $updateEmployee;
        $this->loginEmployee = $loginEmployee;
        $this->deleteEmployee = $deleteEmployee;
        $this->getAllEmployees = $getAllEmployees;
    }
    public function register(RegisterEmployee $request): JsonResponse|RedirectResponse
    {
        try {
            $validated = $request->validated();
            $result = $this->createEmployee->create($validated, true);

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

        } catch (Custom $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => __('messages.registration_failed'),
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            return redirect()->back()
                ->withErrors(['email' => __('messages.registration_failed')])
                ->withInput();
        }
    }



    public function update(UpdateEmployeeDTO $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validated();

        try {
            $this->updateEmployee->update($validated);

            $message = __('messages.profile_updated');

            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => $message,
                ]);
            }

            return redirect()->route('employee.home')->with('success', $message);

        } catch (Custom $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ], $e->getCode() ?: Response::HTTP_BAD_REQUEST);
            }

            return redirect()->back()->withInput()->withErrors([
                'email' => $e->getMessage(),
            ]);
        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => __('messages.error_occurred'),
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            return redirect()->back()->withInput()->withErrors([
                'general' => __('messages.error_occurred'),
            ]);
        }
    }


    public function login(LoginEmployeeRequest $request, LoginEmployee $loginEmployee): JsonResponse|RedirectResponse
    {
        $validated = $request->validated();

        try {
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
        } catch (Custom $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ], $e->getCode() ?: Response::HTTP_UNAUTHORIZED);
            }

            return redirect()->back()
                ->withErrors(['email' => $e->getMessage()])
                ->withInput();
        }
    }

    public function delete(): JsonResponse|RedirectResponse
    {
        try {
            $this->deleteEmployee->delete();

            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => __('messages.employee_deleted'),
                ], Response::HTTP_OK);
            }

            Auth::logout();
            return redirect()->route('register')
                ->with('success', __('messages.employee_deleted'));

        } catch (Custom $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ], $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }


    public function getAll(Request $request)
    {
        $employees = $this->getAllEmployees->getall();

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'employees' => $employees
            ]);
        }

        return view('employee.viewallEmployees', compact('employees'));
    }

}
