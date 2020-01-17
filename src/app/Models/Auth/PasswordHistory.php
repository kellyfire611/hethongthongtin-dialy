<?php

namespace App\Models\Auth;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

/**
 * Class PasswordHistory.
 */
class PasswordHistory extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'password_histories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['password'];
}
