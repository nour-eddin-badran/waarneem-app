<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use App\Models\Company;

class CompanyRepository extends BaseRepository
{
    public function __construct(Company $model)
    {
        parent::__construct($model);
    }

    public function applyAgeFilters(int $minAge, int $maxAge): EloquentCollection
    {
        return $this->model->with(['users' => function($query) use($minAge, $maxAge) {
            $query->where('age', '>=', $minAge)
                ->where('age', '<=', $maxAge);
        }])->whereRelation('users', function($query) use ($minAge, $maxAge) {
            $query->where('age', '>=', $minAge)
                ->where('age', '<=', $maxAge);
        })->get();
        // TODO applying a pagination
    }
}
