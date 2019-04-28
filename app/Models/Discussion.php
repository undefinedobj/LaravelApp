<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Discussion
 *
 * @property int $id
 * @property string $title
 * @property string $body
 * @property int $user_id
 * @property int $last_user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discussion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discussion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discussion query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discussion whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discussion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discussion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discussion whereLastUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discussion whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discussion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discussion whereUserId($value)
 * @mixin \Eloquent
 */
class Discussion extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'last_user_id'];

    public function user()
    {
        return  $this->belongsTo(User::class,'user_id');
    }
}
