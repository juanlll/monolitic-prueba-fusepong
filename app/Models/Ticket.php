<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Ticket
 * @package App\Models
 * @version November 10, 2021, 10:04 pm -05
 *
 * @property \App\Models\UserStory $userStory
 * @property string $comments
 * @property string $status
 * @property integer $user_story_id
 */
class Ticket extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'tickets';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'comments',
        'status',
        'user_story_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'comments' => 'string',
        'status' => 'string',
        'user_story_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'comments' => 'required|min:2|max:50',
        'status' => 'required',
        'user_story_id' => 'required|integer'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function userStory()
    {
        return $this->belongsTo(\App\Models\UserStory::class, 'user_story_id', 'id');
    }
}
