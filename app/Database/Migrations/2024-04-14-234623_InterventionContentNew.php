<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InterventionContentNew extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'intervention_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'module_title' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'sub_topic' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
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
        $this->forge->addForeignKey('intervention_id', 'learning_intervention', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('intervention_content');
    }

    public function down()
    {
        $this->forge->dropTable('intervention_content', true);
    }
}
