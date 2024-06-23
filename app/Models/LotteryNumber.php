<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LotteryNumber extends Model
{
    use HasFactory;

    protected $fillable = [
        'lottery_id','lottery_master_id','number'
    ];
}
