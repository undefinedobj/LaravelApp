<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\DiscussionRepository;
use App\Models\Discussion;
use App\Validators\DiscussionValidator;

/**
 * Class DiscussionRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class DiscussionRepositoryEloquent extends BaseRepository implements DiscussionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Discussion::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return DiscussionValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
