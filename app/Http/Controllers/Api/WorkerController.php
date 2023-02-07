<?php

namespace App\Http\Controllers\Api;

use App\DTO\FilterData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FilterRequest;
use App\Http\Resources\UserWorkerResource;
use App\Http\Resources\UserWorkersResource;
use App\Services\Api\Worker\Abstracts\UserServiceInterface;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function __construct(
        public UserServiceInterface $workerService,
    )
    {
    }

    /**
     * @param FilterRequest $request
     * @return UserWorkersResource
     */
    public function getWorkers(FilterRequest $request)
    {
        return new UserWorkersResource($this->workerService->getWorkers(FilterData::create($request->validated())));
    }

    public function getWorker($user){
        return new UserWorkerResource($this->workerService->getWorker($user));
    }
}
