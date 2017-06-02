<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    /**
     * @var string
     */
    protected $table = 'blogposts';

    /**
     * @var array
     */
    protected $fillable = ['title', 'slug', 'content', 'published', 'published_at', 'created_by'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }
}