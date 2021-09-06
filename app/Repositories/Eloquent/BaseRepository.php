<?php

namespace App\Repositories\Eloquent;

use App\Repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->with($relations)->get($columns);
    }


    /**
     * Find model by id.
     *
     * @param int $Id
     * @param array $columns
     * @param array $relations
     * @param array $appends
     * @return Model
     */
    public function findById(
        int $id,
        array $columns = ['*'],
        array $relations = [],
        array $appends = []
    ): ?Model {
        return $this->model->select($columns)->with($relations)->findOrFail($id);
    }

    public function findByName(
        string $name,
        array $filterColumns,
        array $columns = ['*'],
        array $relations = []
    ): ?Model {
        $count = count($filterColumns);
        if($count > 0)
        {
            $concat = "concat(";
            for($i=0;$i<$count;$i++)
            {
                $concat .= $filterColumns[$i];
                $concat .= ($i<$count-1)?",' ',":"";

            }
            $concat .= ")";

        }
        return $this->model->select('*')->where(DB::raw($concat), 'LIKE' , '%'.$name.'%')->with($relations)->first();
   }

    /**
     * Create a model.
     *
     * @param array $payload
     * @return Model
     */
    public function create(array $payload): ?Model
    {
        $model = $this->model->create($payload);

        return $model->fresh();
    }

    /**
     * Update existing model.
     *
     * @param int $id
     * @param array $payload
     * @return bool
     */
    public function update(int $id, array $payload): bool
    {
        $model = $this->findById($id);

        return $model->update($payload);
    }

    /**
     * Delete model by id.
     *
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id): bool
    {
        return $this->findById($id)->delete();

    }


}
