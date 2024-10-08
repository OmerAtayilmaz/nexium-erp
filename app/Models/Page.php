<?php

namespace App\Models;

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

    public function getRouteKeyName()
    {
        return 'id'; // or 'slug' if using slugs
    }
}
