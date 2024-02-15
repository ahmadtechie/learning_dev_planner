<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEmployee extends Migration
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
            'user_id' => [
                'type' => 'INT',
                'constraint' => 5,
            ],
            'job_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('job_id', 'job', 'id');
        $this->forge->createTable('employee', true);
    }

    public function down()
    {
        $this->forge->dropTable('employee');
    }
}
