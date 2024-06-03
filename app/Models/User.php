<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasProfilePhoto, Notifiable, TwoFactorAuthenticatable;

    protected $fillable = [
        'name', 'email', 'password', 'image_user',
    ];

    protected $hidden = [
        'password', 'remember_token', 'two_factor_recovery_codes', 'two_factor_secret',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'user_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function likedCollections()
    {
        return $this->belongsToMany(Collection::class, 'collection_user', 'user_id', 'collection_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'follower_id');
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'user_id');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            // Eliminar la imagen del usuario
            if ($user->image_user) {
                Storage::delete($user->image_user);
            }

            // Eliminar relaciones
            $user->collections()->delete();
            $user->comments()->delete();
            $user->messages()->delete();
            $user->receivedMessages()->delete();
            $user->likedCollections()->detach();
            $user->followers()->detach();
            $user->following()->detach();
        });
    }
}

