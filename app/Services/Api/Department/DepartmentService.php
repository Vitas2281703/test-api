<?php

namespace App\Services\Api\Department;
use App\Exceptions\DefaultException;
use App\Models\Department;
use App\Repositories\Department\Abstracts\DepartmentRepositoryInterface;
use App\Services\Api\Department\Abstracts\DepartmentServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class DepartmentService implements DepartmentServiceInterface
{

    public function __construct(
        public DepartmentRepositoryInterface $repository
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function getDepartments(): Collection
    {
        if (Auth::user()){
            return $this->repository->all();
        }
        throw new DefaultException();
    }

}
