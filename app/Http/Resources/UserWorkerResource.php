<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserWorkerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'login' => $this->login,
            'name' => $this->name,
            'email' => $this->email,
            'image' => $this->avatar,
            'about' => $this->about,
            'type' => $this->type,
            'github' => $this->github,
            'worker' => [
                'department' => $this->worker->department->name ?? null,
                'position' => $this->worker->workPosition->name ?? null,
                'adopted_at' => $this->worker->adopted_at ?? null,
            ]
        ];
    }
}
