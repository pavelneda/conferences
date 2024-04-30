<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conference extends Model
{
    use HasFactory;

    protected $guarded = false;


    public function industry(): BelongsTo
    {
        return $this->belongsTo(Industry::class);
    }

    public function materials(): HasMany
    {
        return $this->hasMany(Material::class);
    }

}
