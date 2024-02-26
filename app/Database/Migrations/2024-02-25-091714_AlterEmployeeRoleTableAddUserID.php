<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterEmployeeRoleTableAddUserID extends Migration
{
    public function up()
    {
        $fields = [
            'user_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => true,
            ],
        ];
        $this->forge->addColumn('employee_roles', $fields);
        $this->forge->addForeignKey('user_id', 'user', 'id', '', 'CASCADE');
    }

    public function down()
    {
        //
    }
}
