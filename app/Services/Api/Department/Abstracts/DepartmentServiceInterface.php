<?php

namespace App\Services\Api\Department\Abstracts;
use App\Exceptions\DefaultException;
use App\Models\Department;
use Illuminate\Database\Eloquent\Collection;

interface DepartmentServiceInterface
{
    /**
     * @return Collection
     * @throws DefaultException
     */
    public function getDepartments(): Collection;
}
