<?php

namespace App\Repositories\User\Abstracts;

use App\DTO\FilterData;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepositoryInterface.
 *
 * @package namespace App\Repositories;
 */
interface UserRepositoryInterface extends RepositoryInterface
{
    /**
     * @param FilterData $data
     * @return LengthAwarePaginator
     */
    public function getFilteredUserWorkers(FilterData $data): LengthAwarePaginator;
}
