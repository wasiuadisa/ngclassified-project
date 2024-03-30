<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'users_id', 'security_question', 'security_answer', 'date_of_birth', 'gender', 'state', 'city', 'address', 'postcode', 'phone', 'about_me', 'hobbies', 'religion', 'religious_level', 'view_count', 'created_at', 'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'profiles';
}
