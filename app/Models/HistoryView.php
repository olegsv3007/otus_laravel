<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoryView extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    protected $casts = [
        'date_start' => 'date',
        'date_end' => 'date',
        'created_at' => 'datetime',
    ];

    /**
     * @return BelongsTo
     * Метод для получения апартаментов которые относятся к просмотру
     */
    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }

    /**
     * @return BelongsTo
     * Метод для получения пользователя который просматривал страницу апартаментов
     */
    public function viewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
