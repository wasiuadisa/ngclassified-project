<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mallpost extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deleted', 'blocked', 'mallcategories_id', 'users_id', 'title', 'description', 'price', 'age', 'condition', 'state', 'city', 'contact_name', 'contact_address', 'contact_phone', 'contact_email', 'views', 'created_at', 'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'mallposts';
}
