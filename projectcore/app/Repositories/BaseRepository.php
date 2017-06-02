<?php
/**
 * Created by PhpStorm.
 * User: Nimfus
 * Date: 01.01.17
 * Time: 17:07
 */

namespace App\Repositories;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements Repository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @var int
     */
    protected $page = 1;

    /**
     * @var int
     */
    protected $perPage = 30;

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
     * @param array $parameters
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findBy(array $parameters): ?Model
    {
        $query = $this->model;
        foreach ($parameters as $parameter => $value) {
            $query->where($parameter, $value);
        }

        return $query->first();
    }

    /**
     * @param array $parameters
     *
     * @return LengthAwarePaginator|null
     */
    public function paginate(array $parameters) : ?LengthAwarePaginator
    {
        $query = $this->model;
        foreach ($parameters as $parameter => $value) {
            $query->where($parameter, $value);
        }

        return $query->paginate($this->perPage);
    }

    /**
     * @param int $perPage
     *
     * @return Repository
     */
    public function setPerPage(int $perPage) : Repository
    {
        $this->perPage = $perPage;

        return $this;
    }
}