<?php

namespace App\Services\Company;

use App\Repositories\CompanyRepository;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class CompanyService
{
    public function __construct(private readonly CompanyRepository $companyRepository)
    {
    }

    public function all(?int $minAge = null, ?int $maxAge = null): EloquentCollection
    {
        if ($minAge && $maxAge) {
            return $this->companyRepository->applyAgeFilters($minAge, $maxAge);
        }

        return $this->companyRepository->with('users')->get();
    }

    public function add(string $name, string $startedAt): void
    {
        $this->companyRepository->store([
            'name' => $name,
            'started_at' => $startedAt
        ]);
    }
}
