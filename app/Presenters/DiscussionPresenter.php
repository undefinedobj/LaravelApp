<?php

namespace App\Presenters;

use App\Transformers\DiscussionTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class DiscussionPresenter.
 *
 * @package namespace App\Presenters;
 */
class DiscussionPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new DiscussionTransformer();
    }
}
