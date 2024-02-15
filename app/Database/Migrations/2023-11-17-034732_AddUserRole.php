<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserRole extends Migration
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
            'role' => [
                'type' => "ENUM('learning_dev_manager', 'line_manager', 'employee', 'trainer')",
                'default' => 'employee',
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ]
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'user', 'id', '', 'CASCADE');
        $this->forge->createTable('user_role', true);

    }

    public function down()
    {
        $this->forge->dropTable('user_role');
    }
}
