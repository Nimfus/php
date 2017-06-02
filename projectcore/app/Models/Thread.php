<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $table = 'threads';

    protected $fillable = ['thread_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * @return mixed
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'threads_users');
    }

    /**
     * @param Builder $query
     * @param string $threadId
     *
     * @return Builder
     */
    public function scopeByThreadId(Builder $query, string $threadId): Builder
    {
        return $query->where('thread_id', $threadId);
    }

    /**
     * @param string $threadId
     *
     * @return null|string
     */
    public function getThreadIdentifier(string $threadId): ?string
    {
        $thread = $this->byThreadId($threadId)->first();

        return is_null($thread) ? null : $thread->thread_id;
    }
}