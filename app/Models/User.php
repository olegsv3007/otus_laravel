<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return HasMany
     * Получить все роли относящиеся к пользователю
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * @return HasMany
     * Получить всю историю просмотров пользователя
     */
    public function  historyViews(): HasMany
    {
        return $this->hasMany(HistoryView::class);
    }

    /**
     * @return HasMany
     * Метод для получения всех отзывов оставленных пользователем
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * @return HasMany
     * Метод для получения всех броней пользователя
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

}
