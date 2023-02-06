<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthTokenWithUserResource extends JsonResource
{


    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'token' => $this->createToken('token')->plainTextToken,
            'user' => [
                'id' => $this->id,
                'login' => $this->login,
                'name' => $this->name,
                'email' => $this->email,
                'image' => $this->avatar,
                'about' => $this->about,
                'type' => $this->type,
                'github' => $this->github,
                'city' => $this->city,
                'is_finished' => $this->is_finished,
                'phone' => $this->phone,
                'birthday' => $this->birthday,
            ],
            'password' => $this->password,
        ];
    }

}
