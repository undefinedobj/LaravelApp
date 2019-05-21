<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
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
