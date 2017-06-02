<?php
namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: Nimfus
 * Date: 01.01.17
 * Time: 16:35
 */
interface Repository
{
    /**
     * @param array $parameters
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findBy(array $parameters) : ?Model;

    /**
     * @param array $parameters
     *
     * @return LengthAwarePaginator|null
     */
    public function paginate(array $parameters) : ?LengthAwarePaginator;

    /**
     * @param int $perPage
     *
     * @return Repository
     */
    public function setPerPage(int $perPage) : Repository;
}