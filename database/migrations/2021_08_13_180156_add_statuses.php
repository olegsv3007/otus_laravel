<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatuses extends Migration
{
    private array $statuses = [
        'Ожидается подтверждение отелем',
        'Ожидается оплата',
        'Оплата получена',
        'Бронь отклонена',
        'Оплата просрочена',
        'Выполнено',
    ];

    public function up()
    {
        foreach ($this->statuses as $status) {
            $this->storeStatus($status);
        }
    }

    public function down()
    {
        foreach ($this->statuses as $status) {
            $this->deleteStatus($status);
        }
    }

    private function storeStatus($status)
    {
        DB::table('statuses')->insertOrIgnore([
            'title' => $status,
        ]);
    }

    private function deleteStatus($status)
    {
        DB::table('statuses')
            ->where('title', $status)
            ->delete();
    }
}
