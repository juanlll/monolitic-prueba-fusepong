<?php

namespace App\Repositories;

use App\Models\Company;
use App\Repositories\BaseRepository;

/**
 * Class CompanyRepository
 * @package App\Repositories
 * @version November 10, 2021, 1:26 pm -05
*/

class CompanyRepository extends BaseRepository
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
        return Company::class;
    }


    public function getCompaniesWithUser($userId){
        $companies = $this->model->whereHas('users', function($query) use ($userId){ 
            return $query->where('users.id', $userId);
        })->get();
        return $companies;
    }

}
