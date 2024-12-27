<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogUser extends Model
{
    use HasFactory;

    protected $table = 'blogusers';

    protected $fillable = [
        'user_id',
    ];

    public function followers()
    {
        return $this->belongsToMany(BlogUser::class, 'follows', 'following_id', 'follower_id');
    }

    public function following()
    {
        return $this->belongsToMany(BlogUser::class, 'follows', 'follower_id', 'following_id');
    }

    public function isFollowing($userId)
    {
        return $this->following()->where('following_id', $userId)->exists();
    }
}
