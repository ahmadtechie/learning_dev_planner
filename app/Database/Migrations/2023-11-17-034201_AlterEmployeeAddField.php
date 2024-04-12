<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterEmployeeAddField extends Migration
{
    public function up()
    {
        $fields = [
            'line_manager_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'department_id' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'unit_id' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ]
        ];
        $this->forge->addForeignKey('line_manager_id', 'user', 'id', '', 'CASCADE');
        $this->forge->addColumn('employee', $fields);
    }

    public function down()
    {
        //
    }
}
