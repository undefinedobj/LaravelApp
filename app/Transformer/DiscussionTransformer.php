<?php


namespace App\Transformer;


class DiscussionTransformer extends Transformer
{
    public function transformer($discussion)
    {
        return [
            'title'              => $discussion['title'],
            'body'               => $discussion['body'],
        ];
    }

}
