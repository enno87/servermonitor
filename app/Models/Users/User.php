<?php

namespace App\Models\Users;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\Users\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \App\Models\Users\Profile $profile
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\User query()
 * @mixin \Eloquent
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Attributes that are dates.
     */
    protected $dates = [
        'email_verified_at',
        'created_at',
        'updated_at',
    ];

    /**
     * Return the Profile or Profile Relation
     *
     * @return HasOne|Profile
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
