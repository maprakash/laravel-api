<?php
namespace App\Repositories\Eloquent;

use App\Repositories\TeamRepositoryInterface;
use App\Team;

class TeamRepository extends BaseRepository implements TeamRepositoryInterface
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
    public function __construct(Team $model)
    {
        $this->model = $model;
    }
}
