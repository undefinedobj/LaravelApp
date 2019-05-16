<?php

namespace App\Repositories;

use App\Models\Discussion;

class DiscussionRepository
{
    /**
     * 根据id获取 Discussion 实例
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return Discussion::findOrFail($id);
    }
}