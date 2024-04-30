<?php

namespace App\Services\User;

use App\Repositories\UserRepository;

class UserService
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    public function add(string $name, int $age, ?int $companyId): void
    {
        $user = $this->userRepository->create([
            'name' => $name,
            'age' => $age,
        ]);

        if ($companyId) {
            $this->userRepository->addToCompany($user, $companyId);
        }
    }
}
