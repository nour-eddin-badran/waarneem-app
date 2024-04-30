<?php

namespace App\Services\Importer;

use App\Repositories\CompanyRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;

class ImportService
{
    public function __construct(private readonly CompanyRepository $companyRepository, private readonly UserRepository $userRepository)
    {
    }

    public function store(array $users): void
    {
        DB::transaction(function () use ($users) {
            // TODO it could be better performance if we used a bulk-insert for a huge imported data
            foreach ($users['users'] as $userData) {
                $user = $this->userRepository->updateOrCreate([
                    'external_id' => $userData['id']
                ], [
                    'name' => $userData['name'],
                    'age' => $userData['age'],
                ]);

                foreach ($userData['companies'] as $companyData) {
                    $company = $this->companyRepository->updateOrCreate([
                        'external_id' => $companyData['id']
                    ], [
                        'name' => $companyData['name'],
                        'started_at' => $companyData['started_at']
                    ]);

                    $this->userRepository->addToCompany($user, $company->id);
                }
            }
        });
    }
}
