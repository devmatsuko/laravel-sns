<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    protected $fillable = [
        'name',
    ];

    // タグ名の前に「#」をつけるアクセサ
    public function getHashtagAttribute(): string
    {
        return '#' . $this->name;
    }

    // 記事モデルとのリレーション(多対多)
    public function articles(): BelongsToMany
    {
        return $this->belongsToMany('App\Article')->withTimestamps();
    }

}
