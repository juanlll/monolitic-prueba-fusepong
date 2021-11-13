<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class UserCompany
 * @package App\Models
 * @version November 10, 2021, 10:07 pm -05
 *
 * @property \App\Models\Company $company
 * @property \App\Models\User $user
 * @property integer $company_id
 * @property integer $user_id
 */
class UserCompany extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'user_company';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'company_id',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'company_id' => 'integer',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'company_id' => 'required|min:2|max:255',
        'user_id' => 'required|min:2|max:255'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function company()
    {
        return $this->belongsTo(\App\Models\Company::class, 'company_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
}
