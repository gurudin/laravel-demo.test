<?php

namespace App\Models;

use App\Models\Traits\OrderTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Topics extends Model
{
    use OrderTrait;

    protected $table = 'topics';
    public $timestamps = true;

    protected $fillable = [
        'title',
        'body',
        'category_id',
        'excerpt',
        'slug',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    /**
     * 话题排序。
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param null                                  $order
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithOrder(Builder $builder, $order = null)
    {
        if ($order === 'recent') {
            $builder->createDesc();
        } else {
            $builder->updateDesc();
        }

        return $builder->with('user', 'category');
    }

    public function link($args = [])
    {
        return route('topics.show', array_merge([$this->id, $this->slug], $args));
    }
}
