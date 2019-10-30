<?php

namespace App\Models\YaCold;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'ya_cold_users';

    /**
     * Get the phone record associated with the user.
     */
    public function discount()
    {
        return $this->hasOne(Discount::class, 'user_id');
    }
}
