<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function addToCompany(User $user, int $companyId): void
    {
        $user->companies()->syncWithoutDetaching([$companyId]);
    }
}
