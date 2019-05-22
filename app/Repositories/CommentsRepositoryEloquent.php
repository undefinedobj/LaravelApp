<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CommentsRepository;
use App\Models\Comment;
use App\Validators\CommentsValidator;

/**
 * Class CommentsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CommentsRepositoryEloquent extends BaseRepository implements CommentsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Comment::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CommentsValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
