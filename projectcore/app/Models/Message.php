<?php
/**
 * Created by PhpStorm.
 * User: Nimfus
 * Date: 18.02.17
 * Time: 17:05
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    protected $fillable = ['sender_id', 'recipient_id', 'thread_id', 'message'];

    /**
     * @param Builder $query
     * @param int $thread
     *
     * @return Builder
     */
    public function scopeThread(Builder $query, int $thread): Builder
    {
        return $query->where('thread_id', $thread);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }
}