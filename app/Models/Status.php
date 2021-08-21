<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    /**
     * @return HasMany
     * Метод для получения всех броней имеющих этот статус
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
