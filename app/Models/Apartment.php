<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Apartment extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    protected $casts = [
        'active' => 'boolean'
    ];

    protected static function booted()
    {
        parent::booted();
        static::addGlobalScope(new ActiveScope());
    }

    /**
     * @return BelongsTo
     * Метод для получения отеля к которому относятся апартаменты
     */
    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

    /**
     * @return HasMany
     * Метод для получения всех оформленных заказов на апартаменты
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * @return HasMany
     * Метод для получения всех отзывов на апартаменты
     */
    public function reviews(): hasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * @return MorphToMany
     * Получение всех спецификаций относящихся к апартаментам
     */
    public function specifications(): MorphToMany
    {
        return $this->morphToMany(Specification::class, 'specificationable');
    }

}
