<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCompetency extends Migration
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
            'competency_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => true,
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('id', true);
        $this->forge->createTable('competency', true);
    }

    public function down()
    {
        $this->forge->dropTable('competency');
    }
}
