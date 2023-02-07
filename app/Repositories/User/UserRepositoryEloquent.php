<?php

namespace App\Repositories\User;

use App\DTO\FilterData;
use App\Models\User;
use App\Repositories\User\Abstracts\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * @inheritDoc
     */
    public function getFilteredUserWorkers(FilterData $data): LengthAwarePaginator
    {
        $filterUsers = $this->model->newQuery()
            ->join('workers', 'users.id', '=', 'workers.user_id')
            ->where('role_id', '=', 2);
        if (isset($data->query)){
            $filterUsers = $filterUsers->where('name', 'LIKE', '%'.$data->query.'%');
        }
        if (isset($data->department_id)){
            $filterUsers = $filterUsers
                ->where('workers.department_id', $data->department_id);
        }
        if (isset($data->position_id)){
            $filterUsers = $filterUsers->where('workers.work_position_id', $data->position_id);
        }
        return $filterUsers->paginate(15);
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
