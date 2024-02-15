<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddParticipantFeedback extends Migration
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
            ],
            'feedback_text' => [
                'type' => 'TEXT',
                null => false
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
        $this->forge->addForeignKey('intervention_id', 'learning_intervention', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('employee_id', 'employee', 'id', '', 'CASCADE');
        $this->forge->createTable('participant_feedback', true);
    }

    public function down()
    {
        $this->forge->dropTable('participant_feedback');
    }
}
