<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Checkingaccount
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $account_nr
 * @property string $name
 * @property float $amount
 * @property int $user_id
 * @property int $pin
 * @property float $limit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $user
 * @property-read int|null $user_count
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Checkingaccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Checkingaccount newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Checkingaccount onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Checkingaccount query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Checkingaccount whereAccountNr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Checkingaccount whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Checkingaccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Checkingaccount whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Checkingaccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Checkingaccount whereLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Checkingaccount whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Checkingaccount wherePin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Checkingaccount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Checkingaccount whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Checkingaccount withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Checkingaccount withoutTrashed()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read int|null $users_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Creditaccount[] $creditaccounts
 * @property-read int|null $creditaccounts_count
 */
class Checkingaccount extends Model
{
    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function creditaccounts(){
        return $this->hasMany(Creditaccount::class);
    }
}
