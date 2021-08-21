<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Hotel extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    protected static function booted()
    {
        parent::booted();
        static::addGlobalScope(new ActiveScope());
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * @return BelongsTo
     * Метод для получения города в котором находится отель
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /**
     * @return BelongsTo
     * Метод для получения организации к которой принадлежит отель
     */
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * @return HasMany
     * Метод для получения всех апартаментов относящихся к отелю
     */
    public function apartments(): HasMany
    {
        return $this->hasMany(Apartment::class);
    }

    /**
     * @return HasManyThrough
     * Получить все отзывы на номера находящиеся в отеле
     */
    public function reviews(): HasManyThrough
    {
        return $this->hasManyThrough(Review::class, Apartment::class);
    }

    /***
     * @return HasManyThrough
     * Метод для получения всех заказов на номера в отеле
     */
    public function reservations(): HasManyThrough
    {
        return $this->hasManyThrough(Reservation::class, Apartment::class);
    }

    /**
     * @return MorphToMany
     * Получение всех спецификаций относящихся к отелю
     */
    public function specifications(): MorphToMany
    {
        return $this->morphToMany(Specification::class, 'specificationable');
    }

    /**
     * @return MorphMany
     * Метод для получения всех изображений относящихся к отелю
     */
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imaginable');
    }

}
