<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalDetailsUser extends Model
{
    use HasFactory;

    protected $table = 'additional_details_user';
    public $timestamps = false;

    /**
     * Get the user that owns the AdditionalDetailsUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
