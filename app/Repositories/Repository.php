<?php

namespace App\Repositories;

interface Repository
{
    public function all();

    public function show(int $id);

    public function findByUserId(int $userId);

    public function findByUserIdAndDate(int $userId, string $date);

    public function deleteWhereIn(string $key, array $data): void;

    public function deleteByUserId(int $userId): void;

    public function deleteWhere(array $data): void;

    public function existsWhere(array $where): bool;

    public function store(array $data);

    public function update(array $data, int $id);

    public function updateWhere(array $where, array $data): void;

    public function delete(int $id);
}
