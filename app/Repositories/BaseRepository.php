<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @method static where
 * @method static whereRelation
 * @method static findOrFail
 * @method static updateOrCreate
 * @method static deleteWhere
 */
abstract class BaseRepository implements Repository
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, int $id)
    {
        $call = $this->model->find($id);
        $call->update($data);
        return $call;
    }

    public function updateWhere(array $where, array $data): void
    {
        $this->model->where($where)->update($data);
    }

    public function delete(int $id)
    {
        $call = $this->model->find($id);
        $call->delete();
        return $call;
    }

    public function show(int $id)
    {
        return $this->model->find($id);
    }

    public function findWhere(array $where)
    {
        return $this->model->where($where)->get();
    }

    public function existsWhere(array $where): bool
    {
        return $this->model->where($where)->exists();
    }

    public function findOneWhere(array $where)
    {
        return $this->model->where($where)->first();
    }

    public function findByUserId(int $userId)
    {
        return $this->model->whereUserId($userId)->get();
    }

    public function deleteByUserId(int $userId): void
    {
        $this->model->whereUserId($userId)->delete();
    }

    public function deleteWhere(array $data): void
    {
        $this->model->where($data)->delete();
    }

    public function deleteWhereIn(string $key, array $data): void
    {
        $this->model->whereIn($key, $data)->delete();
    }

    public function findByUserIdAndDate(int $userId, string $date)
    {
        return $this->model->where(['user_id' => $userId, 'date' => $date])->first();
    }

    public function __call($method, $args)
    {
        return $this->model->$method(...$args);
    }

    public function bulkInsert(array $data): void
    {
        DB::table($this->model->getTable())->insert($data);
    }
}
