<?php
/**
 * Created by PhpStorm.
 * User: Nimfus
 * Date: 01.01.17
 * Time: 15:36
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * @var string
     */
    protected $table = 'roles';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $type
     *
     * @return mixed
     */
    public function scopeBySlug($query, $type)
    {
        return $query->where('slug', $type);
    }
}