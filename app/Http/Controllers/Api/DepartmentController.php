<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DepartmentsResource;
use App\Services\Api\Department\Abstracts\DepartmentServiceInterface;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    public function __construct(
        public DepartmentServiceInterface $departmentService,
    )
    {
    }

    /**
     * @return DepartmentsResource
     * @throws \App\Exceptions\DefaultException
     */
    public function showDepartments(): DepartmentsResource
    {
        return new DepartmentsResource($this->departmentService->getDepartments());
    }

}
