<?php

namespace App\DataTables;

use App\Models\UserStory;

/**
 * Class UserStoryDataTable
 */
class UserStoryDataTable
{
    /**
     * @return UserStory
     */
    public function get()
    {
        /** @var UserStory $query */
        $query = UserStory::query()->select('user_stories.*');

        return $query;
    }
}
