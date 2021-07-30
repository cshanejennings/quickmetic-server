<?php

namespace App\Models;

use Carbon\Carbon;
use App\User;

use Illuminate\Database\Eloquent\Model;

use App\Traits\QBOService;

/**
 * App\Models\Account
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $phone_number
 * @property string $notification_email
 * @property string|null $company_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Invitation[] $invitations
 * @property-read int|null $invitations_count
 * @property-read Subscription|null $subscription
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Account newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Account newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Account query()
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereJaneCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereNotificationEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereTaxCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereTaxRates($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereUserId($value)
 * @mixin \Eloquent
 */
class Account extends Model
{

  protected $fillable = [
      'user_id',
      'phone_number',
      'notification_email',
  ];

  public function subscription() {
    return $this->hasOne('App\Models\Subscription');
  }

  public function users() {
    return $this->hasMany('App\User');
  }

  public function invitations() {
    return $this->hasMany('App\Models\Invitation');
  }

  public function get_member_list() {
    return [
      'users' => $this->users,
      'invitations' => $this->invitations,
    ];
  }

}
