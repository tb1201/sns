<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory;
    //use HasFactory, SoftDeletes;
    
     protected $fillable = [
        'title',
        'body',
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }
    
    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\User', 'likes')->withTimestamps();
    }
    
    public function isLikedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->likes->where('id', $user->id)->count()
            : false;
    }
    
    public function getCountLikesAttribute(): int
    {
        return $this->likes->count();
    }
    
    //記事モデルからタグモデルへのリレーション
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Tag')->withTimestamps();
    }
}
