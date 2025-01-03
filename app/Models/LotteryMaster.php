<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LotteryMaster extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'lottery_master';

    public function lottery()
    {
        return $this->hasMany(Lottery::class);
    }
}
