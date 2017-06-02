<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLike extends Model
{
    protected $table = 'users_likes';

    protected $fillable = ['user_id', 'liked_by'];

    public $timestamps = false;
}