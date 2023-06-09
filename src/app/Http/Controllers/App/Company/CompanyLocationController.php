<?php

namespace App\Http\Controllers\App\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\App\Company\CompanyLocationRequest;
use App\Models\App\Company\CompanyLocation;
use App\Services\App\Company\CompanyLocationService;

class CompanyLocationController extends Controller
{
    public function __construct(CompanyLocationService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service
            ->latest()
            ->paginate(request()->get('per_page', 10));
    }

    public function store(CompanyLocationRequest $request)
    {
        $this->service
            ->setAttributes($request->only('address'))
            ->save();

        return created_responses('company_location');
    }

    public function show(CompanyLocation $companyLocation): object
    {
        return $companyLocation;
    }

    public function update(CompanyLocationRequest $request, CompanyLocation $companyLocation)
    {
        $this->service
            ->setModel($companyLocation)
            ->setAttributes($request->only('address'))
            ->save();

        return updated_responses('company_location');
    }

    public function destroy(CompanyLocation $companyLocation)
    {
        $companyLocation->delete();

        return deleted_responses('company_location');
    }

    public function getAllLocations(CompanyLocation $companyLocation)
    {
        return $companyLocation->all();
    }
}
