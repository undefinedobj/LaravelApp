<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Discussion;

/**
 * Class DiscussionTransformer.
 *
 * @package namespace App\Transformers;
 */
class DiscussionTransformer extends TransformerAbstract
{
    /**
     * Transform the Discussion entity.
     *
     * @param \App\Models\Discussion $model
     *
     * @return array
     */
    public function transform(Discussion $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

//            'user_id'    =>   (int) \Auth::user()->id,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
