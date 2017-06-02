<?php
namespace App\Models;

use App\Traits\Likable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

/**
 * Class User
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    use Notifiable, Likable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles', 'user_id', 'role_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany(UserLike::class, 'user_id', 'id');
    }

    /**
     * @return Role
     */
    public function getRoleAttribute()
    {
        return $this->roles()->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function threads()
    {
        return $this->belongsToMany(Thread::class, 'threads_users');
    }

    /**
     * @return bool
     */
    public function isAdmin() : bool
    {
        return (bool) $this->roles()->bySlug('admin')->first();
    }

    /**
     * @param $value
     *
     * @return string
     */
    public function getCreatedAtAttribute($value): string
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y H:i');
    }

    /**
     * @param $query
     *
     * @return Builder
     */
    public function scopeWithAvatar($query): Builder
    {
        return $query->where('avatar', '<>', null);
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return Storage::disk('images')->url('avatars/' . $this->avatar);
    }

    /**
     * @param Builder $query
     * @param array $ids
     *
     * @return Builder
     */
    public function scopeByMultiIds(Builder $query, array $ids): Builder
    {
        return $query->whereIn('id', $ids);
    }
}
