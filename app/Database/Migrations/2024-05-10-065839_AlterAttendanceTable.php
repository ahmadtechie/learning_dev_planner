<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterAttendanceTable extends Migration
{
    public function up()
    {
        $fields = [
            'intervention_class_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
        ];
        $this->forge->addColumn('intervention_attendance', $fields);
        $this->forge->addForeignKey('class_id', 'intervention_class', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        //
    }
}
