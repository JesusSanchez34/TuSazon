<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    protected $fillable = ['user_id', 'platillo_id', 'cantidad'];

    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

    public function platillo(): BelongsTo
    {
        return $this->belongsTo(Platillo::class);
    }
}
