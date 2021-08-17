<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoles extends Migration
{
    private $roles = [
        'admin',
        'moderator',
        'manager',
        'user',
    ];

    public function up()
    {
        foreach ($this->roles as $role) {
            $this->storeRole($role);
        }
    }

    public function down()
    {
        foreach ($this->roles as $role) {
            $this->deleteRole($role);
        }
    }

    private function deleteRole($roleName)
    {
        DB::table('roles')
            ->where('name', $roleName)
            ->delete();
    }

    private function storeRole($roleName)
    {
        DB::table('roles')->insertOrIgnore([
            'name' => $roleName
        ]);
    }
}
