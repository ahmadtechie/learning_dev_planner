<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class AddInterventionAttendance extends Migration
{
    public function up()
    {
        $fields = [
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'intervention_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'employee_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => true,
            ],
            'line_manager_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'attendance_date' => [
                'type' => 'DATETIME',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('intervention_id', 'learning_intervention', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('employee_id', 'employee', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('line_manager_id', 'user', 'id', '', 'CASCADE');
        $this->forge->createTable('intervention_attendance', true);
    }

    public function down()
    {
        $this->forge->dropTable('learning_intervention');
    }
}
