<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
        'pivot'
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comfort(): BelongsToMany
    {
        return $this->belongsToMany(Comfort::class);
    }
}
