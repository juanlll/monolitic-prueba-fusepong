<?php

namespace App\Repositories;

use App\Models\UserStory;
use App\Repositories\BaseRepository;

/**
 * Class UserStoryRepository
 * @package App\Repositories
 * @version November 10, 2021, 10:02 pm -05
*/

class UserStoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserStory::class;
    }
}
