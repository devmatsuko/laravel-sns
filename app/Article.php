<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// リレーションの追加
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    // Userモデルとのリレーション
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }
}
