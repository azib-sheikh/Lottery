<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserChosenNumber extends Model
{
    use HasFactory;
    protected $table = 'user_chosen_numbers';
    protected $fillable = [
        'user_id','lottery_id','lottery_master_id','number'
    ];
}
