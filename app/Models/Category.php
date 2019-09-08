<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Category.
 *
 * @package namespace App\Models;
 */
class Category extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['parent_id', 'order', 'title', 'icon', 'uri'];

    /**
     * 文章类别的递归处理
     *
     * @param int $parent_id
     * @return array
     */
    public static function tree($parent_id = 0)
    {
        $columns = ['id', 'order', 'title', 'icon'];

        $rows = self::where('parent_id', $parent_id)
            ->orderBy('order', 'DESC')
            ->orderBy('id', 'DESC')
            ->get($columns);

        $array = [];

        if (sizeof($rows) != 0){
            foreach ($rows as $key => $val){
                $val['list'] = self::tree($val['id']);
                $array[] = $val;
            }
            return $array;
        }
    }
}
