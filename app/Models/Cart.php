<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function lottery()
    {
        return $this->belongsTo(Lottery::class, 'lottery_id', 'id');
    }
}
