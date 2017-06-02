<?php
/**
 * Created by PhpStorm.
 * User: Nimfus
 * Date: 01.01.17
 * Time: 17:07
 */

namespace App\Repositories;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class UsersRepository extends BaseRepository
{
    /**
     * UsersRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $parameters
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findBy(array $parameters): ?Model
    {
        $query = $this->model->with('roles');
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
        $query = $this->model->with('roles');
        foreach ($parameters as $parameter => $value) {
            $query->where($parameter, $value);
        }

        return $query->paginate($this->perPage);
    }
}