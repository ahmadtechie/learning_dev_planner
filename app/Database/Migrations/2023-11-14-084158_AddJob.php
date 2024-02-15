<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddJob extends Migration
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
            'job_title' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'qualifications' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('id', true);
        $this->forge->createTable('job', true);
    }

    public function down()
    {
        $this->forge->dropTable('job');
    }
}
