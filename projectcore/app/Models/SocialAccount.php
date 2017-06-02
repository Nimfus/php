<?php
namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    use Authenticatable;

    /**
     * @var string
     */
    protected $table = 'social_accounts';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'provider_user_id', 'provider', 'gender', 'link'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}