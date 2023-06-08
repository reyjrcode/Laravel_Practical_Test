<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FollowUser extends Model
{
    use HasFactory, HasUuids;


    protected $table = 'follow_users';
    protected $primaryKey = 'id';
    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'follow_user_id',
        'status',

    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

        'id' => 'string'
    ];

    protected $with = ['user'];
    public function user()
    {
        return $this->belongsTo(User::class, 'follow_user_id', 'id');
    }

}