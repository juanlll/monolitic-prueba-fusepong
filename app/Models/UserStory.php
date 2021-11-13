<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class UserStory
 * @package App\Models
 * @version November 10, 2021, 10:02 pm -05
 *
 * @property \App\Models\Project $project
 * @property string $name
 * @property integer $project_id
 * @property string $as_a
 * @property string $so_that
 * @property string $i_want
 * @property string $acceptance_criteria
 */
class UserStory extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'user_stories';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'project_id',
        'as_a',
        'so_that',
        'i_want',
        'acceptance_criteria'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'project_id' => 'integer',
        'as_a' => 'string',
        'so_that' => 'string',
        'i_want' => 'string',
        'acceptance_criteria' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|min:2|max:50',
        'project_id' => 'required|integer',
        'as_a' => 'required|min:5|max:300',
        'so_that' => 'required|min:2|max:500',
        'i_want' => 'required|min:2|max:500',
        'acceptance_criteria' => 'required|min:2|max:500'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function project()
    {
        return $this->belongsTo(\App\Models\Project::class, 'project_id', 'id');
    }
}
