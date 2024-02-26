<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterUserRoleTable extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('user_role', [
            'role' => [
                'name' => 'name',
                'type' => 'VARCHAR',
                'constraint' => 100,
            ]
        ]);
        $this->forge->renameTable('user_role', 'role');

    }

    public function down()
    {
        $this->forge->dropTable('role');
    }
}
