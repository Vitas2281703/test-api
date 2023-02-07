<?php

namespace App\Services\Api\Worker\Abstracts;
use App\DTO\FilterData;
use App\Exceptions\AccessException;
use App\Exceptions\DefaultException;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface WorkerServiceInterface
{
    /**
     * @param FilterData $data
     * @return LengthAwarePaginator
     * @throws AccessException
     * @throws DefaultException
     */
    public function getWorkers(FilterData $data): LengthAwarePaginator;
    /**
     * @param $user
     * @return User
     * @throws AccessException
     * @throws DefaultException
     */
    public function getWorker($user);
}
