<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;


class AddAdmin extends Migration
{
    private array $admin = [
        'name' => 'admin',
        'email' => 'admin@example.com',
    ];

    public function up()
    {
        $this->admin['email_verified_at'] = now();
        $this->admin['password'] = Hash::make('secret');

        DB::table('users')->insertOrIgnore($this->admin);
        DB::table('role_user')->insertOrIgnore([
            'role_id' => 1,
            'user_id' => 1,
        ]);
    }

    public function down()
    {
        DB::table('role_user')
            ->where('role_id', 1)
            ->where('user_id', 1)
            ->delete();

        DB::table('users')
            ->where('email', $this->admin['email'])
            ->delete();
    }
}
