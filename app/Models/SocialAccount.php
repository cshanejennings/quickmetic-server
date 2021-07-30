<?php

namespace App\Models;
use App\User;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SocialAccount
 *
 * @property int $id
 * @property int $user_id
 * @property string $provider
 * @property string $social_id
 * @property string $name
 * @property string $email
 * @property string|null $avatar
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|SocialAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialAccount whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialAccount whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialAccount whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialAccount whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialAccount whereSocialId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialAccount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialAccount whereUserId($value)
 * @mixin \Eloquent
 */
class SocialAccount extends Model
{
  protected $fillable = [
      'user_id',
      'provider',
      'social_id',
      'name',
      'email',
      'avatar',
  ];

  public function user()
  {
      return $this->belongsTo(User::class);
  }
}
