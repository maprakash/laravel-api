<?php
namespace App\Repositories\Eloquent;

use App\Repositories\PlayerRepositoryInterface;
use App\Player;

class PlayerRepository extends BaseRepository implements PlayerRepositoryInterface
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
    public function __construct(Player $model)
    {
        $this->model = $model;
    }
}
