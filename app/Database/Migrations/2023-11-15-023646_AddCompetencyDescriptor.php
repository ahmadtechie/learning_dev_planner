<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCompetencyDescriptor extends Migration
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
            'competency_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'descriptor_text' => [
                'type' => 'TEXT',
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('competency_id', 'competency', 'id', '', 'CASCADE');
        $this->forge->createTable('competency_descriptor', true);
    }

    public function down()
    {
        $this->forge->dropTable('competency_descriptor');
    }
}
