<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Comment.
 *
 * @package namespace App\Models;
 */
class Comment extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = ['body', 'user_id', 'discussion_id'];

    /**
     * 获得拥有此评论的用户
     */
    public function user()
    {
        return  $this->belongsTo(User::class);
    }

    /**
     * 获得拥有此评论的帖子
     */
    public function discussion()
    {
        return  $this->belongsTo(Discussion::class);
    }



}
