<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = false;

    protected $casts = [
        'moderated' => 'boolean',
        'created_at' => 'datetime',
    ];

    /**
     * @return BelongsTo
     * Метод для получения пользователя оставившего отзыв
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     * Метод для получения апартаментов на которые был оставлен отзыв
     */
    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }


}
