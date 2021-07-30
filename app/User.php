<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\Account;
use App\Models\Trial;
use App\Models\Subscription;
use App\Models\Plan;
use App\Notifications\VerifyApiEmail;

/**
 * App\User
 *
 * @property int $id
 * @property int|null $account_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read Account|null $account
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
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
        'first_name',
        'last_name',
        'account_id',
        'email',
        'password',
        'options',
    ];

    public function getOptionsAttribute($value) {
        return json_decode($value);
    }

    public function sendApiEmailVerificationNotification() {
        $this->notify(new VerifyApiEmail);
    }

    public function get_validation_url() {
        return URL::temporarySignedRoute(
          'verificationapi.verify', Carbon::now()->addMinutes(60), ['id' => $notifiable->getKey()]
        );
    }

    public function account() {
        return $this->belongsTo('App\Models\Account');
    }

    public function subscription() {
      return $this->account->hasOne('App\Models\Subscription');
    }

    public function plan() {
        return $this->subscription->belongsTo('App\Models\Plan');
    }

    public function trials() {
      return $this->hasMany('App\Models\Trial');
    }

    public function add_trial($data) {
        $data['user_id'] = $this->id;
      return Trial::create($data);
    }

    public function get_full_profile() {
        (  $this->account
        && $this->subscription
        && $this->plan
        );
        return $this;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ 'password' ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
