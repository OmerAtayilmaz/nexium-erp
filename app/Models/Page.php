<?php

namespace App\Models;

use App\Http\Filters\V1\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Page extends Model
{
    use HasFactory;
    protected $fillable = ["id","title","keywords","content","description","slug","featured_image"];

    public function category(): BelongsTo{
        return $this->belongsTo(PageCategory::class);
    }

    public function scopeFilter(Builder $builder, QueryFilter $filters){
        return $filters->apply($builder);
    }

    public function getRouteKeyName()
    {
        return 'id'; // or 'slug' if using slugs
    }
}
