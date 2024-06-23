<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lottery extends Model
{
    use HasFactory;
    protected $fillable = ['lottery_master_id', 'expires_on'];


    public function lotteryMaster()
    {
        return $this->belongsTo(LotteryMaster::class);
    }

    public function lotteryNumbers()
    {
        return $this->hasMany(LotteryNumber::class);
    }
}
