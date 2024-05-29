<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->id,
            'name' => $this->name,
            'gender' => $this->gender,
            'address' => $this->address,
            'citizen_identification_card' => $this->citizen_identification_card,
            'date_of_birth' => $this->date_of_birth,
            'phone_number' => $this->phone_number,
            'username' => $this->username,
            'token' => $this->createToken("Token")->plainTextToken,
            'role' => $this->roles->pluck('name') ?? [],
            'roles.permissions' => $this->getPermissionsViaRoles()->pluck(['name']) ?? [],
            'permissions' => $this->permissions->pluck('name') ?? []
        ];
    }
}
