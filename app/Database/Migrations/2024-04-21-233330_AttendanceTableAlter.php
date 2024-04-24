<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AttendanceTableAlter extends Migration
{
    public function up()
    {
        $fields = [
            'attendance_status' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
        ];
        $this->forge->addColumn('intervention_attendance', $fields);

    }

    public function down()
    {
        //
    }
}
