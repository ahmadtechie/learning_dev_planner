<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DepartmentMigration extends Migration
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
            'department_name' => [
                'type' => 'VARCHAR',
                'constraint' => 355,
            ],
            'group_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => true,
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
        $this->forge->addForeignKey('group_id', 'group', 'id', '', 'CASCADE');
        $this->forge->createTable('department', true);
    }

    public function down()
    {
        $this->forge->dropTable('department');
    }
}
