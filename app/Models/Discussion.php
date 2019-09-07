<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

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
class Discussion extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = ['title','preface','img','reading','order','body', 'user_id', 'last_user_id'];

    /**
     * 获得拥有此帖子的用户
     */
    public function user()
    {
        return  $this->belongsTo(User::class,'user_id');
    }

    /**
     * 获得此帖子所拥有的评论
     */
    public function comments()
    {
        return  $this->hasMany(Comment::class);
    }

    /**
     * 获得拥有此帖子的分类
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return  $this->belongsTo(Category::class, 'categories_id');
    }

    /**
     * 远程一对多关联
     * 当前国家所有文章。
     * 当前帖子下的所有评论人
     */
    public function users()
    {
        return $this->hasManyThrough('App\Models\User', 'App\Models\Discussion');
    }
}
