<?php

namespace App\Http\Controllers\App\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\App\Company\DepartmentRequest;
use App\Models\App\Company\Department;
use App\Services\App\Company\DepartmentService;


class DepartmentController extends Controller
{
    public function __construct(DepartmentService $service)
    {
        $this->service = $service;
    }

    public function index(): object
    {
        return $this->service
            ->latest()
            ->paginate(request()->get('per_page', 10));
    }

    public function store(DepartmentRequest $request): array
    {
        $this->service
            ->setAttributes($request->only('name'))
            ->save();

        return created_responses('department');
    }

    public function show(Department $department): object
    {
        return $department;
    }

    public function update(DepartmentRequest $request, Department $department)
    {
        $this->service
            ->setModel($department)
            ->setAttributes($request->only('name'))
            ->save();

        return updated_responses('department');
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return deleted_responses('department');
    }

    public function getAllDepartments(Department $department)
    {
        return $department->all();
    }
}
