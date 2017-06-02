<?php
namespace App\Traits;

use App\Models\UserLike;

trait Likable
{
    public function like()
    {
        $like = $this->getExistingLike();
        if ($like) {
            $like->delete();
        } else {
            UserLike::create([
                'user_id' => $this->id,
                'liked_by' => auth()->user()->id
            ]);
        }

    }

    private function getExistingLike()
    {
        return UserLike::where([
            'user_id' => $this->id,
            'liked_by' => auth()->user()->id
        ])->first();
    }
}