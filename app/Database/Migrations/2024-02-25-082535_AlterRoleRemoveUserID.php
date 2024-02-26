<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterRoleRemoveUserID extends Migration
{
    public function up()
    {
        $this->forge->dropForeignKey('role', 'user_role_user_id_foreign');
        $this->forge->dropColumn('role', 'user_id');
    }

    public function down()
    {
        //
    }
}
