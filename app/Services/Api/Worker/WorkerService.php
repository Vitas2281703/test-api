<?php

namespace App\Services\Api\Worker;
use App\DTO\FilterData;
use App\Exceptions\AccessException;
use App\Exceptions\DefaultException;
use App\Models\User;
use App\Repositories\User\Abstracts\UserRepositoryInterface;
use App\Services\Api\Worker\Abstracts\WorkerServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class WorkerService implements WorkerServiceInterface
{

    public function __construct(
        public UserRepositoryInterface $repository
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function getWorkers(FilterData $data): LengthAwarePaginator
    {
        if (Auth::user()){
            $user = Auth::user();

            if ($user->role_id == 3){
                throw new AccessException();
            }
            if ($user->role_id == 2){
                $data->department_id = $user->worker->depatment_id;
            }
            if ($user->role_id == 1 || $user->role_id == 2){
                return $this->repository->getFIlteredUserWorkers($data);
            }
        }
        throw new DefaultException();
    }

    /**
     * @inheritDoc
     */
    public function getWorker($user): User
    {
        $findUser = $this->repository->findByField('id', $user)->first();
        if (Auth::user()){
            $authUser = Auth::user();
            if ($authUser->role_id == 3){
                throw new AccessException();
            }
            if($authUser->role_id == 2 && isset($findUser->worker->department_id)){
                if($authUser->worker->department_id == $findUser->worker->department_id){
                    return $findUser;
                }
            }

            if ($authUser->role_id == 1){
                return $findUser;
            }
        }
        throw new DefaultException();
    }

}
