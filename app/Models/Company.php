<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Company
 * @package App\Models
 * @version November 10, 2021, 1:26 pm -05
 *
 * @property string $name
 * @property string $nit
 * @property integer $phone
 */
class Company extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'companies';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'nit',
        'phone',
        'address',
        'email'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'nit' => 'string',
        'phone' => 'integer',
        'address'=> 'string',
        'email'=> 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|min:2|max:200',
        'nit' => 'required|min:2|max:20',
        'phone' => 'required|min:10|max:10',
        'address' => 'required|max:55',
        'email' => 'required|min:5|max:55'
    ];

    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class, 'user_company', 'company_id','user_id');
    }

    
}
