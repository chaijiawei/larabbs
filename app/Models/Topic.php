<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = [
        'title', 'body', 'category_id', 'user_id', 'excerpt', 'slug',
    ];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeWithOrder(Builder $query, $order = 'recentReply')
    {
        switch($order) {
            case 'recentReply':
                $query->recentReply();
                break;
            case 'recentCreate':
                $query->recentCreate();
                break;
            default:
                $query->recentReply();
        }

        return $query;
    }

    public function scopeRecentReply(Builder $query)
    {
        return $query->orderByDesc('updated_at');
    }

    public function scopeRecentCreate(Builder $query)
    {
        return $query->orderByDesc('created_at');
    }

    public function link($params = [])
    {
        return route('topics.show', array_merge(['topic' => $this->id, 'slug' => $this->slug], $params));
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
