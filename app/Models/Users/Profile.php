<?php

namespace App\Models\Users;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Users\Profile
 *
 * @property-read mixed $age
 * @property-read mixed $display_name
 * @property-read \App\Models\Users\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\Profile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\Profile query()
 * @mixin \Eloquent
 */
class Profile extends Model
{
    /**
     * Massassignable fields.
     */
    protected $fillable = [
        'gender',
        'firstname',
        'lastname',
        'birthday',
        'settings',
    ];

    /**
     * Fields to cast between object and storage.
     */
    protected $casts = [
        'settings' => 'array',
    ];

    /**
     * Attributes that are dates.
     */
    protected $dates = [
        'birthday',
        'created_at',
        'updated_at',
    ];

    /**
     * Return the user object or the Relation.
     *
     * @return BelongsTo|User|\Illuminate\Database\Collection
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDisplayNameAttribute()
    {
        return sprintf('%s %s', $this->firstname, $this->lastname);
    }

    public function getAgeAttribute()
    {
        if ($this->birthday instanceof Carbon) {
            return $this->birthday->diffInYears(Carbon::today());
        }

        return null;
    }
}
