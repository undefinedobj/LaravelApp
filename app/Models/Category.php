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
     * 文章类别的树形结构
     *
     * @return array
     */
    public function tree()
    {
        $categories = self::all(['id', 'parent_id', 'order', 'title', 'icon'])->toArray();

        return $this->list_to_tree($categories);
    }

    /**
     * 将数组进行树形结构处理
     *
     * @param $list
     * @param string $primary_key
     * @param string $parent_id
     * @param string $child
     * @param int $root
     * @return array
     */
    public function list_to_tree($list, $primary_key = 'id', $parent_id = 'parent_id', $child = '_child', $root = 0)
    {
        // 创建Tree
        $tree = [];
        if(is_array($list)) {
            // 创建基于主键的数组引用
            $refer = [];
            foreach ($list as $key => $data) {
                $refer[$data[$primary_key]] =& $list[$key];
            }

            foreach ($list as $key => $data) {
                // 判断是否存在parent_id
                $parentId = $data[$parent_id];
                if ($root == $parentId) {
                    $tree[] =& $list[$key];
                }else{
                    if (isset($refer[$parentId])) {
                        $parent =& $refer[$parentId];
                        $parent[$child][] =& $list[$key];
                    }
                }
            }
        }
        return $tree;
    }
}
