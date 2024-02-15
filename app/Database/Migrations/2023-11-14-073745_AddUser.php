<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUser extends Migration
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
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'unique' => true,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 300,
            ],
            'first_name' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            'last_name' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            'employee_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('employee_id', 'employee', 'id');
        $this->forge->createTable('user', true);
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}
