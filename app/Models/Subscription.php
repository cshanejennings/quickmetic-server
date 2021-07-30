<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Account;
use App\Models\Plan;
use App\Models\Thread;

/**
 * App\Models\Subscription
 *
 * @property int $id
 * @property int $account_id
 * @property int $plan_id
 * @property string $renewal_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Account $account
 * @property-read Plan $plan
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereRenewalDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Subscription extends Model
{
  protected $fillable = [
      'account_id',
      'plan_id',
      'provider',
      'sms_number',
      'renewal_date',
  ];

  public function account() {
    return $this->belongsTo('App\Models\Account');
  }

  public function plan() {
    return $this->belongsTo('App\Models\Plan');
  }

}
