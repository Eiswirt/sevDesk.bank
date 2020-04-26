<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Creditaccount
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Creditaccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Creditaccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Creditaccount query()
 * @mixin \Eloquent
 * @property int $id
 * @property float $limit
 * @property float $amount
 * @property int $checkingaccount_id
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Creditaccount whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Creditaccount whereCheckingaccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Creditaccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Creditaccount whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Creditaccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Creditaccount whereLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Creditaccount whereUpdatedAt($value)
 * @property-read \App\Checkingaccount $checkingaccount
 */
class Creditaccount extends Model
{
    //
    public function checkingaccount(){
        return $this->belongsTo(Checkingaccount::class);
    }
}
