<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Passbook
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Passbook newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Passbook newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Passbook query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property float $amount
 * @property int $user_id
 * @property int $pin
 * @property float $interest
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Passbook whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Passbook whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Passbook whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Passbook whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Passbook whereInterest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Passbook whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Passbook wherePin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Passbook whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Passbook whereUserId($value)
 */
class Passbook extends Model
{
    public function users(){
        return $this->belongsToMany(User::class);
    }
}
