<?php

namespace App\Models;

use Carbon\Carbon;
use App\User;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Trial
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
 * @method static \Illuminate\Database\Eloquent\Builder|Trial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Trial newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Trial query()
 * @method static \Illuminate\Database\Eloquent\Builder|Trial whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trial whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trial whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trial whereNotificationEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trial wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trial whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trial whereUserId($value)
 * @mixin \Eloquent
 */
class Trial extends Model
{

  protected $fillable = [
      'user_id',
      'type',
      'negatives',
      'width',
      'height',
      'trial_time',
      'row_digits',
      'header_digits',
      'elapsed_time',
      'correct',
      'percent',
  ];

  public function users() {
    return $this->belongsTo('App\User');
  }

}
