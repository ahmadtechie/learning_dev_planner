<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EmployeeInterventionMappingTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'employee_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'intervention_id' => [
                'type' => 'ENUM',
                'constraint' => ['success', 'failed'],
                'default' => 'success',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('employee_interventions');
        $this->forge->addForeignKey('employee_id', 'employee', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('intervention_id', 'learning_interventions', 'id', 'CASCADE', 'CASCADE');

    }

    public function down()
    {
        $this->forge->dropTable('employee_interventions');
    }
}
