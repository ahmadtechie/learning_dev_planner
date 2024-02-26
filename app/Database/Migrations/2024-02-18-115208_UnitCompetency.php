<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UnitCompetency extends Migration
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
            'unit_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'competency_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('unit_id', 'unit', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('competency_id', 'competency', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('unit_competency');
    }

    public function down()
    {
        $this->forge->dropTable('unit_competency');
    }
}
