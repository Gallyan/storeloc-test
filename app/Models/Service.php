<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    /**
     * The store list that belong to the service.
     */
    public function stores(): belongsToMany
    {
        return $this->belongsToMany(Store::class);
    }
}
