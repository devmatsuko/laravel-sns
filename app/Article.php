<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// リレーションの追加
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    protected $fillable = [
        'title',
        'body',
    ];

    // Userモデルとのリレーション
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    // Tagモデルとのリレーション
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    // いいねにおけるArticleモデルとUserモデルのリレーション(多対多)
    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'likes')->withTimestamps();
    }

    // いいねを判定するメソッド
    public function isLikedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->likes->where('id', $user->id)->count()
            : false;
    }

    // いいね数をカウントするメソッド(アクセサ)
    public function getCountLikesAttribute(): int
    {
        return $this->likes->count();
    }
}
