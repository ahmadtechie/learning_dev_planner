<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLearningIntervention extends Migration
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
            'vendor_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => true,
            ],
            'cycle_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'intervention_type_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'class_name' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true,
            ],
            'start_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'end_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'venue' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'cost' => [
                'type' => 'FLOAT',
                'default' => 0.0,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('vendor_id', 'intervention_vendor', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('cycle_id', 'development_cycle', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('intervention_type_id', 'intervention_type', 'id', '', 'CASCADE');
        $this->forge->createTable('learning_intervention', true);
    }

    public function down()
    {
        $this->forge->dropTable('learning_intervention');
    }
}
