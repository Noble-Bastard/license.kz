<?php

namespace App;

use App\Data\Core\Dal\UserRoleDal;
use App\Data\Core\Model\Profile;
use App\Data\Core\Model\ProfileExt;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\CustomResetPassword as ResetPasswordNotification;
use App\Notifications\WelcomeInternalUser as WelcomeInternalUserNotification;
use App\Notifications\Welcome as WelcomeNotification;
use App\Notifications\WelcomeWithPass as WelcomeWithPassNotification;
use App\Notifications\NewClient as NewClientNotification;
use Illuminate\Support\Facades\Mail;
use Laravel\Passport\HasApiTokens;

/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property int $is_active
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @mixin \Illuminate\Database\Query\Builder
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];


    public static function isUserInRole($roleId)
    {
        return UserRoleDal::isUserInRole($roleId);
    }

    public function profile()
    {
        return $this->hasOne(ProfileExt::class, 'user_id', 'id');
    }

    public function sendWelcomeInternalUserEmail()
    {
        // Generate a new reset password token
        $token = app('auth.password.broker')->createToken($this);

        $this->notify(new WelcomeInternalUserNotification($token));
    }

    public function sendWelcomeEmail()
    {
        // Generate a new reset password token
        $this->notify(new WelcomeNotification());
    }

    public function sendWelcomeWithPassEmail($pass)
    {
        // Generate a new reset password token
        $this->notify(new WelcomeWithPassNotification($pass));
    }

    public function sendAdminNewClientEmail($newClient)
    {
        $this->notify(new NewClientNotification($newClient));
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
