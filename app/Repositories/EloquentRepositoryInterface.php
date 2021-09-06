<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface EloquentRepositoryInterface
{
    /**
     * Get all models.
     *
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = []): Collection;


    public function findById(
        int $id,
        array $columns = ['*'],
        array $relations = []
    ): ?Model;

    public function findByName(
        string $name,
        array $filterColumns,
        array $columns = ['*'],
        array $relations = []
    ): ?Model;

    /**
     * Create a model.
     *
     * @param array $payload
     * @return Model
     */
    public function create(array $payload): ?Model;

    /**
     * Update existing model.
     *
     */
    public function update(int $id, array $payload): bool;

    /**
     * Delete model by id.
     *
     **/
    public function deleteById(int $id): bool;


}
