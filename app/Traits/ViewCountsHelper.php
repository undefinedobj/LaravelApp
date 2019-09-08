<?php

namespace App\Traits;

use Redis;
use Carbon\Carbon;

trait ViewCountsHelper
{
    // 缓存相关
    protected $hash_prefix = 'discussion_view_counts_';
    protected $field_prefix = 'discussion_';

    public function viewCountIncrement()
    {
        // 获取今日 Redis 哈希表名称，如：discussion_view_counts_2017-10-21
        $hash = $this->getHashFromDateString(Carbon::now()->toDateString());

        // 字段名称，如：discussion_1
        $field = $this->getHashField();

        // 当前阅读数，如果存在就自增，否则就为 1
        $count = Redis::hGet($hash, $field);
        if ($count) {
            $count++;
        } else {
            $count = 1;
        }

        // 数据写入 Redis ，字段已存在会被更新
        Redis::hSet($hash, $field, $count);
    }

    public function syncDiscussionViewCounts()
    {
        // 获取昨日的哈希表名称，如：discussion_view_counts_2017-10-21
        $hash = $this->getHashFromDateString(Carbon::now()->toDateString());

        // 从 Redis 中获取所有哈希表里的数据
        $counts = Redis::hGetAll($hash);

        // 如果没有任何数据直接 return
        if (count($counts) === 0) {
            return;
        }

        // 遍历，并同步到数据库中
        foreach ($counts as $discussion_id => $view_count) {
            // 会将 `discussion_1` 转换为 1
            $discussion_id = str_replace($this->field_prefix, '', $discussion_id);

            // 只有当话题存在时才更新到数据库中
            if ($discussion = $this->find($discussion_id)) {
                $discussion->view_count = $this->attribute['view_count'] + $view_count;
                $discussion->save();
            }
        }

        // 以数据库为中心的存储，既已同步，即可删除
        Redis::del($hash);
    }

    public function getViewCountAttribute($value)
    {
        // 获取今日对应的哈希表名称
        $hash = $this->getHashFromDateString(Carbon::now()->toDateString());

        // 字段名称，如：discussion_1
        $field = $this->getHashField();

        // 三元运算符，优先选择 Redis 的数据，否则使用数据库中
        $count = Redis::hGet($hash, $field) ? : $value;

        // 如果存在的话，返回 数据库中的阅读数 加上 Redis 中的阅读数
        if ($count) {
            return $this->attribute['view_count'] + $count;
        } else {
            // 否则返回 0
            return 0;
        }
    }

    public function getHashFromDateString($date)
    {
        // Redis 哈希表的命名，如：discussion_view_counts_2017-10-21
        return $this->hash_prefix . $date;
    }

    public function getHashField()
    {
        // 字段名称，如：discussion_1
        return $this->field_prefix . $this->id;
    }
}
