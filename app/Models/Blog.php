<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $fillable = [
        'title',
        'author',
    ];


    /**
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'         => 'title',
                'includeTrashed' => true
            ]
        ];
    }

    public function user() : belongsTo
    {
        return $this->belongsTo(User::class);
    }
}
